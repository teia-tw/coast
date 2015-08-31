<?php
/**
 * @file
 * coast_recent_changes.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function coast_recent_changes_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'coast_recent_changes';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = '海岸守護網首頁更新';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = '快訊';
  $handler->display->display_options['css_class'] = 'block-recentchanges';
  $handler->display->display_options['use_more_always'] = TRUE;
  $handler->display->display_options['use_more_text'] = '更多';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['submit_button'] = '套用';
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = '重設';
  $handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = '排序依據';
  $handler->display->display_options['exposed_form']['options']['sort_asc_label'] = '遞增';
  $handler->display->display_options['exposed_form']['options']['sort_desc_label'] = '遞減';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* 頁尾: 全域: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<a href="/library" class="moreLink">more</a>';
  /* 欄位: 內容: 標題 */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Sort criterion: 內容: 發表日期 */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Filter criterion: 內容: 已發表 */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;

  /* Display: 快訊 */
  $handler = $view->new_display('panel_pane', '快訊', 'recent_news_flash');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '快訊';
  $handler->display->display_options['display_description'] = '「快訊」的最新內容';
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* 頁首: 全域: Unfiltered text */
  $handler->display->display_options['header']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['header']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['content'] = '<h1 class="title_news_flash">快訊</h1>
<span class="pic"><a href="#"><img src="/sites/all/themes/coast/images/dummy1.jpg" width="100" height="100" alt="aa" /></a>';
  $handler->display->display_options['defaults']['empty'] = FALSE;
  /* 無查詢結果的行為: 全域: 多行文字欄位 */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = '<h1 class="title_news_flash">快訊</h1>
<p>目前沒有內容。</p>';
  $handler->display->display_options['empty']['area']['format'] = 'html';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: 內容: 已發表 */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: 內容: 類型 */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'news_flash' => 'news_flash',
  );
  $handler->display->display_options['pane_category']['name'] = '海岸守護網';
  $handler->display->display_options['pane_category']['weight'] = '0';
  $handler->display->display_options['allow']['use_pager'] = 0;
  $handler->display->display_options['allow']['items_per_page'] = 'items_per_page';
  $handler->display->display_options['allow']['offset'] = 0;
  $handler->display->display_options['allow']['link_to_view'] = 0;
  $handler->display->display_options['allow']['more_link'] = 'more_link';
  $handler->display->display_options['allow']['path_override'] = 'path_override';
  $handler->display->display_options['allow']['title_override'] = 'title_override';
  $handler->display->display_options['allow']['exposed_form'] = 0;
  $handler->display->display_options['allow']['fields_override'] = 0;

  /* Display: 知識庫 */
  $handler = $view->new_display('panel_pane', '知識庫', 'recent_library');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '知識庫';
  $handler->display->display_options['display_description'] = '知識庫除了「快訊」與「事件簿」的最新內容';
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* 頁首: 全域: Unfiltered text */
  $handler->display->display_options['header']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['header']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['content'] = '<h1 class="title_library">知識庫</h1>
<span class="pic"><a href="#"><img src="/sites/all/themes/coast/images/dummy1.jpg" width="100" height="100" alt="aa" /></a>';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* 頁尾: 全域: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<a href="/library" class="moreLink">more</a>';
  $handler->display->display_options['defaults']['empty'] = FALSE;
  /* 無查詢結果的行為: 全域: 多行文字欄位 */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = '<h1 class="title_library">事件簿</h1>
<p>目前沒有內容。</p>';
  $handler->display->display_options['empty']['area']['format'] = 'html';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: 內容: 已發表 */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: 內容: 類型 */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['operator'] = 'not in';
  $handler->display->display_options['filters']['type']['value'] = array(
    'event' => 'event',
    'news_flash' => 'news_flash',
  );
  $handler->display->display_options['pane_category']['name'] = '海岸守護網';
  $handler->display->display_options['pane_category']['weight'] = '0';
  $handler->display->display_options['allow']['use_pager'] = 0;
  $handler->display->display_options['allow']['items_per_page'] = 'items_per_page';
  $handler->display->display_options['allow']['offset'] = 0;
  $handler->display->display_options['allow']['link_to_view'] = 0;
  $handler->display->display_options['allow']['more_link'] = 'more_link';
  $handler->display->display_options['allow']['path_override'] = 'path_override';
  $handler->display->display_options['allow']['title_override'] = 'title_override';
  $handler->display->display_options['allow']['exposed_form'] = 0;
  $handler->display->display_options['allow']['fields_override'] = 0;

  /* Display: 事件簿 */
  $handler = $view->new_display('panel_pane', '事件簿', 'recent_event');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '快訊';
  $handler->display->display_options['display_description'] = '「事件簿」的最新內容';
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* 頁首: 全域: Unfiltered text */
  $handler->display->display_options['header']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['header']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['content'] = '<h1 class="title_event">事件簿</h1>
<span class="pic"><a href="#"><img src="/sites/all/themes/coast/images/dummy1.jpg" width="100" height="100" alt="aa" /></a>';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* 頁尾: 全域: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<a href="/library" class="moreLink">more</a>';
  $handler->display->display_options['defaults']['empty'] = FALSE;
  /* 無查詢結果的行為: 全域: 多行文字欄位 */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = '<h1 class="title_event">事件簿</h1>
<p>目前沒有內容。</p>';
  $handler->display->display_options['empty']['area']['format'] = 'html';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: 內容: 已發表 */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: 內容: 類型 */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'event' => 'event',
  );
  $handler->display->display_options['pane_category']['name'] = '海岸守護網';
  $handler->display->display_options['pane_category']['weight'] = '0';
  $handler->display->display_options['allow']['use_pager'] = 0;
  $handler->display->display_options['allow']['items_per_page'] = 'items_per_page';
  $handler->display->display_options['allow']['offset'] = 0;
  $handler->display->display_options['allow']['link_to_view'] = 0;
  $handler->display->display_options['allow']['more_link'] = 'more_link';
  $handler->display->display_options['allow']['path_override'] = 'path_override';
  $handler->display->display_options['allow']['title_override'] = 'title_override';
  $handler->display->display_options['allow']['exposed_form'] = 0;
  $handler->display->display_options['allow']['fields_override'] = 0;
  $translatables['coast_recent_changes'] = array(
    t('Master'),
    t('快訊'),
    t('更多'),
    t('套用'),
    t('重設'),
    t('排序依據'),
    t('遞增'),
    t('遞減'),
    t('<a href="/library" class="moreLink">more</a>'),
    t('「快訊」的最新內容'),
    t('<h1 class="title_news_flash">快訊</h1>
<span class="pic"><a href="#"><img src="/sites/all/themes/coast/images/dummy1.jpg" width="100" height="100" alt="aa" /></a>'),
    t('<h1 class="title_news_flash">快訊</h1>
<p>目前沒有內容。</p>'),
    t('海岸守護網'),
    t('知識庫'),
    t('知識庫除了「快訊」與「事件簿」的最新內容'),
    t('<h1 class="title_library">知識庫</h1>
<span class="pic"><a href="#"><img src="/sites/all/themes/coast/images/dummy1.jpg" width="100" height="100" alt="aa" /></a>'),
    t('<h1 class="title_library">事件簿</h1>
<p>目前沒有內容。</p>'),
    t('事件簿'),
    t('「事件簿」的最新內容'),
    t('<h1 class="title_event">事件簿</h1>
<span class="pic"><a href="#"><img src="/sites/all/themes/coast/images/dummy1.jpg" width="100" height="100" alt="aa" /></a>'),
    t('<h1 class="title_event">事件簿</h1>
<p>目前沒有內容。</p>'),
  );
  $export['coast_recent_changes'] = $view;

  return $export;
}
