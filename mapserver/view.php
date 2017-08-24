<?php
    require_once('functions.php');
    global $project;
    global $camadas;
    global $camada;
  	$project = find('mapsrv.mps01_projetos', $_GET['cdprj'], 'mps01_cd_prj');

    $camadas = find_cam_prj($_GET['cdprj']);

    // $camadas = find_all('mapsrv.mps03_camadas');

?>


<?php include(HEADER_TEMPLATE_FULL); ?>




<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

<link rel="stylesheet" href="/css/ol.css">
<style type="text/css">
  body { overflow: hidden; }

  .navbar-offset { margin-top: 10px; }
  #map { position: absolute; top: 50px; bottom: 0px; left: 0px; right: 0px; }
  #map .ol-zoom { font-size: 1.2em; left: 20px; }

  .zoom-top-opened-sidebar { margin-top: 5px; }
  .zoom-top-collapsed { margin-top: 45px;}

  .mini-submenu{
    display:none;
    background-color: rgba(255, 255, 255, 0.46);
    border: 1px solid rgba(0, 0, 0, 0.9);
    border-radius: 4px;
    padding: 9px;
    /*position: relative;*/
    width: 42px;
    text-align: center;
  }

  .mini-submenu-left {
    position: absolute;
    top: 60px;
    left: .5em;
    z-index: 40;
  }

  #map { z-index: 35; }

  .sidebar { z-index: 45; }

  .main-row { position: relative; top: 0; }
  .main-btn { position: relative; top: 0; z-index: 55; }

  .mini-submenu:hover{
    cursor: pointer;
  }

  .slide-submenu{

    display: inline-block;
    padding: 0 8px;
    border-radius: 4px;
    cursor: pointer;
  }

</style>
<link rel="stylesheet" href="https://openlayers.org/en/v4.3.1/css/ol.css" type="text/css">
<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
<script src="https://openlayers.org/en/v4.3.1/build/ol.js"></script>
<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>


<script type="text/javascript">

// FUNÇÕES de aumentar e diminuir o menu de camadas
  function applyMargins() {
    var leftToggler = $(".mini-submenu-left");
    if (leftToggler.is(":visible")) {
      $("#map .ol-zoom")
        .css("margin-left", 0)
        .removeClass("zoom-top-opened-sidebar")
        .addClass("zoom-top-collapsed");
    } else {
      $("#map .ol-zoom")
        .css("margin-left", $(".sidebar-left").width())
        .removeClass("zoom-top-opened-sidebar")
        .removeClass("zoom-top-collapsed");
    }
  }

  function isConstrained() {
    return $(".sidebar").width() == $(window).width();
  }

  function applyInitialUIState() {
    if (isConstrained()) {
      $(".sidebar-left .sidebar-body").fadeOut('slide');
      $('.mini-submenu-left').fadeIn();
    }
  }

  $(function(){
    $('.sidebar-left .slide-submenu').on('click',function() {
      var thisEl = $(this);
      thisEl.closest('.sidebar-body').fadeOut('slide',function(){
        $('.mini-submenu-left').fadeIn();
        applyMargins();
      });
    });

    $('.mini-submenu-left').on('click',function() {
      var thisEl = $(this);
      $('.sidebar-left .sidebar-body').toggle('slide');
      thisEl.hide();
      applyMargins();
    });

    $(window).on("resize", applyMargins);


  });


</script>


     <div class="navbar-offset"></div>
     <div id="map"></div>
     <div class="row main-row" id="lys">
       <div class="col-sm-4 col-md-3 sidebar sidebar-left pull-left">
         <div class="panel-group sidebar-body" id="accordion-left">
           <div class="panel panel-default">
             <div class="panel-heading">
               <h4 class="panel-title">
                 <i class="fa fa-map-o"></i>
                 <a data-toggle="collapse" href="#layers">
                    Camadas
                 </a>
                 <span class="pull-right slide-submenu">
                   <i class="fa fa-chevron-left"></i>
                 </span>
               </h4>
             </div>
             <div class="panel-collapse collapse in">
               <div class="panel-body list-group" id="layers">
                 <ul class="list-group">
                 <?php $ds_agrpd = null; ?>
                 <?php $an_agrpd = null; ?>
                 <?php $nested = null; ?>
                 <?php foreach ($camadas as $camada) :?>
                   <?php $ds_agrpd = listAgrpd($camada['mps04_cd_agrpd']); ?>
                   <?php if($ds_agrpd != $an_agrpd) { ?>
                   <ul class="list-group">
                     <li class="list-group-item">
                       <strong> <?php echo $ds_agrpd; ?> </strong>
                     </li>
                     <?php $an_agrpd = $ds_agrpd; ?>
                   <?php } ?>
                   <li class="list-group-item">
                     <input id="<?php echo $camada['mps03_nm_camada'];?>" class="form-check-input" type="checkbox" checked/>
                     <img src="<?php echo $camada['mps03_ur_camada']; ?>?VERSION=1.1.0&REQUEST=GetLegendGraphic&LAYER=<?php echo $camada['mps03_ly_camada'];?>&WIDTH=16&HEIGHT=16&FORMAT=image/png">
                     <?php echo $camada['mps03_ds_legenda']; ?>
                   </li>

                 <?php endforeach; ?>
                 </ul>
               </div>
             </div>
           </div>

           <!-- =====> painel de propriedades -->
           <div class="panel panel-default">
             <div class="panel-heading">
               <h4 class="panel-title">
                 <i class="fa fa-list-alt"></i>
                 <a data-toggle="collapse" href="#properties">
                   Propriedades
                 </a>
               </h4>
             </div>

             <div id="properties" class="panel-collapse collapse in">
               <div class="panel-body" id="info">
                    Não existem camadas selecionadas.
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>

     <!-- botão de download png
     <div class="pull-left main-btn">
      <a id="export-png" class="btn btn-default" download="map.png"><i class="fa fa-download"></i> Download PNG</a>
    </div>      -->

     <div class="mini-submenu mini-submenu-left pull-left">
       <i class="fa fa-chevron-right"></i>
     </div>




   <script>

   // criando a camada de base do mapa
   var base_map = new ol.layer.Tile({
                      source: new ol.source.OSM()
                    });

   var camadas_ar = new Array(base_map);


   //inicio do looping de busca de camadas
   <?php if ($camadas) : ?>
   <?php foreach ($camadas as $camada) :?>

   // criando as camadas de informações
   var wms_source = new ol.source.TileWMS({
                       url: '<?php echo $camada['mps03_ur_camada']; ?>',
                       name: '<?php echo $camada['mps03_nm_camada']; ?>',
                       params: {
                               'LAYERS': '<?php echo $camada['mps03_ly_camada']; ?>'
                               }
                       });

   var wms_layer = new ol.layer.Tile({
        source:  wms_source
   });

   camadas_ar.push(wms_layer);

   <?php endforeach; ?>
   <?php else : ?>
    alert('Nenhuma camada para este projeto');
     window.history.back();
   <?php endif; ?>

   var map = new ol.Map({
                          target: "map",
                          layers: camadas_ar,
                          view: new ol.View({
                                             center: ol.proj.transform([<?php echo $project['mps01_cd_cnt_x'] ?>, <?php echo $project['mps01_cd_cnt_y'] ?>], 'EPSG:4326', 'EPSG:3857'),
                                             zoom: 14
                                            })
                        });
   applyInitialUIState();
   applyMargins();


   //AJAX
   $(document).ready(function() {

     // ====>>> evento de setar visibilidade das camadas
     <?php $id_camada = 1; ?>
     <?php foreach ($camadas as $camada) :?>

     $('#<?php echo $camada['mps03_nm_camada'];?>').change(function() {
            camadas_ar[<?php echo $id_camada?>].setVisible($(this).is(":checked"));

     });



           <?php $id_camada= $id_camada + 1; ?>
     <?php endforeach; ?>


     // ==> Função de clique no DOWNLOAD PNG
     $('#export-png').click(function() {
       map.once('postcompose', function(event) {
         var canvas = event.context.canvas;
         exportPNGElement.href = canvas.toDataURL('image/png');
       });
       map.renderSync();
     });


   });





   </script>



<?php include(FOOTER_TEMPLATE); ?>
