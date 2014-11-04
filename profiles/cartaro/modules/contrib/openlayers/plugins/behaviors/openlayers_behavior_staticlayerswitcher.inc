<?php
/**
 * @file
 * Implementation of OpenLayers behavior.
 */

/**
 * Ctools plugin definition.
 */
$plugin = array(
  'title' => t('Static Layer Switcher'),
  'description' => t('Binds to the layer switch control in the DOM of the map page.'),
  'type' => 'map',
  'behavior' => array(
    'file' => 'openlayers_behavior_staticlayerswitcher.inc',
    'class' => 'openlayers_behavior_staticlayerswitcher',
    'parent' => 'openlayers_behavior',
  ),
);

/**
 * Layer Switcher Behavior
 */
class openlayers_behavior_staticlayerswitcher extends openlayers_behavior {
  /**
   * Provide initial values for options.
   */
  function options_init() {
    return array(
      'staticlayerswitcher' => '',
    );
  }

  function js_dependency() {
    return array('OpenLayers.Control.StaticLayerSwitcher');
  }

  /**
   * Render.
   */
  function render(&$map) {
    drupal_add_js(drupal_get_path('module', 'staticlayerswitcher') . '/StaticLayerSwitcher.js');
    drupal_add_js(drupal_get_path('module', 'openlayers') .
      '/plugins/behaviors/openlayers_behavior_staticlayerswitcher.js');
    return $this->options;
  }
}
