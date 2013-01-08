<?php

/**
 * @file
 * Cartaro profile.
 */

/**
 * Implements hook_init().
 */
function cartaro_init() {
  global $conf;

  // Use this early opportunity to brand the install/runtime experience.
  // Once the generic theme settings are saved, or a custom theme's settings
  // are saved to override it, this will not be effective anymore, which is
  // intended.
  if (empty($conf['theme_settings'])) {
    $conf['theme_settings'] = array(
      'default_logo' => 0,
      'logo_path' =>  empty($conf['site_name']) ? 'profiles/cartaro/logo_dark.png' : 'profiles/cartaro/logo_light.png',
    );
  }
}

/**
 * Implements hook_install_tasks_alter().
 */
function cartaro_install_tasks_alter(&$tasks, $install_state) {

  // Preselect the English language, so users can skip the language selection
  // form. We do not ship other languages with Cartaro at this point.
  if (!isset($_GET['locale'])) {
    $_POST['locale'] = 'en';
  }
}

/**
 * Implements hook_form_install_configure_form_alter().
 *
 * Allows the profile to alter the site configuration form.
 */
function cartaro_form_install_configure_form_alter(&$form, $form_state) {

  module_load_install('postgis');
  $postgis_requirements = postgis_requirements('install');

  $form['cartaro'] = array(
    '#type' => 'fieldset',
    '#title' => st('Cartaro settings'),
    '#weight' => 1,
    'geoserver_url' => array(
      '#title' => st('GeoServer URL'),
      '#type' => 'textfield',
      '#required' => TRUE,
      '#default_value' => 'http://' . $_SERVER['SERVER_NAME'] . ':8080/geoserver',
    ),
    'geoserver_workspace_support' => array(
      '#title' => st('Support GeoServer Drupal authentication'),
      '#type' => 'checkbox',
      '#description' => st('Allow GeoServer to access the permissions and roles configured in Cartaro. This setting requires the geoserver-sec-drupal module to be installed in GeoServer.'),
      '#default_value' => FALSE
    ),
    'geoserver_workspace' => array(
      '#title' => st('GeoServer Workspace'),
      '#type' => 'textfield',
      '#required' => TRUE,
    ),
    'postgis_version' => array(
      '#title' => st('PostGIS Version'),
      '#type' => 'textfield',
      '#disabled' => TRUE,
      '#value' => $postgis_requirements[0]['value'],
      '#description' => $postgis_requirements[0]['description'],
    ),
    'cartaro_demo' => array(
      '#type' => 'checkbox',
      '#title' => st('Cartaro demo'),
      '#description' => st('Setup example data and configuration.'),
      '#default_value' => FALSE
    ),
  );

  // Move update notifications below Cartaro settings.
  $form['update_notifications']['#weight'] = 2;

  // Add both existing submit function and our submit function,
  // since adding just ours cancels the automated discovery of the original.
  $form['#validate'] = array('cartaro_configure_form_validate', 'install_configure_form_validate');
  $form['#submit'] = array('cartaro_configure_form_submit', 'install_configure_form_submit');
}

/**
 * Submit callback for Cartaro configure form.
 */
function cartaro_configure_form_submit($form, &$form_state) {

  if ($form_state['values']['cartaro_demo']) {
    module_enable(array('cartaro_demo'));
  }
}

/**
 * Validation callback for Cartaro configure form.
 */
function cartaro_configure_form_validate($form, &$form_state) {

  // Check PostGIS requirements.
  module_load_install('postgis');
  $postgis_requirements = postgis_requirements('install');
  foreach ($postgis_requirements as $requirement) {
    if ($requirement['severity'] == REQUIREMENT_ERROR) {
      form_set_error('postgis_version', $requirement['description']);
    }
  }

  $geoserver_url = trim($form_state['values']['geoserver_url'], '/');
  $geoserver_workspace = $form_state['values']['geoserver_workspace'];
  $geoserver_workspace_support = (bool)$form_state['values']['geoserver_workspace_support'];

  // cartaro requires the geoserver-sec-drupal module as workspace support is mandatory
  variable_set('geoserver_workspace_support', $geoserver_workspace_support);
  variable_set('geoserver_workspace', $geoserver_workspace);
  variable_set('geoserver_postgis_datastore', 'cartaro');
  variable_set('geoserver_url', $geoserver_url . '/');

  $username = $form_state['values']['account']['name'];
  $password = $form_state['values']['account']['pass'];
  $geoserver_login = geoserver_login($username, $password);

  if ($geoserver_login === TRUE) {
    cartaro_configure_geoserver($geoserver_workspace);
    
    // Copy cookie file since the installation uses uid=0 but after installation one is logged in as uid=1 without going through the usual login procedure.
    if(copy(geoserver_get_cookiefile(), geoserver_get_cookiefile(1))===FALSE){
      drupal_set_message(st('Failed prepare GeoServer login for the administrator.'), 'warning');
    }
  }
  else {
    form_set_error('geoserver_url', t('GeoServer login failed: %reason Please check the GeoServer URL and your site maintenance account.', 
        array('%reason' => $geoserver_login)));
  }
}

/**
 * Configure GeoServer workspace and datastore.
 *
 * @param string $geoserver_workspace Name of GeoServer workspace.
 */
function cartaro_configure_geoserver($geoserver_workspace) {

  // Check if workspace is already taken.
  try {
    geoserver_get('rest/workspaces/' . $geoserver_workspace . '.json');
    form_set_error('geoserver_workspace', t('GeoServer Workspace already taken.'));
    return;
  }
  catch (geoserver_resource_curl_exception $exc) {
    // Workspace isn't taken; go on.
  }

  // Create workspace.
  $content = array('workspace' => array('name' => $geoserver_workspace));
  try {
    geoserver_post('rest/workspaces.json', $content);
  }
  catch (geoserver_resource_curl_exception $exc) {
    form_set_error('geoserver_workspace', t('Could not create GeoServer workspace: %reason',
        array('reason' => $exc->getMessage()))
    );
  }

  // Create PostGIS datastore.
  $database = $GLOBALS['databases']['default']['default'];
  $database['port'] = empty($database['port']) ? '5432' : $database['port'];
  $content = array(
    'dataStore' => array(
      'name' => 'cartaro',
      'description' => 'Default PostGIS datastore of Cartaro.',
      'type' => 'PostGIS',
      'enabled' => TRUE,
      'workspace' => $geoserver_workspace,
      'connectionParameters' => array(
        'entry' => array(
          array('@key' => 'Connection timeout',   '$' => '20'),
          array('@key' => 'port',                 '$' => $database['port']),
          array('@key' => 'passwd',               '$' => $database['password']),
          array('@key' => 'dbtype',               '$' => 'postgis'),
          array('@key' => 'host',                 '$' => $database['host']),
          array('@key' => 'validate connections', '$' => 'false'),
          array('@key' => 'max connections',      '$' => '10'),
          array('@key' => 'database',             '$' => $database['database']),
          array('@key' => 'namespace',            '$' => $geoserver_workspace),
          array('@key' => 'schema',               '$' => 'public'),
          array('@key' => 'Loose bbox',           '$' => 'true'),
          array('@key' => 'Expose primary keys',  '$' => 'false'),
          array('@key' => 'fetch size',           '$' => '1000'),
          array('@key' => 'Max open prepared statements', '$' => '50'),
          array('@key' => 'preparedStatements',   '$' => 'false'),
          array('@key' => 'Estimated extends',    '$' => 'true'),
          array('@key' => 'user',                 '$' => $database['username']),
          array('@key' => 'min connections',      '$' => '1'),
          array('@key' => 'Primary key metadata table', '$' => 'public.geoserver_pk_metadata_table'),
        ),
      ),
    ),
  );
  try {
    geoserver_post('rest/workspaces/' . $geoserver_workspace . '/datastores.json', $content);
  }
  catch (geoserver_resource_curl_exception $exc) {
    form_set_error('geoserver_workspace', t('Could not create GeoServer datastore in workspace: %reason',
        array('reason' => $exc->getMessage()))
    );
  }
}
