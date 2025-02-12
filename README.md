# OS Maps plugin for Craft CMS 5.x

Allows you to display Ordnance Survey maps on your Craft CMS website.

## Requirements

This plugin requires [PHP](https://www.php.net/) 7.4 - 8.2 and supports [Craft CMS](https://www.craftcms.com/) 3.x, 4.x and 5.x.

| OS Maps  | Craft 3            | Craft 4            | Craft 5            |
|----------|--------------------|--------------------|--------------------|
| 1.x      | :white_check_mark: | :x:                | :x:                |
| 2.x      | :x:                | :white_check_mark: | :x:                |
| 3.x      | :x:                | :x:                | :white_check_mark: |


## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

       cd /path/to/project

2. Then tell Composer to load the plugin:

       composer require burnthebook/craft3-osmaps

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for OS Maps.

## Configuration

1. Add your OS Maps API Key on the plugin's settings page in the Control Panel.

2. Set a Max Zoom Level value. This is usually 10 if you are not allowed to display the OS MasterMap Topography Layer.

## Using OS Maps 

Add the following to your twig template and modify where necessary.

```twig
{% do view.registerAssetBundle("Burnthebook\\OSMaps\\assetbundles\\OSMaps\\OSMapsAsset") %}

{% set tileUrl = craft.osMaps.getApiUrl() %}
{% set maxZoomLevel = craft.osMaps.getMaxZoomLevel() %}
{% set zoomLevel = 10 %}
{% set lat = 52.921309 %}
{% set long = -1.475118 %}

<div id="map" style="height: 500px; width: 500px;"></div>

{% js %}
    var map = createOSMap('map', '{{ tileUrl }}', { maxZoom: {{ maxZoomLevel }} });
    var latlng = [{{ lat }}, {{ long }}];
   
    map.setView(latlng, {{ zoomLevel }});
    L.marker(latlng).addTo(map);
{% endjs %}
```

See the [Leaflet Documentation](https://leafletjs.com/reference-1.0.3.html) for reference on using the `L` JavaScript object.

Note that the `createOSMap()` function returns a Leaflet Map object.

## Advanced usage

The `getApiUrl()` method accepts an object with options.

See the [OS Maps Documentation](https://apidocs.os.uk/docs/os-maps-wmts) for more details.

The default options we define are:

```twig
{% set tileUrl = craft.osMaps.getApiUrl({
    'service': 'WMTS',
    'request': 'GetTile',
    'version': '1.0.0',
    'layer': 'Road 27700',
    'style': 'true',
    'format': 'image/png',
    'tileMatrixSet': 'EPSG:27700',
    'tileMatrix': 'EPSG:27700:{z}',
    'tileRow': '{y}',
    'tileCol': '{x}'
}) %}
```

If you are using Google Maps in the Control Panel (e.g. Maps plugin), you will want to convert the Google Maps zoom level to an OS Maps zoom level:

```twig
{% set zoomLevel = craft.osMaps.convertGMapsZoomLevel(entry.map.zoom) %}
```

The JavaScript function `createOSMap()` accepts the following parameters:

- id : ID of the Map's HTML element
- tileUrl : URL to fetch tiles from
- tileLayerOptions : Options for the Leaflet TileLayer object. See the Leaflet documentation for more details.
- mapOptions : Options for the Leaflet Map object. See the Leaflet documentation for more details.
- crs : An optional CRS object. See the Leaflet and/or Proj4leaflet documentations for instructions on creating a CRS object. It's fairly complicated. We provide a default CRS object for EPSG:27700

The function returns a standard Leaflet Map object. Do with it as you wish.

The Leaflet library (`L` object in JS) is also globally exposed should you wish to use it e.g. for adding markers or manipulating the map.

## A note on performance

We are proxying all tile requests via the plugin (Craft) in order to keep the OS API key hidden from the public.
This isn't the best approach from a performance perspective, however it is required by OS.

To illustrate this:

Map (front-end) <--> OS Maps Plugin (Craft) <--> OS Maps API

When users interact with a map (zooming/panning) this will trigger lots of requests to your server - one request for each tile to be more precise!
If you have lots of users and lots of maps on your site, this could become a problem!

A possible solution would be to place your website over a CDN e.g. CloudFlare and enable full-page caching on all requests to `/actions/os-maps/api/*`, where `/actions/` is your [actionTrigger](https://docs.craftcms.com/v3/config/config-settings.html#actiontrigger) config setting (`actions` by default). 

Just note that you'd have to clear the CDN cache when/if OS update any tiles.

## Useful resources

- https://apidocs.os.uk/docs/os-maps-wmts
- https://leafletjs.com/reference-1.0.3.html
- https://github.com/kartena/Proj4Leaflet
- https://epsg.io/27700

---

Brought to you by [Burnthebook](https://www.burnthebook.co.uk)
