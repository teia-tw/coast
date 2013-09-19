layers = [
  "ceremony",
  "industry",
  "scenery",
  "ecosystem",
  "wetland",
  "iba",
  "national_park",
  "national_scenic_area",
  "national_wetland",
  "usage-port",
  "industrial_area",
  "public_construction",
  "landfill",
  "news_flash",
  "field_trip",
  "coastal_cleanup",
  "issue",
  "reef_check_tw",
  "ngo",
];

layers["culture"] = [ "祭祀節慶", "地方產業" ];
layers["landscape"] = [ "地景" ];
layers["nature"] = [ "生態系", "沿海濕地", "重要鳥類棲地" ];
layers["management"] = [ "國家公園", "國家風景區", "重要濕地" ];
layers["usage"] = [ "港口", "濱海／離島工業區", "核電廠／公共建設", "環保公園、垃圾掩埋場" ];
layers["monitor"] = [ "快訊", "實地踏查", "海洋廢棄物監測", "議題", "珊瑚礁體檢", "NGO" ];

category = [ "culture", "landscape", "nature", "management", "usage", "monitor" ];

function refreshLayerIcon() {
  for (var i = 0; i < layers.length; i++) {
    layer = jQuery('.dataLayersDiv #' + layers[i]);
    input = layer.children('input');
    label = layer.children('label');
    if (input.attr('checked')) {
      label.css('background', 'url("/sites/all/themes/coast/images/icons/' + layers[i] + '-item.png") no-repeat scroll 0 0 / 22px 22px transparent');
    } else {
      label.css('background', '');
    }
  };
}

function bindLayerCategories() {
  map = jQuery('.openlayers-map-taiwan_coast').data('openlayers').openlayers;
  for (var i = 0; i < category.length; i++) {

    for (var j = 0; j < layers[category[i]].length; j++) {
      name = layers[category[i]][j];
      layers[category[i]][j] = null;
      for (var k = 0; k < map.layers.length; k++) {
        if (map.layers[k].name == name) {
          layers[category[i]][j] = map.layers[k];
          break;
        }
      };
    };

    jQuery('#' + category[i] + ' label > input').change(function(eventObject) {
      if (eventObject.target.checked) {
        for (var j = 0; j < layers[eventObject.target.name].length; j++) {
          if (layers[eventObject.target.name][j]) {
            layers[eventObject.target.name][j].setVisibility(true);
          }
        };
      } else {
        for (var j = 0; j < layers[eventObject.target.name].length; j++) {
          if (layers[eventObject.target.name][j]) {
            layers[eventObject.target.name][j].setVisibility(false);
          }
        };
      }
    });
  };
}

if (typeof OpenLayers !== 'undefined') {
jQuery(document).ready(function ($) {
  $('.openlayers-map-taiwan_coast').data('openlayers').openlayers.events.register('changelayer', null, refreshLayerIcon);
  refreshLayerIcon();
  bindLayerCategories();
});
}
