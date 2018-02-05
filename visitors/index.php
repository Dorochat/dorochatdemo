<?php
require_once('geoplugin.class.php');
$geoplugin = new geoPlugin();
// If we wanted to change the base currency, we would uncomment the following line
// $geoplugin->currency = 'EUR';
 
$geoplugin->locate();



function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

echo ip_info("Visitor", "Country"),'<br/>'; // India
echo ip_info("Visitor", "Country Code"),'<br/>'; // IN
echo ip_info("Visitor", "State"),'<br/>'; // Andhra Pradesh
echo ip_info("Visitor", "City"),'<br/>'; // Proddatur
echo ip_info("Visitor", "Address"),'<br/>'; // Proddatur, Andhra Pradesh, India



echo "Geolocation results for {$geoplugin->ip}: <br />\n".
  "City: {$geoplugin->city} <br />\n".
  "Region: {$geoplugin->region} <br />\n".
  "Area Code: {$geoplugin->areaCode} <br />\n".
  "DMA Code: {$geoplugin->dmaCode} <br />\n".
  "Country Name: {$geoplugin->countryName} <br />\n".
  "Country Code: {$geoplugin->countryCode} <br />\n".
  "Longitude: {$geoplugin->longitude} <br />\n".
  "Latitude: {$geoplugin->latitude} <br />\n".
  "Currency Code: {$geoplugin->currencyCode} <br />\n".
  "Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
  "Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
 
if ( $geoplugin->currency != $geoplugin->currencyCode ) {
  //our visitor is not using the same currency as the base currency
  echo "<p>At todays rate, US$100 will cost you " . $geoplugin->convert(100) ." </p>\n";
}



/* find places nearby */
$nearby = $geoplugin->nearby();
if ( isset($nearby[0]['geoplugin_place']) ) {
  echo "<pre><p>Some places you may wish to visit near " . $geoplugin->city . ": </p>\n";
  foreach ( $nearby as $key => $array ) {
 
    echo ($key + 1) .":<br />";
    echo "\t Place: " . $array['geoplugin_place'] . "<br />";
    echo "\t Country Code: " . $array['geoplugin_countryCode'] . "<br />";
    echo "\t Region: " . $array['geoplugin_region'] . "<br />";
    echo "\t County: " . $array['geoplugin_county'] . "<br />";
    echo "\t Latitude: " . $array['geoplugin_latitude'] . "<br />";
    echo "\t Longitude: " . $array['geoplugin_longitude'] . "<br />";
    echo "\t Distance (miles): " . $array['geoplugin_distanceMiles'] . "<br />";
    echo "\t Distance (km): " . $array['geoplugin_distanceKilometers'] . "<br />";

    ?>

    <!DOCTYPE HTML>
<html>
<head>
    <title>Geolocation watchPosition() by The Code of a Ninja</title>
    </head>
    <body>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAUwkZMj52Hie7sS8151V-a9kz2BMlluF8&callback=initMap" type="text/javascript"></script><script type="text/javascript">// <![CDATA[
var markers = [{"lat":"<?php echo $array['geoplugin_latitude'] ?>","lng":"<?php echo $array['geoplugin_longitude'] ?>"},{"title":"shilparamam","lat":"17.452665","lng":"78.435608","description":"Mumbai formerly Bombay, is the capital city of the Indian state of Maharashtra."},{"title":"image hospitals","lat":"17.452421","lng":"78.435715","description":"Pune is the seventh largest metropolis in India, the second largest in the state of Maharashtra after Mumbai."}];
window.onload = function () {
var mapOptions = {
center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
zoom: 10,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
var infoWindow = new google.maps.InfoWindow();
var lat_lng = new Array();
var latlngbounds = new google.maps.LatLngBounds();
for (i = 0; i < markers.length; i++) {
var data = markers[i]
var myLatlng = new google.maps.LatLng(data.lat, data.lng);
lat_lng.push(myLatlng);
var marker = new google.maps.Marker({
position: myLatlng,
map: map,
title: data.title
});
latlngbounds.extend(marker.position);
(function (marker, data) {
google.maps.event.addListener(marker, "click", function (e) {
infoWindow.setContent(data.description);
infoWindow.open(map, marker);
});
})(marker, data);
}
map.setCenter(latlngbounds.getCenter());
map.fitBounds(latlngbounds);

}

// ]]></script></pre>
<div id="dvMap" style="width: 800px; height: 800px;"></div>
 
<body style="margin:0; padding:0;">
     
    <!-- display the map here, you can changed the height or style -->
    <div id="map_canvas" style="height:25em; margin:0; padding:0;"></div>
</body>
 
</html>


    <?php
 
  }
  echo "</pre>\n";
}


?>

