<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";
require_once "navV2.php";


if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
	//	$connected = 0;
?>
    <body>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0/favicon-16x16.png">
    <link rel="manifest" href="favicon_package_v0/site.webmanifest">
    <link rel="mask-icon" href="favicon_package_v0/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!--<style>
		html, body { height: 100%; width: 100%; margin: 0; } 
		.leaflet-container { max-width: 100%; max-height: 100%; }
		.leaflet-control-layers { text-align: left; }
    </style>-->
    <!--<script src="projectV2.js"></script>-->
    <body>
	<div class="w3-container w3-text-metro-dark-blue">
		<div class="w3-container w3-center w3-margin-top">    
			<div class="w3-card w3-margin"> 
				<div class="w3-container w3-metro-dark-blue">
				<h4>Welcome @<?php echo $_SESSION['uName']; ?>!</h4>
				</div>

				<!--<p> Show map of your location. </p>-->
				<div class="w3-container w3-center" id="mapBttnID"> 
				<img src="full-map.jpg" style="height: 200px; width: 400px; max-width: 100%; max-height: 100%;" class="w3-margin-top"></br>
				<!-- <button class="w3-button w3-round-large w3-metro-dark-blue w3-margin w3-hover-green" style="width: 60%;" onclick="showLoc()">Show Location 
					<i class="fa-solid fa-location-dot"></i></button> -->
				<button class="w3-button w3-circle w3-xlarge w3-metro-dark-blue w3-margin" onclick="showLoc()">
					<i class="fa-solid fa-location-dot"></i></button>
				</div>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
				<div id="map" style="height: 50%; width: 100%; margin: auto; display: none;"></div>
			</div>
		</div>
	</div>
<?php
	//	if($connected = 0) {
?>
    <div class="w3-container w3-center">
	<!-- <select class="w3-select w3-border w3-margin-bottom" style="width: 90%" name="faculty"> -->
	<!-- <option value="" disabled selected>Choose Walking Assistant</option> -->
	<!-- </select></br> -->
	<!-- <button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-margin-bottom w3-hover-green" style="width: 90%" type="submit">Connect <i class="fa-solid fa-handshake"></i></button></a></br> -->
		<?php
			//echo "prequery1";
			//var_dump($_SESSION['uID']);
			$uID = $_SESSION['uID'];
			$fID = $_SESSION['fID'];
			//var_dump($fID);
			//var_dump($_SESSION['walkID']);
			
			$query2 = $db->prepare("SELECT fName, lName, gender FROM Faculty WHERE fID=?");
			$query2->bind_param('i', $fID);
			if($query2->execute()) {
				mysqli_stmt_bind_result($query2, $res_first, $res_last, $res_gen);
				if($query2->fetch()) {
					$fname=$res_first;
					$lname=$res_last;
					$gender=$res_gen;
					// echo "Connected with: ".$fname." ".$lname." (".$gender.")"; ?>
					<p style="font-style: italic;"><?php echo "Connected to: ".$fname." (".$gender.")"; ?></p>
					<p style="font-style: italic;"><?php echo "Pick-Up: ".$_SESSION['pickUp']; ?></p>
					<p style="font-style: italic;"><?php echo "Drop-Off: ".$_SESSION['dropOff']; ?></p><?php
				}
			} else { echo mysqli_error($db); }
		?>	
		<a href="inbox.php"<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green" style="width: 90%" onclick="">Inbox 
	    	<i class="fa fa-envelope"></i></button></a>
    </div>
<!--</form>-->
	<script>
		//Variables
		var map;

		function showLoc() {
			var x = document.getElementById("mapBttnID");
			var y = document.getElementById("map");

			if (navigator.geolocation) {
				setInterval(() => {
					navigator.geolocation.getCurrentPosition(works, error);
				}, 1000);
			} else {
				loc.innerHTML = "Geolocation not supported.";
			}

			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}

			if (y.style.display === "none") {
				y.style.display = "block";
			} else {
				y.style.display = "none";
			}
		}

		function works(loc) {
			var lat = loc.coords.latitude;
			var lon = loc.coords.longitude;
			getMap(lat, lon);
		}

		function error() {
			alert("Cannot get location");
		}

		var newMarker;
		function addMarker(e) {
			var popUp = L.popup();
			newMarker = new L.Marker(e.latlng, {
				draggable: true,
				autoPan: true,
				riseOnHover: true
			});
			map.addLayer(newMarker);
			newMarker.bindPopup("<b>You are here!</b><br>Latitude: " + e.latlng.lat + "<br>Longitude: " + e.latlng.lng).openPopup();
			newMarker.on('dragend', function(e) {
				popUp.setLatLng(e.target.getLatLng());
				popUp.setContent("<b>You are here!</b><br>Latitude: " + e.target.getLatLng().lat + "<br>Longitude: " + e.target.getLatLng().lng);
				newMarker.bindPopup(popUp).openPopup();
			});
		}

		function removeMarker(e) {
			map.removeLayer(newMarker);
		}

		function getMap(lat, lon) {
			// Bounding Box for the map
			var northEast = L.latLng(35.354213, -119.096448),
				southWest = L.latLng(35.342976, -119.109933),
				csubBounds = L.latLngBounds(northEast, southWest);

			// Sets the initial Map View
            map = L.map("map", {
				maxBounds: csubBounds,
				attributionControl: false,
				zoomControl: true
			}).setView([lat, lon], 17);
			
			// Adds the Map Tile Layer
			var baseLayers = {
				"OpenStreetMap": L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					minZoom: 16,
					maxZoom: 21,
					id: 'mapbox/streets-v11',
					tileSize: 512,
					zoomOffset: -1,
					accessToken: 'pk.eyJ1IjoiZHZpbnRpIiwiYSI6ImNrend1enYxdjg5c3oybm5rdnRsNzAyMHIifQ.wpv77ZIRfk3mI1gyqoOSAg'
				}),
				"Satellite": L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", {
					attribution: "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
					minZoom: 16,
					maxZoom: 19,
					tileSize: 512,
					zoomOffset: -1
				})
			};

			// This makes the default map view to be OpenStreetMap
			this.map.addLayer(baseLayers["OpenStreetMap"]);

			// Adds the Layer Switch to the map
			L.control.layers(baseLayers, null, {
				collapsed: true
			}).addTo(map);

			// Zooms the map to the bounding box
			map.fitBounds(csubBounds);

            // User Marker for Student Icon
            // Student Icon
            var BlueIcon = L.icon({
                iconUrl: 'CSUB Blue Marker.png',
                iconSize: [50, 50],
                iconAnchor: [22, 94],
                popupAnchor: [4, -85]
            });

			var YellowIcon = L.icon({
                iconUrl: 'CSUB Yellow Marker.png',
                iconSize: [50, 50],
                iconAnchor: [22, 94],
                popupAnchor: [4, -85]
            });

			// Creates the marker for the user
            var marker = L.marker([lat, lon], {icon: BlueIcon}).addTo(map)
                .bindPopup('<b>User Location</b>').openPopup();
            
            //Start at Bakersfield after User Marker is set
            //map.panTo(new L.LatLng(35.350056, -119.103599));
            
			// Disable Double Click Zoom
            map.doubleClickZoom.disable();

            // On click, add a new marker
            map.on('dblclick', addMarker);

			// On double click, remove marker
			map.on('click', removeMarker);
		}
	</script>
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
