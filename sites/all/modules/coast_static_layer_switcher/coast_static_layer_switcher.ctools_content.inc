<?php
/**
 * @file
 * coast_static_layer_switcher.ctools_content.inc
 */

/**
 * Implements hook_default_ctools_custom_content().
 */
function coast_static_layer_switcher_default_ctools_custom_content() {
  $export = array();

  $content = new stdClass();
  $content->disabled = FALSE; /* Edit this to true to make a default content disabled initially */
  $content->api_version = 1;
  $content->name = 'coast_staticlayerswitcher';
  $content->admin_title = '海岸守護網圖層選單';
  $content->admin_description = '';
  $content->category = '海岸守護網';
  $content->settings = array(
    'admin_title' => '',
    'title' => '',
    'body' => '<div id="layerSwitcherBox">
    <div class="layersDiv">
        <div class="dataLayersDiv">
            <ul class="layerLevel1">
                <li id="culture"><label id="layer-culture" class="labelSpan"><input type="checkbox" name="culture">人文</label>
                    <ul class="layerLevel2">
                        <li id="ceremony">
                            <input type="checkbox" class="olButton 祭祀節慶">
                            <label class="labelSpan olButton 祭祀節慶">祭祀節慶</label>
                        </li>
                        <li id="industry">
                            <input type="checkbox" class="olButton 地方產業">
                            <label class="labelSpan olButton 地方產業">地方產業</label>
                        </li>
                    </ul>
                </li>
                <li id="landscape"><label id="layer-landscape" class="labelSpan"><input type="checkbox" name="landscape">海岸地景</label>
                    <ul class="layerLevel2">
                        <li id="scenery">
                            <input type="checkbox" class="olButton 地景">
                            <label class="labelSpan olButton 地景">地景</label>
                        </li>
                    </ul>
                </li>
                <li id="nature"><label id="layer-nature" class="labelSpan"><input type="checkbox" name="nature">自然資源</label>
                    <ul class="layerLevel2">
                        <li id="ecosystem">
                            <input type="checkbox" class="olButton 生態系">
                            <label class="labelSpan olButton 生態系">生態系</label>
                        </li>
                        <li id="wetland">
                            <input type="checkbox" class="olButton 沿海濕地">
                            <label class="labelSpan olButton 沿海濕地">沿海濕地</label>
                        </li>
                        <li id="iba">
                            <input type="checkbox" class="olButton 重要鳥類棲地">
                            <label class="labelSpan olButton 重要鳥類棲地">重要鳥類棲地</label>
                        </li>
                    </ul>
                </li>
                <li id="management"><label id="layer-management" class="labelSpan"><input type="checkbox" name="management">海岸管理</label>
                    <ul class="layerLevel2">
                        <li id="national_park">
                            <input type="checkbox" class="olButton 國家公園">
                            <label class="labelSpan olButton 國家公園">國家公園</label>
                        </li>
                        <li id="national_scenic_area">
                            <input type="checkbox" class="olButton 國家風景區">
                            <label class="labelSpan olButton 國家風景區">國家風景區</label>
                        </li>
                        <li id="national_wetland">
                            <input type="checkbox" class="olButton 重要濕地">
                            <label class="labelSpan olButton 重要濕地">重要濕地</label>
                        </li>
                    </ul>
                </li>
                <li id="usage"><label id="layer-usage" class="labelSpan"><input type="checkbox" name="usage">海岸使用</label>
                    <ul class="layerLevel2">
                        <li id="industrial_area">
                            <input type="checkbox" class="olButton 濱海／離島工業區">
                            <label class="labelSpan olButton 濱海／離島工業區">濱海／離島工業區</label>
                        </li>
                        <li id="public_construction">
                            <input type="checkbox" class="olButton 核電廠／公共建設">
                            <label class="labelSpan olButton 核電廠／公共建設">核電廠／公共建設</label>
                        </li>
                        <li id="landfill">
                            <input type="checkbox" class="olButton 環保公園、垃圾掩埋場">
                            <label class="labelSpan olButton 環保公園、垃圾掩埋場">環保公園、掩埋場</label>
                        </li>
                    </ul>
                </li>
                <li id="monitor"><label id="layer-monitor" class="labelSpan"><input type="checkbox" name="monitor">海岸監測</label>
                    <ul class="layerLevel2">
                        <li id="news_flash">
                            <input type="checkbox" class="olButton 快訊">
                            <label class="labelSpan olButton 快訊">快訊</label>
                        </li>
                        <li id="field_trip">
                            <input type="checkbox" class="olButton 實地踏查">
                            <label class="labelSpan olButton 實地踏查">實地踏查</label>
                        </li>
                        <li id="coastal_cleanup">
                            <input type="checkbox" class="olButton 海洋廢棄物監測">
                            <label class="labelSpan olButton 海洋廢棄物監測">海洋廢棄物監測</label>
                        </li>
                        <li id="issue">
                            <input type="checkbox" class="olButton 議題">
                            <label class="labelSpan olButton 議題">議題</label>
                        </li>
                        <li id="reef_check_tw">
                            <input type="checkbox" class="olButton 珊瑚礁體檢">
                            <label class="labelSpan olButton 珊瑚礁體檢">珊瑚礁體檢</label>
                        </li>
                        <li id="ngo">
                            <input type="checkbox" class="olButton ngo">
                            <label class="labelSpan olButton ngo">NGO</label>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
',
    'format' => 'html',
    'substitute' => 0,
  );
  $export['coast_staticlayerswitcher'] = $content;

  return $export;
}
