<?php

$page = new stdClass();
$page->disabled = FALSE; /* Edit this to true to make a default page disabled initially */
$page->api_version = 1;
$page->name = 'library_nature_iba';
$page->task = 'page';
$page->admin_title = '知識庫: 自然資源: 重要鳥類棲息地';
$page->admin_description = '';
$page->path = 'library/nature/iba';
$page->access = array();
$page->menu = array(
  'type' => 'normal',
  'title' => '重要鳥類棲息地',
  'name' => 'main-menu',
  'weight' => '0',
  'parent' => array(
    'type' => 'none',
    'title' => '',
    'name' => 'navigation',
    'weight' => '0',
  ),
);
$page->arguments = array();
$page->conf = array(
  'admin_paths' => FALSE,
);
$page->default_handlers = array();
$handler = new stdClass();
$handler->disabled = FALSE; /* Edit this to true to make a default handler disabled initially */
$handler->api_version = 1;
$handler->name = 'page_library_nature_iba_panel_context';
$handler->task = 'page';
$handler->subtask = 'library_nature_iba';
$handler->handler = 'panel_context';
$handler->weight = 0;
$handler->conf = array(
  'title' => 'Panel',
  'no_blocks' => 0,
  'pipeline' => 'ipe',
  'body_classes_to_remove' => '',
  'body_classes_to_add' => '',
  'css_id' => '',
  'css' => '',
  'contexts' => array(),
  'relationships' => array(),
);
$display = new panels_display();
$display->layout = 'one';
$display->layout_settings = array();
$display->panel_settings = array(
  'style_settings' => array(
    'default' => NULL,
    'one_main' => NULL,
  ),
);
$display->cache = array();
$display->title = '重要鳥類棲息地';
$display->content = array();
$display->panels = array();
$display->hide_title = PANELS_TITLE_FIXED;
$display->title_pane = '0';
$handler->conf['display'] = $display;
$page->default_handlers[$handler->name] = $handler;

