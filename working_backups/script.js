(() => {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(success, error);
	} else {
		alert("Geolocation not supported by or available with this browser");
	}
})();

function success(loc) {
	const lat = loc.coords.latitude;
	const lon = loc.coords.longitude;
	getMap(lat, lon);
}
function error() {
	alert("Cannot locate your position");
}

function getMap(lat, lon) {
	const map = L.map("map").setView([lat, lon], 5);
	L.titleLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
	L.marker([lat, lon]).addTo(map);
}
