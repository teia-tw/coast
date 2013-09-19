/**
 * @file
 * JS Implementation of OpenLayers behavior.
 */

/* Copyright (c) 2006-2013 by OpenLayers Contributors (see authors.txt for
 * full list of contributors). Published under the 2-clause BSD license.
 * See license.txt in the OpenLayers distribution or repository for the
 * full text of the license. */

function getElementsByClassName(node, classname) {
    var a = [];
    var re = new RegExp('(^| )'+classname+'( |$)');
    var els = node.getElementsByTagName("*");
    for(var i=0,j=els.length; i<j; i++)
        if(re.test(els[i].className))a.push(els[i]);
    return a;
}

/**
 * @requires OpenLayers/Control.js
 * @requires OpenLayers/Lang.js
 * @requires OpenLayers/Util.js
 * @requires OpenLayers/Events/buttonclick.js
 */

/**
 * Class: OpenLayers.Control.LayerSwitcher
 * The LayerSwitcher control displays a table of contents for the map. This
 * allows the user interface to switch between BaseLasyers and to show or hide
 * Overlays. By default the switcher is shown minimized on the right edge of
 * the map, the user may expand it by clicking on the handle.
 *
 * To create the LayerSwitcher outside of the map, pass the Id of a html div
 * as the first argument to the constructor.
 *
 * Inherits from:
 *  - <OpenLayers.Control>
 */
if (typeof OpenLayers !== 'undefined') {
OpenLayers.Control.StaticLayerSwitcher = OpenLayers.Class(OpenLayers.Control, {

    /**  
     * Property: layerStates 
     * {Array(Object)} Basically a copy of the "state" of the map's layers 
     *     the last time the control was drawn. We have this in order to avoid
     *     unnecessarily redrawing the control.
     */
    layerStates: null,

  // DOM Elements

    /**
     * Property: layersDiv
     * {DOMElement}
     */
    layersDiv: null,

    /**
     * Property: baseLayersDiv
     * {DOMElement}
     */
    baseLayersDiv: null,

    /**
     * Property: baseLayers
     * {Array(Object)}
     */
    baseLayers: null,


    /**
     * Property: dataLbl
     * {DOMElement}
     */
    dataLbl: null,

    /**
     * Property: dataLayersDiv
     * {DOMElement}
     */
    dataLayersDiv: null,

    /**
     * Property: dataLayers
     * {Array(Object)}
     */
    dataLayers: null,


    /**
     * Property: minimizeDiv
     * {DOMElement}
     */
    minimizeDiv: null,

    /**
     * Property: maximizeDiv
     * {DOMElement}
     */
    maximizeDiv: null,

    /**
     * APIProperty: ascending
     * {Boolean}
     */
    ascending: true,

    /**
     * Constructor: OpenLayers.Control.LayerSwitcher
     *
     * Parameters:
     * options - {Object}
     */
    initialize: function(options) {
        OpenLayers.Control.prototype.initialize.apply(this, arguments);
        this.layerStates = [];
    },

    /**
     * APIMethod: destroy
     */
    destroy: function() {

        //clear out layers info and unregister their events
        this.clearLayersArray("base");
        this.clearLayersArray("data");

        this.map.events.un({
            buttonclick: this.onButtonClick,
            addlayer: this.redraw,
            changelayer: this.redraw,
            removelayer: this.redraw,
            changebaselayer: this.redraw,
            scope: this
        });
        this.events.unregister("buttonclick", this, this.onButtonClick);

        OpenLayers.Control.prototype.destroy.apply(this, arguments);
    },

    /**
     * Method: setMap
     *
     * Properties:
     * map - {<OpenLayers.Map>}
     */
    setMap: function(map) {
        OpenLayers.Control.prototype.setMap.apply(this, arguments);

        this.map.events.on({
            addlayer: this.redraw,
            changelayer: this.redraw,
            removelayer: this.redraw,
            changebaselayer: this.redraw,
            scope: this
        });
        if (this.outsideViewport) {
            this.events.attachToElement(this.div);
            this.events.register("buttonclick", this, this.onButtonClick);
        } else {
            this.map.events.register("buttonclick", this, this.onButtonClick);
        }
    },

    /**
     * Method: draw
     *
     * Returns:
     * {DOMElement} A reference to the DIV DOMElement containing the
     *     switcher tabs.
     */
    draw: function() {
        OpenLayers.Control.prototype.draw.apply(this);

        // create layout divs
        this.loadContents();

        // set mode to minimize
        if(!this.outsideViewport) {
            this.minimizeControl();
        }

        // populate div with current info
        this.redraw();

        return this.div;
    },

    /**
     * Method: onButtonClick
     *
     * Parameters:
     * evt - {Event}
     */
    onButtonClick: function(evt) {
        var button = evt.buttonElement;
        if (button === this.minimizeDiv) {
            this.minimizeControl();
        } else if (button === this.maximizeDiv) {
            this.maximizeControl();
        } else if (button._layerSwitcher === this.id) {
            if (button["for"]) {
                button = document.getElementById(button["for"]);
            }
            if (!button.disabled) {
                if (button.type == "radio") {
                    button.checked = true;
                    this.map.setBaseLayer(this.map.getLayer(button._layer));
                } else {
                    button.checked = !button.checked;
                    this.updateMap();
                }
            }
        }
    },

    /**
     * Method: clearLayersArray
     * User specifies either "base" or "data". we then clear all the
     *     corresponding listeners, the div, and reinitialize a new array.
     *
     * Parameters:
     * layersType - {String}
     */
    clearLayersArray: function(layersType) {
        //if (this[layersType + "LayersDiv"]) this[layersType + "LayersDiv"].innerHTML = "";
        this[layersType + "Layers"] = [];
    },


    /**
     * Method: checkRedraw
     * Checks if the layer state has changed since the last redraw() call.
     *
     * Returns:
     * {Boolean} The layer state changed since the last redraw() call.
     */
    checkRedraw: function() {
        if ( !this.layerStates.length ||
             (this.map.layers.length != this.layerStates.length) ) {
            return true;
        }

        for (var i = 0, len = this.layerStates.length; i < len; i++) {
            var layerState = this.layerStates[i];
            var layer = this.map.layers[i];
            if ( (layerState.name != layer.name) ||
                 (layerState.inRange != layer.inRange) ||
                 (layerState.id != layer.id) ||
                 (layerState.visibility != layer.visibility) ) {
                return true;
            }
        }

        return false;
    },

    /**
     * Method: redraw
     * Goes through and takes the current state of the Map and connects the
     *     controls in DOM to display that state.
     *
     * Returns:
     * {DOMElement} A reference to the DIV DOMElement containing the control
     */
    redraw: function() {
        //if the state hasn't changed since last redraw, no need
        // to do anything. Just return the existing div.
        if (!this.checkRedraw()) {
            return this.div;
        }

        //clear out previous layers
        this.clearLayersArray("base");
        this.clearLayersArray("data");

        var containsOverlays = false;
        var containsBaseLayers = false;

        // Save state -- for checking layer if the map state changed.
        // We save this before redrawing, because in the process of redrawing
        // we will trigger more visibility changes, and we want to not redraw
        // and enter an infinite loop.
        var len = this.map.layers.length;
        this.layerStates = new Array(len);
        for (var i=0; i <len; i++) {
            var layer = this.map.layers[i];
            this.layerStates[i] = {
                'name': layer.name,
                'visibility': layer.visibility,
                'inRange': layer.inRange,
                'id': layer.id
            };
        }

        var layers = this.map.layers.slice();

        var elems  = getElementsByClassName(this.div, "olButton");
        var inputs = [];
        var labels = [];
        for (var i=0, len=elems.length; i<len; i++) {
            var elem = elems[i];
            names = elem.className.split(" ");
            for (var j=0; j<names.length; j++) {
                if (names[j] != "olButton") {
                    if (elem.tagName == "LABEL") {
                        labels[names[j]] = elem;
                    } else if (elem.tagName == "INPUT") {
                        inputs[names[j]] = elem;
                    }
                }
            }
        }

        for(var i=0, len=layers.length; i<len; i++) {
            var layer = layers[i];
            var baseLayer = layer.isBaseLayer;

            if (layer.displayInLayerSwitcher) {

                if (baseLayer) {
                    containsBaseLayers = true;
                } else {
                    containsOverlays = true;
                }

                // only check a baselayer if it is *the* baselayer, check data
                //  layers if they are visible
                var checked = (baseLayer) ? (layer == this.map.baseLayer)
                                          : layer.getVisibility();

                var layerClassName = layer.name.replace(/ /g, "-").toLowerCase();
                // connect to input element
                var inputElem = inputs[layerClassName];
                if (inputElem) {
                    // The input shall have an id attribute so we can use
                    // labels to interact with them.
                    var inputId = OpenLayers.Util.createUniqueID(
                            this.id + "_input_"
                        );
                    inputElem.id = inputId;
                    inputElem.name = (baseLayer) ? this.id + "_baseLayers" : layer.name;
                    inputElem.type = (baseLayer) ? "radio" : "checkbox";
                    inputElem.value = layer.name;
                    inputElem.checked = checked;
                    inputElem.defaultChecked = checked;
                    inputElem._layer = layer.id;
                    inputElem._layerSwitcher = this.id;

                    if (!baseLayer && !layer.inRange) {
                        inputElem.disabled = true;
                    }

                    // connect span
                    var labelSpan = labels[layerClassName];
                    if (labelSpan) {
                        // this isn't the DOM attribute 'for', but an arbitrary name we
                        // use to find the appropriate input element in <onButtonClick>
                        labelSpan["for"] = inputElem.id;
                        OpenLayers.Element.addClass(labelSpan, "labelSpan olButton");
                        labelSpan._layer = layer.id;
                        labelSpan._layerSwitcher = this.id;
                        if (!baseLayer && !layer.inRange) {
                            labelSpan.style.color = "gray";
                        }
                        labelSpan.innerHTML = layer.name;
                        labelSpan.style.verticalAlign = (baseLayer) ? "bottom"
                                                                    : "baseline";
                    }

                    var groupArray = (baseLayer) ? this.baseLayers
                                                 : this.dataLayers;
                    groupArray.push({
                        'layer': layer,
                        'inputElem': inputElem,
                        'labelSpan': labelSpan
                    });

                }
            }
        }

        // if no overlays, dont display the overlay label
        if (this.dataLbl) this.dataLbl.style.display = (containsOverlays) ? "" : "none";

        // if no baselayers, dont display the baselayer label
        if (this.baseLbl) this.baseLbl.style.display = (containsBaseLayers) ? "" : "none";

        return this.div;
    },

    /**
     * Method: updateMap
     * Cycles through the loaded data and base layer input arrays and makes
     *     the necessary calls to the Map object such that that the map's
     *     visual state corresponds to what the user has selected in
     *     the control.
     */
    updateMap: function() {

        // set the newly selected base layer
        for(var i=0, len=this.baseLayers.length; i<len; i++) {
            var layerEntry = this.baseLayers[i];
            if (layerEntry.inputElem.checked) {
                this.map.setBaseLayer(layerEntry.layer, false);
            }
        }

        // set the correct visibilities for the overlays
        for(var i=0, len=this.dataLayers.length; i<len; i++) {
            var layerEntry = this.dataLayers[i];
            layerEntry.layer.setVisibility(layerEntry.inputElem.checked);
        }

    },

    /**
     * Method: maximizeControl
     * Set up the labels and divs for the control
     *
     * Parameters:
     * e - {Event}
     */
    maximizeControl: function(e) {

        // set the div's width and height to empty values, so
        // the div dimensions can be controlled by CSS
        this.div.style.width = "";
        this.div.style.height = "";

        this.showControls(false);

        if (e != null) {
            OpenLayers.Event.stop(e);
        }
    },

    /**
     * Method: minimizeControl
     * Hide all the contents of the control, shrink the size,
     *     add the maximize icon
     *
     * Parameters:
     * e - {Event}
     */
    minimizeControl: function(e) {

        // to minimize the control we set its div's width
        // and height to 0px, we cannot just set "display"
        // to "none" because it would hide the maximize
        // div
        this.div.style.width = "0px";
        this.div.style.height = "0px";

        this.showControls(true);

        if (e != null) {
            OpenLayers.Event.stop(e);
        }
    },

    /**
     * Method: showControls
     * Hide/Show all LayerSwitcher controls depending on whether we are
     *     minimized or not
     *
     * Parameters:
     * minimize - {Boolean}
     */
    showControls: function(minimize) {

        if (this.maximizeDiv) this.maximizeDiv.style.display = minimize ? "" : "none";
        if (this.minimizeDiv) this.minimizeDiv.style.display = minimize ? "none" : "";
        if (this.layersDiv) this.layersDiv.style.display = minimize ? "none" : "";
    },

    /**
     * Method: loadContents
     * Connect to labels and divs for the control in DOM
     */
    loadContents: function() {

        // layers list div
        this.layersDiv = getElementsByClassName(document, "layersDiv")[0];
        if (this.layersDiv) this.layersDiv.id = this.id + "_layersDiv";

        this.baseLbl = getElementsByClassName(document, "baseLbl")[0];
        this.baseLayersDiv = getElementsByClassName(document, "baseLayersDiv")[0];
        this.dataLbl = getElementsByClassName(document, "dataLbl")[0];
        this.dataLayersDiv = getElementsByClassName(document, "dataLayersDiv")[0];

        this.maximizeDiv = getElementsByClassName(document, "maximizeDiv")[0];
        if (this.maximizeDiv) this.maximizeDiv.style.display = "none";
        this.minimizeDiv = getElementsByClassName(document, "minimizeDiv")[0];
        if (this.minimizeDiv) this.minimizeDiv.style.display = "none";
    },

    CLASS_NAME: "OpenLayers.Control.StaticLayerSwitcher"
});
}
