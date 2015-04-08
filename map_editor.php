<?php
echo "Map Editor";

$mysql = new mysql_driver;
		$mysql->connect();
		$stops = $mysql->getStops();
		$num_stops = count($stops);
		print_r($stops[0][0]);
		//print_r($stops);  
		$places = array($num_stops);
		$lats = array($num_stops);
		$lngs = array($num_stops);
		

		for ($i = 0; $i < $num_stops; ++$i) {
			$places[$i] = $stops[$i]['Place'];
			$lats[$i] = $stops[$i]['Latitude'];
			$lngs[$i] = $stops[$i]['Longitude'];
    	}
		
      	 echo($places[0]);
        //var_dump($places);


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
		var test = 10;
		var stopsCount = "<?php echo json_encode($num_stops); ?>";
		var place = "<?php echo($places[".+test.toString()+."]); ?>";
		alert(place);
		//alert(stopsCount);
		//var marker = L.marker([51.5, -0.09]).addTo(map);
		for (i = 0; i < stopsCount; i++) {
		// var place = "<php echo $places[" + i + "]; ?>";
		// alert(place); 
   		// text += cars[i] + "<br>";
			}
		

	</script>

	</body>
</html>
