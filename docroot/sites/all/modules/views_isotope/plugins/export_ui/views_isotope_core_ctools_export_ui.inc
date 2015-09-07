<?php
/**
 * Define this Export UI plugin.
 */
$plugin = array(
  'schema' => 'isotope_configurations',  // As defined in hook_schema().
  'access' => 'administer isotope',  // Define a permission users must have to access these pages.
  // Define the menu item.
  'menu' => array(
    'menu item' => 'isotope',
    'menu title' => 'Isotope Configurations',
    'menu description' => 'Administer Isotope configurations.',
  ),
  // Define user interface texts.
  'title singular' => t('config'),
  'title plural' => t('configs'),
  'title singular proper' => t('Isotope Configuration'),
  'title plural proper' => t('Isotope Configurations'),
  // Define the names of the functions that provide the add/edit forms.
  'form' => array(
    'settings' => 'views_isotope_core_ctools_export_ui_form',
    // 'submit' and 'validate' are also valid callbacks.
  ),
);

/**
 * Define the configuration add/edit form.
 */
function views_isotope_core_ctools_export_ui_form(&$form, &$form_state) {
  $config = $form_state['item'];
  dpm($config->plugins);

  $ajaxLayoutMode = '';

  $detectedLibraries = views_isotope_core_check_additional_libraries();

  $layouts_included = array( 
    'masonry' => t('masonry'),
    'fitRows' => t('fitRows'),
    'vertical' => t('vertical'),
  );

  $layouts_not_included = array( 
    'cellsByRow' => t('cellsByRow'),
    'packery' => t('packery'),
    'masonryHorizontal' => t('masonryHorizontal'),
    'fitColumns' => t('fitColumns'),
    'cellsByColumn' => t('cellsByColumn'),
    'horizontal' => t('horizontal'),
  );

  $plugins = array( 
    'imagesLoaded' => t('imagesLoaded'),
    'bbq' => t('BBQ.js'),
    'infiniteScroll' => t('infiniteScroll'),
  );

  $form['layoutMode'] = array(
    '#type' => 'radios',
    '#options' => array_merge($layouts_included, $layouts_not_included),
    '#title' => t('Isotope Layout Mode'),
    '#description' => t('If desired options are disabled, you may need to install additional JS libraries. Refer to installation instructions.'),
    '#default_value' => ($config->layoutMode)?$config->layoutMode:'masonry',
    '#required' => FALSE,
  );

// Disable the option for libraries that are not included
  foreach($layouts_not_included as $key => $value){
    if(!in_array($key, $detectedLibraries)){
      $form['layoutMode'][$key] = array( '#disabled' => TRUE );
    }
  }

  $form['plugins'] = array(
    '#type' => 'checkboxes',
    '#options' => $plugins,
    '#title' => t('Additional Plugins'),
    '#description' => t('If desired options are disabled, you may need to install additional JS libraries. Refer to installation instructions.'),
    '#default_value' => ($config->plugins)?$config->plugins:array(),
    '#required' => FALSE,
    '#tree' => TRUE,
  );

// Disable the option for libraries that are not included
  foreach($plugins as $key => $value){
    if(!in_array($key, $detectedLibraries)){
      $form['plugins'][$key] = array( '#disabled' => TRUE );
    }
  }

  $form['transitionDuration'] = array(
    '#type' => 'textfield',
    '#title' => t('Transition Duration'),
    '#description' => t('To disable all transitions, set transitionDuration: 0.'),
    '#default_value' => $config->transitionDuration,
    '#required' => FALSE,
  );

  if($ajaxLayoutMode == 'masonry'){
    $form['isFitWidth'] = array(
      '#type' => 'select',
      '#options' => array(
        0 => 'False',
        1 => 'True',
        ),
      '#title' => t('isFitWidth'),
      '#description' => t('Sets the width of the container to fit the available number of columns, based the size of container\'s parent element. When enabled, you can center the container with CSS.'),
      '#default_value' => ($config->isFitWidth)?$config->isFitWidth:0,
      '#required' => FALSE,
    );
  }

  if($ajaxLayoutMode == 'packery'){
    $form['isHorizontal'] = array(
      '#type' => 'select',
      '#options' => array(
        0 => 'False',
        1 => 'True',
        ),
      '#title' => t('isHorizontal'),
      '#description' => t('Arranges items horizontally instead of vertically.'),
      '#default_value' => ($config->isHorizontal)?$config->isHorizontal:0,
      '#required' => FALSE,
    );
  }

  if($ajaxLayoutMode == 'masonry' || $ajaxLayoutMode == 'packery' || $ajaxLayoutMode == 'masonryHorizontal'){
    $form['stamp'] = array(
      '#type' => 'textfield',
      '#title' => t('Stamp Selector'),
      '#description' => t('Specifies elements that are stamped within the layout. These are special layout elements which will not be laid out. Rather, Isotope will layout item elements below stamped elements.'),
      '#default_value' => $config->stamp,
      '#required' => FALSE,
    );
  }

  if($ajaxLayoutMode == 'vertical'){
    $form['horizontalAlignment'] = array(
      '#type' => 'textfield',
      '#title' => t('Horizontal Alignment (decimal number 0 to 1)'),
      '#description' => t('Aligns items horizontally. 0 will align the origin edge. 1 will align the opposite edge. 0.5 will align center.'),
      '#default_value' => $config->horizontalAlignment,
      '#required' => FALSE,
    );
  }

  if($ajaxLayoutMode == 'horizontal'){
    $form['verticalAlignment'] = array(
      '#type' => 'textfield',
      '#title' => t('Vertical Alignment (decimal number 0 to 1)'),
      '#description' => t('Aligns items vertically. 0 will align the origin edge. 1 will align the opposite edge. 0.5 will align center.'),
      '#default_value' => $config->verticalAlignment,
      '#required' => FALSE,
    );
  }

  //dpm($form);

}

