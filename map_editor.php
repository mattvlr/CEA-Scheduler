<?php
echo "Map Editor";

$mysql = new mysql_driver;
		$mysql->connect();
		$stops = $mysql->getStops();
		$num_stops = count($stops);
		
		$places = array($num_stops);
		$lats = array($num_stops);
		$lngs = array($num_stops);
		
		
		for ($i = 0; $i < $num_stops; ++$i) {
			$places[$i] = $stops[$i]['Place'];
			$lats[$i] = $stops[$i]['Latitude'];
			$lngs[$i] = $stops[$i]['Longitude'];
    	}


?>
<html>
	  <head>
   		 <style type="text/css">
     	 html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
   		 </style>

   		 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8a1UKXLfNwfqwR_nmH-yg-l35APWpeL4"></script>
    
    	<script type="text/javascript">
      		function initialize() {
        		var mapOptions = {
          			center: { lat: 36.068681, lng: -94.176012},
          			zoom: 17
        		};
        		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	        	var stopsCount = "<?php echo json_encode($num_stops); ?>";
				var lngs = <?php echo json_encode($lngs); ?>;
				var lats = <?php echo json_encode($lats); ?>;
				var places = <?php echo json_encode($places); ?>;
				for(var i=0; i < stopsCount; i++){
					if(lats[i] != null){
						var myLatlng = new google.maps.LatLng(lats[i],lngs[i]);
						var marker = new google.maps.Marker({
							position: myLatlng,
							map: map,
							title: places[i]
						});
					}
				}
      		}


      google.maps.event.addDomListener(window, 'load', initialize);
    	</script>
  	</head>
	<body>

		<!--var stopsCount = "<?php echo json_encode($num_stops); ?>";


		var lngs = <?php echo json_encode($lngs); ?>;
		var lats = <?php echo json_encode($lats); ?>;
		var places = <?php echo json_encode($places); ?>;

  		for(var i=0;i<stopsCount;i++){
  			if(lats[i] != null){
        		var marker = L.marker([lats[i],lngs[i]]).addTo(map);
  				marker.bindPopup("<b>" + places[i] + "</b>").openPopup();}
    	}

		-->

		<div id="map-canvas"></div>
	</body>
</html>
