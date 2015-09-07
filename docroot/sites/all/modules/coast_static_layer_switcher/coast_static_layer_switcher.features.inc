<?php
/**
 * @file
 * coast_static_layer_switcher.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function coast_static_layer_switcher_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "ctools_custom_content" && $api == "ctools_content") {
    return array("version" => "1");
  }
}
