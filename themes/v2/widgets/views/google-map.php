<?php

use app\assets\GoogleMapAsset;
use app\helpers\Url;

GoogleMapAsset::register($this);

?>

<div id="myMap" class="height-350"></div>

<?php
$this->registerJs('
    jQuery(document).ready(function() {
        //set your google maps parameters
        var $latitude = '.$latitude.',
            $longitude = '.$longitude.',
            $map_zoom = 16 /* ZOOM SETTING */

        //google map custom marker icon 
        var $marker_url = \''. Url::to(['data/img/pin.png']) .'\';

        //we define here the style of the map
        var style = [{
            "stylers": [{
                "hue": "#03a9f4"
            }, {
                "saturation": 10
            }, {
                "gamma": 2.15
            }, {
                "lightness": 12
            }]
        }];

        //set google map options
        var map_options = {
            center: new google.maps.LatLng($latitude, $longitude),
            zoom: $map_zoom,
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            streetViewControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            styles: style
        }
        //inizialize the map
        var map = new google.maps.Map(document.getElementById(\'myMap\'), map_options);
        //add a custom marker to the map                
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng($latitude, $longitude),
            map: map,
            visible: true,
            icon: $marker_url
        });

        var contentString = \'<div id="mapcontent">\' + \'<p>'.$markerDescription.'</p></div>\';
        var infowindow = new google.maps.InfoWindow({
            maxWidth: 320,
            content: contentString
        });

        google.maps.event.addListener(marker, \'click\', function() {
            infowindow.open(map, marker);
        });
    });
');
