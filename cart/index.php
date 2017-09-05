<?php require_once('../config.php');  ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Layer Swipe</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.3.1/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.3.1/build/ol.js"></script>
  </head>
  <body>
    <div id="map" class="map"></div>
    <input id="swipe" type="range" style="width: 100%">
    <script>
      var osm = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

      var wms_source = new ol.source.TileWMS({
                          url: 'http://datageo.ambiente.sp.gov.br:80/geoimage/datageoimg/ORTOFOTOS_CDHU_VALE_DO_PARAIBA_2007/ows',
                          name: 'ORTOFOTOS_CDHU_VALE_DO_PARAIBA_2007',
                          params: {'FORMAT': 'image/png',
                                   'VERSION': '1.1.1',
                                   tiled: true,
                                   STYLES: ''}
                          });

      var wms_layer = new ol.layer.Tile({
           source:  wms_source
      });

      var bing = new ol.layer.Tile({
        source: new ol.source.BingMaps({
          key: '<?php echo BING_API; ?>',
          imagerySet: 'Aerial'
        })
      });

      var map = new ol.Map({
        layers: [wms_layer, bing],
        target: 'map',
        controls: ol.control.defaults({
          attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
            collapsible: false
          })
        }),
        view: new ol.View({
          center: [0, 0],
          zoom: 2
        })
      });

      var swipe = document.getElementById('swipe');

      bing.on('precompose', function(event) {
        var ctx = event.context;
        var width = ctx.canvas.width * (swipe.value / 100);

        ctx.save();
        ctx.beginPath();
        ctx.rect(width, 0, ctx.canvas.width - width, ctx.canvas.height);
        ctx.clip();
      });

      bing.on('postcompose', function(event) {
        var ctx = event.context;
        ctx.restore();
      });

      swipe.addEventListener('input', function() {
        map.render();
      }, false);
    </script>
  </body>
</html>
