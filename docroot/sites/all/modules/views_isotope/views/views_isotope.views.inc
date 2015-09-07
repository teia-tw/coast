<?php

/**
 * Implements hook_views_plugins().
 */
function views_isotope_views_plugins() {
  return array(
    'style' => array(
      'isotope_grid' => array(
        'title' => t('Isotope Grid'),
        'help' => t('Display the results using the jQuery Isotope plugin'),
        'handler' => 'views_isotope_plugin_style_isotope_grid',
        'theme' => 'views_isotope_grid',
        'uses options' => TRUE,
        'uses row plugin' => TRUE,
        'uses fields' => TRUE,
        'uses grouping' => FALSE,
        'type' => 'normal',
        'theme file' => 'views_isotope.theme.inc',
      ),
      'isotope_filter' => array(
        'title' => t('Isotope Filter'),
        'help' => t('Display the results formatted to filter an Isotope View'),
        'handler' => 'views_isotope_plugin_style_isotope_filter',
        'theme' => 'views_isotope_filter',
        'uses options' => TRUE,
        'uses row plugin' => TRUE,
        'uses fields' => TRUE,
        'uses grouping' => FALSE,
        'type' => 'normal',
        'theme file' => 'views_isotope.theme.inc',
      ),
      'isotope_sorter' => array(
        'title' => t('Isotope Sort Block'),
        'help' => t('Display the results formatted to sort an Isotope View'),
        'handler' => 'views_isotope_plugin_style_isotope_sorter',
        'theme' => 'views_isotope_sorter',
        'uses options' => TRUE,
        'uses row plugin' => TRUE,
        'uses fields' => TRUE,
        'uses grouping' => FALSE,
        'type' => 'normal',
        'theme file' => 'views_isotope.theme.inc',
      ),
    ),
  );
}
