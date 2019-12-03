function createOSMap(id, tileUrl, tileLayerOptions, mapOptions, crs) {

    // set a default CRS
    if (typeof crs === 'undefined') {
        crs = new L.Proj.CRS(
            'EPSG:27700',
            '+proj=tmerc +lat_0=49 +lon_0=-2 +k=0.9996012717 +x_0=400000 +y_0=-100000 +ellps=airy +towgs84=446.448,-125.157,542.06,0.15,0.247,0.842,-20.489 +units=m +no_defs',
            {
                origin: [-238375.0, 1376256.0],
                resolutions: [896,448,224,112,56,28,14,7,3.5,1.75,0.875,0.4375,0.21875,0.109375]
            }
        )
    }

    if (typeof mapOptions === 'undefined') {
        mapOptions = {};
    }

    if (typeof tileLayerOptions === 'undefined') {
        tileLayerOptions = {};
    }

    var
        mapOptionsDefault = {
            crs: crs,
            continuousWorld: true,
            maxBounds: [[49.79, -8.82], [60.94, 1.92]]
        },
        tileLayerOptionsDefault = {
            maxZoom: 20,
            minZoom: 0,
            continuousWorld: true,
            attribution: '© Crown copyright and database rights 2019 OS 100050727. Use of this data is subject to terms and conditions.'
        };

    for (var opt1 in mapOptionsDefault) {
        if (mapOptionsDefault.hasOwnProperty(opt1) && !mapOptions.hasOwnProperty(opt1)) {
            mapOptions[opt1] = mapOptionsDefault[opt1];
        }
    }

    for (var opt2 in tileLayerOptionsDefault) {
        if (tileLayerOptionsDefault.hasOwnProperty(opt2) && !tileLayerOptions.hasOwnProperty(opt2)) {
            tileLayerOptions[opt2] = tileLayerOptionsDefault[opt2];
        }
    }

    var map = new L.map(id, mapOptions),
        layer = new L.tileLayer(tileUrl, tileLayerOptions);

    map.addLayer(layer);

    return map;
}
