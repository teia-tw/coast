<?php
/**
 * @file
 * coast_frontpage_animation.ctools_content.inc
 */

/**
 * Implements hook_default_ctools_custom_content().
 */
function coast_frontpage_animation_default_ctools_custom_content() {
  $export = array();

  $content = new stdClass();
  $content->disabled = FALSE; /* Edit this to true to make a default content disabled initially */
  $content->api_version = 1;
  $content->name = 'coast_frontpage_animation';
  $content->admin_title = '海岸守護網首頁動畫';
  $content->admin_description = '';
  $content->category = '海岸守護網';
  $content->settings = array(
    'admin_title' => '',
    'title' => '',
    'body' => '<div id="slider">
<div class="slider">
<div style="height:318px; overflow:hidden">
<span id="s1"><img src="/sites/all/themes/coast/images/slider/s1.jpg" width="950" height="318" alt="海岸，是陸地的延伸，與海洋溝通的橋樑！" /></span>
<span id="s2"><img src="/sites/all/themes/coast/images/slider/s2.jpg" width="950" height="318" alt="台灣島四面環海 本島海岸線總長約1250公里 卻蘊含了豐富多樣的生態並造就了各式特殊的產業和文化" /></span>
<span id="s3"><img src="/sites/all/themes/coast/images/slider/s3.jpg" width="950" height="318" alt="你可知道台灣的海岸線就有五種不同的生態系嗎?" /></span>
<span id="s4"><img src="/sites/all/themes/coast/images/slider/s4.jpg" width="950" height="318" alt="從河口泥灘到大陸棚、岩礁、珊瑚礁、大洋生態系" /></span>
<span id="s5"><img src="/sites/all/themes/coast/images/slider/s5.jpg" width="950" height="318" alt="是候鳥的重要渡冬地，也是海豚的家" /></span>
<span id="s6"><img src="/sites/all/themes/coast/images/slider/s6.jpg" width="950" height="318" alt="看似長長一圈海岸線，卻又段段各具特色 減少一公里，就減少了十分的多樣與色彩" /></span>
<span id="s7"><img src="/sites/all/themes/coast/images/slider/s7.jpg" width="950" height="318" alt="請和我們一起來瞭解台灣海岸的特色與珍貴 一起守護這一切的美好！" /></span></div>
<!-- class "slider" 的內容放在這裡-->
</div>
<!-- id "slider" 的內容放在這裡-->
</div>
',
    'format' => 'html',
    'substitute' => 1,
  );
  $export['coast_frontpage_animation'] = $content;

  return $export;
}
