<?php
    require_once('functions.php');
    global $project;
    global $camadas;
    global $camada;
    global $campos;
    global $campo;

    $projetos = find('mapsrv.mps01_projetos', $_GET['cdprj'], 'mps01_cd_prj');

    foreach ($projetos as $projeto) :
      $project = $projeto;
    endforeach;

    //$project = find('mapsrv.mps01_projetos', $_GET['cdprj'], 'mps01_cd_prj');

    $camadas = find_cam_prj($_GET['cdprj']);
    // $camadas = find_all('mapsrv.mps03_camadas');

?>


<?php include(HEADER_TEMPLATE_FULL); ?>




<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/ol.css">
<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
<script src="https://openlayers.org/en/v4.3.1/build/ol.js"></script>
<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<script src="<?php echo BASEURL; ?>/js/reqwest.js"></script>
<script src="<?php echo BASEURL; ?>/js/FileSaver.js"></script>

<!-- scripts do geocoder -->
<link href="//cdn.jsdelivr.net/openlayers.geocoder/latest/ol3-geocoder.min.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/openlayers.geocoder/latest/ol3-geocoder.js"></script>

<style type="text/css">
  body { overflow: hidden; }

  .navbar-offset { margin-top: 10px; }
  #map { position: absolute; top: 50px; bottom: 0px; left: 0px; right: 0px; }
  #map .ol-zoom { font-size: 1.2em; left: 20px; }
  #map .ol-geocoder { font-size: 1.054em; left: 20px; }

  .zoom-top-opened-sidebar { margin-top: 5px; }
  .zoom-top-collapsed { margin-top: 45px;}

  .geoc-top-opened-sidebar { margin-top: 15px; }
  .geoc-top-collapsed { margin-top: 55px;}

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

  #map .ol-geocoder ul.gcd-gl-result > li {
    border-bottom: 0px;
    line-height: 1.3rem;}

  #map .ol-geocoder ul.gcd-gl-result > li:nth-child(odd) {
    background-color: #f4fafd; }

  #map   .ol-geocoder ul.gcd-gl-result {
    top: 2.3em;
    left: 2.3em;}



</style>


<script type="text/javascript">

// FUNÇÕES de aumentar e diminuir o menu de camadas
  function applyMargins() {
    var leftToggler = $(".mini-submenu-left");
    if (leftToggler.is(":visible")) {
      $("#map .ol-zoom")
        .css("margin-left", 0)
        .removeClass("zoom-top-opened-sidebar")
        .addClass("zoom-top-collapsed");
      $("#map .ol-geocoder")
        .css("margin-left", 0)
        .removeClass("geoc-top-opened-sidebar")
        .addClass("geoc-top-collapsed");
    } else {
      $("#map .ol-zoom")
        .css("margin-left", $(".sidebar-left").width())
        .removeClass("zoom-top-opened-sidebar")
        .removeClass("zoom-top-collapsed");
      $("#map .ol-geocoder")
        .css("margin-left", $(".sidebar-left").width())
        .removeClass("geoc-top-opened-sidebar")
        .removeClass("geoc-top-collapsed");
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

          <!-- =====> painel das legendas -->
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
                     <input id="<?php echo $camada['mps03_nm_camada'];?>" class="form-check-input" type="checkbox" unchecked/>
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
               <div class="panel-body list-group" id="info">
                    Não existem camadas selecionadas.
               </div>
             </div>
           </div>

           <BR>
           <!-- botão de download png -->
           <div class="pull-left main-btn">
            <a id="export-png" class="btn btn-default" download="map.png"><i class="fa fa-download"></i> Download PNG</a>
          </div>

         </div>
       </div>
     </div>



     <!-- div com menu encolhido -->
     <div class="mini-submenu mini-submenu-left pull-left">
       <i class="fa fa-chevron-right"></i>
     </div>




   <script>


   // criando a camada de base do mapa
   var base_map = new ol.layer.Tile({
                      source: new ol.source.OSM(),
                      name: 'base'
                    });

   var camadas_ar = new Array(base_map);
   var nm_camadas = new Array();
   var nm_layer;


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

   // array onde estão ordenadas as camadas.
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
                                             zoom: 12
                                            })
                        });

   applyInitialUIState();
   applyMargins();

   // teste do geocoder



  //Instantiate with some options and add the Control
  var geocoder = new Geocoder('nominatim',
  {
        provider: 'bing',
        key: '<?php echo BING_API; ?>',
        lang: 'en',
        placeholder: 'Pesquisar Endereço...',
        limit: 5,
        debug: false,
        autocomplete: true,
        keepOpen: true
  });

  map.addControl(geocoder);

  /*
   var exportPNGElement = document.getElementById('export-png');

         if ('download' in exportPNGElement) {
           exportPNGElement.addEventListener('click', function() {
             map.once('postcompose', function(event) {
               var canvas = event.context.canvas;
               exportPNGElement.href = canvas.toDataURL('image/png');
             });
             map.renderSync();
           }, false);
         } else {
           var info = document.getElementById('no-download');
           /**
            * display error message
            *
           info.style.display = '';
         } */

   //===> AJAX
   $(document).ready(function() {

     // ====>>> evento de setar visibilidade das camadas
     <?php $id_camada = 1; ?>
     <?php foreach ($camadas as $camada) :?>

     camadas_ar[<?php echo $id_camada;?>].setVisible(false);

     $('#<?php echo $camada['mps03_nm_camada'];?>').change(function() {
            camadas_ar[<?php echo $id_camada;?>].setVisible($(this).is(":checked"));

     });



           <?php $id_camada= $id_camada + 1; ?>
     <?php endforeach; ?>


     // ==> Função de clique no DOWNLOAD PNG
      var exportPNGElement = document.getElementById('export-png');

     $('#export-png').click(function() {
       map.once('postcompose', function(event) {
         var canvas = event.context.canvas;
         exportPNGElement.href = canvas.toDataURL('image/png');
       });
       map.renderSync();
     });

     $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
     });

     $("#map .ol-geocoder")
       .css("margin-left", $(".sidebar-left").width());


   });

   // Função para detectar clique simples no mapa.
   // Carrega as propriedades das camadas ativas.
   map.on('singleclick', function(evt) {


           //document.getElementById('info').innerHTML = '<H1>PROPRIEDADES</H1>';
           document.getElementById('info').innerHTML = '';
           var view = map.getView();
           var viewProjection = view.getProjection();
           var viewResolution = view.getResolution();

           // variável criada para navegar no array das camadas_ar
           var idlay = 0;
           var ly_camada;

           // variaveis criadas para incluir no div de propriedades
           var titulo = '<ul class="nav nav-tabs" id="myTabs" role="tablist">';
           var corpo = '<div class="tab-content">';
           var class_active = ' class="active"';
           var active = ' in active';


           map.getLayers().forEach(function (lyr) {

             //Verifica se o layer não é o base e se a camada está visivel.
             //Exibe as propriedades apenas das camadas visiveis
             if(idlay != 0 && camadas_ar[idlay].getVisible()){
               var url = lyr.getSource().getGetFeatureInfoUrl(
                                             evt.coordinate,
                                             viewResolution,
                                             viewProjection,
                                             {'INFO_FORMAT': 'application/json'}
                                         );
                             //usa reqwest.js para requisição assíncrona, pelo tempo de acesso
                             reqwest({
                                 url: url,
                                 type: 'json'

                             }).then(function (data) {
                                 feature = data.features[0];
                                 props = feature.properties;
                                 // php para montar os ifs de cada layer
                                 <?php foreach ($camadas as $camada) : ?>

                                    ly_camada = '<?php echo $camada['mps03_ly_camada'] ?>';
                                    ly_camada = ly_camada.slice(ly_camada.indexOf(":")+1, ly_camada.length);
                                    console.log(ly_camada);

                                    if(feature.id.slice(0, feature.id.indexOf('.')) == ly_camada) {

                                        <?php $campos = findOrd( 'mapsrv.mps06_campos', $camada['mps03_cd_camada'], 'mps06_cd_camada', 'mps06_cd_ordem' ); ?>


                                        <?php if ($campos): ?>
                                        titulo += '<li role="presentation"' + class_active + '><a id="nav-' + ly_camada + '" href="#' + ly_camada + '" aria-controls="' + ly_camada + '" role="tab" data-toggle="tab"><?php echo $camada['mps03_ds_legenda'];?></a></LI>';
                                        corpo += '<div role="tabpanel" class="tab-pane fade' + active + '" id="' + ly_camada + '" aria-labelledby="' + ly_camada + '-tab">'
                                        <?php foreach ($campos as $campo) : ?>

                                        console.log('Nome do campo: <?php echo $campo['mps06_nm_campo'];?>');

                                        <?php if ($campo['mps06_tf_link']=='t') : ?>

                                          nome_do_campo = '<a href="' + props.<?php echo $campo['mps06_nm_campo'];?> + '" target="_blank"> Link </a>';

                                        <?php else: ?>

                                          nome_do_campo = props.<?php echo $campo['mps06_nm_campo'];?>;

                                        <?php endif; ?>
                                        corpo += '<LI class="list-group-item"><small><a style="color: black; text-decoration: none" data-toggle="tooltip" data-placement="right" title="<?php echo $campo['mps06_ds_campo'];?>"><B><?php echo $campo['mps06_lg_campo'] ?>:</B></a> '  + nome_do_campo + '</small></LI>';

                                        <?php endforeach; ?>
                                        <?php else : ?>
                                          //console.log('No campos');
                                        <?php endif; ?>

                                        corpo += '</div>'

                                    }
                                <?php endforeach; ?>

                               console.log(titulo + '</UL>' + corpo + '</div>');
                               document.getElementById('info').innerHTML = titulo + '</ul>' + corpo + '</div>';
                               active = '';
                               class_active = '';
                             });

              }
              idlay = idlay + 1;

           });


         });




   </script>

<?php clear_messages(); ?>

<?php include(FOOTER_TEMPLATE); ?>
