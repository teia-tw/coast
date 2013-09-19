<?php
/**
 * @file
 * theme_configurations_settings.features.filter.inc
 */

/**
 * Implements hook_filter_default_formats().
 */
function theme_configurations_settings_filter_default_formats() {
  $formats = array();

  // Exported format: Full HTML.
  $formats['full_html'] = array(
    'format' => 'full_html',
    'name' => 'Full HTML',
    'cache' => 1,
    'status' => 1,
    'weight' => -10,
    'filters' => array(),
  );

  return $formats;
}
