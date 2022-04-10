<?php 
session_start();

//connecting to DB
//include "connectToDB.php";
//include "dbfunctions.php";
require_once "navV2.php";


if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
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
    <style>
        html, body { height: 100%; width: 100%; margin: 0; } .leaflet-container {max-width: 100%; max-height: 100%;}
    </style>
    <!--<script src="projectV2.js"></script>-->
    <body>

    <div class="w3-container w3-center w3-padding-16">    
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

    <div class="w3-container w3-center">
        <select class="w3-select w3-border w3-margin-bottom" style="width: 90%" name="option">
	<option value="" disabled selected>Choose Walking Assistant</option>
<?php
	//$query1=$db->prepare("SELECT fID, fName, lName, gender from Faculty WHERE isAvailable=1");
	//$query1->execute();
	//mysqli_stmt_bind_result($rowfID, $rowfName, $rowlName, $rowGender);
	/*$query1=mysqli_query($db, "SELECT fID, fName, lName, gender FROM Faculty");
	while($row=$query1->fetch_assoc()) {
		$fID = $row['fID'];
		$fName = $row['fName'];
		$lName = $row['lName'];
		$gender = $row['gender'];
		echo "<option value='".$fID."'>".$fName." ".$lName." (".$gender.") </option>";
	}*/
?>
           <option value="1">Daniel Josep (M)   </option>
            <option value="2">Andrea Almanza (F) </option>
            <option value="3">Adam Nicholas (M)  </option>
            <option value="4">Ericka Snopko (F)  </option>
        </select></br>
        <button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-margin-bottom w3-hover-green" style="width: 90%" onclick="">Connect 
            <i class="fa-solid fa-handshake"></i></button></br>
        <a href="inbox.php" <button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green" style="width: 90%" onclick="">Inbox 
            <i class="fa fa-envelope"></i></button></a>
    </div>

    <script>
        //Variables
        var lon, lat;
        var map, marker, myIcon;
        var popUp;

        //Variables for Map Bounds
        var northEast = L.latlng(35.354082, -119.092462),
            southWest = L.latLng(35.339888, -119.114156),
            csubBounds = L.latLngBounds(northEast, southWest);

        function showLoc() {
            var x = document.getElementById("mapBttnID");
            var y = document.getElementById("map");

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(works, error);
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
            lat = loc.coords.latitude;
            lon = loc.coords.longitude;
            getMap(lat, lon);
        }

        function error() {
            alert("Cannot get location");
        }

        function onMapClick(e) {
            popUp = L.popup();
            var newMarker = new L.marker(e.latlng, {
                draggable: true,
                autoPan: true
            });
            newMarker.addTo(map)
                .bindPopup('You clicked the map at ' + e.latlng.toString()).openPopup();
        }

        function getMap(lat, lon) {
            map = L.map("map").setView([lat, lon], 16);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                bounds: csubBounds,
		maxZoom: 25,
		minZoom: 16,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiZHZpbnRpIiwiYSI6ImNrend1enYxdjg5c3oybm5rdnRsNzAyMHIifQ.wpv77ZIRfk3mI1gyqoOSAg'
            }).addTo(map);
            
            // User Marker for Student Icon
            // Student Icon
            myIcon = L.icon({
                iconUrl: 'maps/CSUBMark.png',
                iconSize: [40, 50],
                iconAnchor: [22, 94],
                popupAnchor: [-3, -76]
            });

            marker = L.marker([lat, lon], {icon: myIcon}).addTo(map)
                .bindPopup('<b>User Location</b>').openPopup();
            
            //Start at Bakersfield after User Marker is set
            map.panTo(new L.LatLng(35.348587, -119.103212));
            
            // On double click, add a new marker
            map.on('dblclick', onMapClick);

            // Disable Double Click Zoom
            map.doubleClickZoom.disable();

            // function hideMapBttn() {
            //     var x = document.getElementById("mapBttnID");
            //     if (x.style.display === "none") {
            //         x.style.display = "block";
            //     } else {
            //         x.style.display = "none";
            //     }
            // }
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
