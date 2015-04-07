<?php
echo "Map Editor";
/*
$mysql = new mysql_driver;
		$mysql->connect();
		$stops = '';
		
		$events = $mysql->getEvents("NULL", $start, "month", "asc");
		$num_events = count($events);
		
	
		
		for($i = 0; $i < $num_events; $i++){
			
		}
	return $user_month_events;

*/
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

		

		

	</script>

	</body>
</html>
