<?php
/**
 * @file
 * cartaro_demo.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function cartaro_demo_user_default_permissions() {
  $permissions = array();

  // Exported permission: access administration pages.
  $permissions['access administration pages'] = array(
    'name' => 'access administration pages',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'system',
  );

  // Exported permission: access content.
  $permissions['access content'] = array(
    'name' => 'access content',
    'roles' => array(
      0 => 'anonymous user',
      1 => 'authenticated user',
    ),
    'module' => 'node',
  );

  // Exported permission: access content overview.
  $permissions['access content overview'] = array(
    'name' => 'access content overview',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'node',
  );

  // Exported permission: access dashboard.
  $permissions['access dashboard'] = array(
    'name' => 'access dashboard',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'dashboard',
  );

  // Exported permission: access toolbar.
  $permissions['access toolbar'] = array(
    'name' => 'access toolbar',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'toolbar',
  );

  // Exported permission: administer blocks.
  $permissions['administer blocks'] = array(
    'name' => 'administer blocks',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'block',
  );

  // Exported permission: administer content types.
  $permissions['administer content types'] = array(
    'name' => 'administer content types',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'node',
  );

  // Exported permission: administer feeds.
  $permissions['administer feeds'] = array(
    'name' => 'administer feeds',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'feeds',
  );

  // Exported permission: administer geoserver.
  $permissions['administer geoserver'] = array(
    'name' => 'administer geoserver',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'geoserver',
  );

  // Exported permission: administer menu.
  $permissions['administer menu'] = array(
    'name' => 'administer menu',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'menu',
  );

  // Exported permission: administer nodes.
  $permissions['administer nodes'] = array(
    'name' => 'administer nodes',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'node',
  );

  // Exported permission: administer openlayers.
  $permissions['administer openlayers'] = array(
    'name' => 'administer openlayers',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'openlayers_ui',
  );

  // Exported permission: bypass node access.
  $permissions['bypass node access'] = array(
    'name' => 'bypass node access',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'node',
  );

  // Exported permission: create url aliases.
  $permissions['create url aliases'] = array(
    'name' => 'create url aliases',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'path',
  );

  // Exported permission: view any capital content.
  $permissions['view any capital content'] = array(
    'name' => 'view any capital content',
    'roles' => array(
      0 => 'anonymous user',
    ),
    'module' => 'nodetype_access',
  );

  // Exported permission: view any page content.
  $permissions['view any page content'] = array(
    'name' => 'view any page content',
    'roles' => array(
      0 => 'anonymous user',
    ),
    'module' => 'nodetype_access',
  );

  // Exported permission: view the administration theme.
  $permissions['view the administration theme'] = array(
    'name' => 'view the administration theme',
    'roles' => array(
      0 => 'demo',
    ),
    'module' => 'system',
  );

  return $permissions;
}
