
; API
api = 2

; Core
core = 7.16

; Contrib modules
projects[ctools][version] = 1.2
projects[ctools][subdir]  = contrib
projects[features][version] = 1.0
projects[features][subdir]  = contrib
projects[feeds][version] = 2.0-alpha6
projects[feeds][subdir]  = contrib
projects[geoserver][version] = 1.0-beta2
projects[geoserver][subdir]  = contrib
projects[job_scheduler][version] = 2.0-alpha3
projects[job_scheduler][subdir] = contrib
projects[nodetype_access][version] = 1.0-beta5
projects[nodetype_access][subdir]  = contrib
projects[ole][version] = 1.0-beta2
projects[ole][subdir]  = contrib
projects[openlayers][version] = 2.x-dev
projects[openlayers][subdir]  = contrib
projects[openlayers][patch][] = http://drupal.org/files/openlayers-add_baselayers_first-1817400-1.patch
projects[openlayers_layer_assistant][version] = 1.0-beta1
projects[openlayers_layer_assistant][subdir]  = contrib
projects[pathauto][version] = 1.2
projects[pathauto][subdir]  = contrib
projects[postgis][version] = 1.0-beta2
projects[postgis][subdir]  = contrib
projects[token][version] = 1.4
projects[token][subdir]  = contrib
projects[views][version] = 3.5
projects[views][subdir]  = contrib

; Contrib themes
projects[frontmap][version] = 1.0-beta1
projects[frontmap][type] = theme

; Libraries
libraries[ole][download][type] = file
libraries[ole][download][url]  = https://github.com/downloads/geops/ole/ole-1.0-beta2.tar.gz
libraries[ole][download][subtree]     = client
libraries[openlayers][download][type] = file
libraries[openlayers][download][url]  = http://openlayers.org/download/OpenLayers-2.12.tar.gz
;libraries[geoserver-sec-drupal][destination] = geoserver
;libraries[geoserver-sec-drupal][download][unpack] = false
;libraries[geoserver-sec-drupal][download][url]  = https://github.com/downloads/geops/geoserver-sec-drupal/geoserver-sec-drupal-2.2.jar