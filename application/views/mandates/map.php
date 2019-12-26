

<!-- Begin Page Content -->
<div class="container-fluid">
   <div id="mapid"></div>
   <script>
      var localIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-grey.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      
      var epIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      
      var bundestagIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      
      var landIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      
      var tiles = L.tileLayer('https://stamen-tiles.a.ssl.fastly.net/terrain/{z}/{x}/{y}.jpg', {
      	attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.',
      	maxZoom: 12,
      	id: 'stamen.streets',
      });
      
      var bw = L.layerGroup();
      
      <?php foreach($baden_wuerttemberg as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(bw);
      
      <?php endforeach; ?>
      
      var ba = L.layerGroup();
      
      <?php foreach($bayern as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(ba);
      
      <?php endforeach; ?>
      
      var he = L.layerGroup();
      
      <?php foreach($hessen as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(he);
      
      <?php endforeach; ?>
      
      var be = L.layerGroup();
      
      <?php foreach($berlin as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(be);
      
      <?php endforeach; ?>
      
      var br = L.layerGroup();
      
      <?php foreach($brandenburg as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(br);
      
      <?php endforeach; ?>
      
      var bre = L.layerGroup();
      
      <?php foreach($bremen as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(bre);
      
      <?php endforeach; ?>
      
      var ha = L.layerGroup();
      
      <?php foreach($hamburg as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(ha);
      
      <?php endforeach; ?>
      
      var mv = L.layerGroup();
      
      <?php foreach($mecklenburg_vorpommern as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(mv);
      
      <?php endforeach; ?>
      
      var nds = L.layerGroup();
      
      <?php foreach($niedersachsen as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(nds);
      
      <?php endforeach; ?>
      
      var ep = L.layerGroup();

      var nrw = L.layerGroup();
      
      <?php foreach($nordrhein_westfalen as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(nrw);
      
      <?php endforeach; ?>
      
      var rp = L.layerGroup();
      
      <?php foreach($rheinland_pfalz as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(rp);
      
      <?php endforeach; ?>
      
      var sa = L.layerGroup();
      
      <?php foreach($saarland as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(sa);
      
      <?php endforeach; ?>

      var sac = L.layerGroup();
      
      <?php foreach($sachsen as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(sac);
      
      <?php endforeach; ?>
   
      var saa = L.layerGroup();
      
      <?php foreach($sachsen_anhalt as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(saa);
      
      <?php endforeach; ?>

      var sh = L.layerGroup();
      
      <?php foreach($schleswig_holstein as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(sh);
      
      <?php endforeach; ?>

      var th = L.layerGroup();
      
      <?php foreach($thueringen as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: localIcon}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(th);
      
      <?php endforeach; ?>

      var ep = L.layerGroup();
      
      <?php foreach($europaparlament as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: epIcon, zIndexOffset: 800}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(ep);
      
      <?php endforeach; ?>
      
      var bt = L.layerGroup();
      
      <?php foreach($bundestag as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: bundestagIcon, zIndexOffset: 700}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(bt);
      
      <?php endforeach; ?>
      
      var lt = L.layerGroup();
      
      <?php foreach($landesparlament as $marker):?>
      
      
      L.marker([<?php echo round($marker[0]['latitude'],3);?> , <?php echo round($marker[0]['longitude'],3);?>], {icon: landIcon, zIndexOffset: 600}).bindPopup('<?php foreach($marker as $entry):?><span><?php echo html_escape($entry['institution']);?>: <a href="/mandates/single/<?php echo html_escape($entry['mandate_id']);?>"><?php echo $entry['name'];?></a></span><br><?php endforeach; ?>
      ').addTo(lt);
      
      <?php endforeach; ?>
      
      var map = L.map('mapid', {
          center: [51.2, 10.5],
          zoom: 5,
          layers: [tiles, ep, bt, lt, bw, ba, he, be, br, bre, ha, nds, mv, nrw, rp, sa, sac, saa, sh, th]
      });
      
      var overlays = {
          "Europaparlament": ep,
          "Bundestag": bt,
          "Landesparlamente": lt,
          "Kommunalmandate: BaWü": bw,
          "Kommunalmandate: Bayern" : ba,
          "Kommunalmandate: Berlin": be,
          "Kommunalmandate: Brandenburg": br,
          "Kommunalmandate: Bremen": bre,
          "Kommunalmandate: Hamburg": ha,
          "Kommunalmandate: Hessen": he,
          "Kommunalmandate: Meck.-Pom.": mv,
          "Kommunalmandate: Niedersachsen": nds,
          "Kommunalmandate: NRW": nrw,
          "Kommunalmandate: Rheinl.-Pfalz": rp,
          "Kommunalmandate: Saarland": sa,
          "Kommunalmandate: Sachsen": sac,
          "Kommunalmandate: Sachsen-A.": saa,
          "Kommunalmandate: Schlesw.-Holst.": sh,
          "Kommunalmandate: Thüringen": th
          
      };
      
      var baselayers = {
      };
      
      L.control.layers(baselayers, overlays).addTo(map);
   </script>



<div class="row">
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mandate gesamt</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalConnections"><?php echo $total_mandates; ?></div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calculator fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Europaabgeordnete</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="activeConnections"><?php echo $ep_mandates; ?></div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Card  -->
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bundestagsabgeordnete</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="stations"><?php echo $bt_mandates; ?></div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Landtagsabgeordnete</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="hourlyRequests"><?php echo $lt_mandates; ?></div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-dark shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kommunale Mandate</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyRequests"><?php echo $local_mandates; ?></div>
               </div>
               <div class="col-auto"> <i class="fas fa-users fa-2x text-gray-300"></i> </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Gesammelte Dokumente</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="averageCosts"><?php echo $files; ?></div>
               </div>
               <div class="col-auto"> <i class="fas fa-folder fa-2x text-gray-300"></i> </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Card -->
   <div class="col-xl-3 col-md-6 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" id="averageCosts"><?php echo $users;?></div>
               </div>
               <div class="col-auto"> <i class="fas fa-user-cog fa-2x text-gray-300"></i> </div>
            </div>
         </div>
      </div>
   </div>
<!-- Card -->
<div class="col-xl-3 col-md-6 mb-3">
   <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
         <div class="row no-gutters align-items-center">
            <div class="col mr-2">
               <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Aktiv seit</div>
               <div class="h5 mb-0 font-weight-bold text-gray-800" id="averageCosts">2019</div>
            </div>
            <div class="col-auto"> <i class="fas fa-clock fa-2x text-gray-300"></i> </div>
         </div>
      </div>
   </div>
</div>


</div>
<!-- END row -->






</div>
<!-- /.container-fluid -->

