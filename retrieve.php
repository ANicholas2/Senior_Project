<?php
session_start();

include “connectToDB.php”;
include “dbfunctions.php”;

?>

<?php
session_start();
/*
<?php
// This uses GOogle API... is it bad to mix with leaflet? 
function geoLocate($address)
{
    try {
        $lat = 0;
        $lng = 0;

        $data_location = "https://maps.google.com/maps/api/geocode/json?key=".$GOOGLE_API_KEY_HERE."&address=".str_replace(" ", "+", $address)."&sensor=false";
        $data = file_get_contents($data_location);
        usleep(200000);
  
        // echo $data;
        $data = json_decode($data);
        if ($data->status=="OK") {
            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;

            if($lat && $lng) {
                return array(
                    'status' => true,
                    'lat' => $lat,
                    'long' => $lng,
                    'google_place_id' => $data->results[0]->place_id
                );
            }
        }
        if($data->status == 'OVER_QUERY_LIMIT') {
            return array(
                'status' => false,
                'message' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
            );
        }

    } catch (Exception $e) {

    }

    return array('lat' => null, 'long' => null, 'status' => false);
} //https://www.codegrepper.com/code-examples/php/php+get+current+location+latitude+longitude
 */

if (isset($_POST["updateLocationForMe"])) {
	header('Content-type: applicaiton/json');

	$server = 'localhost';
	$user = 'runnerpp';
	$pass = 'Lurw01hoy';
	$database = 'runnerpp';
}
?>


