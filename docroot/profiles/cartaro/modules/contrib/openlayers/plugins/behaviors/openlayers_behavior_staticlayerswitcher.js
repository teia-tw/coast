/**
 * @file
 * JS Implementation of OpenLayers behavior.
 */

/**
 * Layer Switcher Behavior
 */
Drupal.openlayers.addBehavior('openlayers_behavior_staticlayerswitcher', function (data, options) {
  Drupal.openlayers.addControl(data.openlayers, 'StaticLayerSwitcher', { 'div': OpenLayers.Util.getElement('layerSwitcherBox') });
});
