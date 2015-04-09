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
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
		<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	</head>
	<body>
		<div id="map" style="width: 800px; height: 600px"></div>
		<script>

		var map = L.map('map').setView([36.068681, -94.176012], 15);

		L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'examples.map-i875mjb7'
		}).addTo(map);




		var stopsCount = "<?php echo json_encode($num_stops); ?>";


		var lngs = <?php echo json_encode($lngs); ?>;
		var lats = <?php echo json_encode($lats); ?>;
		var places = <?php echo json_encode($places); ?>;

  		for(var i=0;i<stopsCount;i++){
  			if(lats[i] != null){
        		var marker = L.marker([lats[i],lngs[i]]).addTo(map);
  				marker.bindPopup("<b>" + places[i] + "</b>").openPopup();}
    	}


	</script>

	</body>
</html>
