<?php
/**
 * @file
 * theme_configurations_settings.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function theme_configurations_settings_user_default_permissions() {
  $permissions = array();

  // Exported permission: access contextual links.
  $permissions['access contextual links'] = array(
    'name' => 'access contextual links',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'contextual',
  );

  // Exported permission: search content.
  $permissions['search content'] = array(
    'name' => 'search content',
    'roles' => array(),
    'module' => 'search',
  );

  // Exported permission: send newsletter.
  $permissions['send newsletter'] = array(
    'name' => 'send newsletter',
    'roles' => array(),
    'module' => 'simplenews',
  );

  // Exported permission: subscribe to newsletters.
  $permissions['subscribe to newsletters'] = array(
    'name' => 'subscribe to newsletters',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'simplenews',
  );

  // Exported permission: translate content.
  $permissions['translate content'] = array(
    'name' => 'translate content',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'translation',
  );

  // Exported permission: translate interface.
  $permissions['translate interface'] = array(
    'name' => 'translate interface',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'locale',
  );

  // Exported permission: use advanced search.
  $permissions['use advanced search'] = array(
    'name' => 'use advanced search',
    'roles' => array(),
    'module' => 'search',
  );

  return $permissions;
}
