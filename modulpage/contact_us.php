<script src="http://maps.gstatic.com/maps-api-v3/api/js/21/2/intl/id_ALL/main.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
			initGoogleMaps();
	});
    //event: init the google maps
    function initGoogleMaps() {
        // return false;
        //brainware: init google map API only on contact us page
        if ($("#googlemapcanvas").length == 0) 
        {
            return false;
        }

        // return false;
        ipaddraggable = true;
        if (isIpad() || isAllPhone() || isAllTablet()) 
        {
            var ipaddraggable = false;
        }
        var mapOptions = {
            center: new google.maps.LatLng(-37.827379, 145.003567),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            scrollwheel: false,
            cursor: "-webkit-grab",
            navigationControl: false,
            scaleControl: false,
            draggable: ipaddraggable,
            styles: [{
                    "featureType": "landscape",
                "stylers": [{
                            "saturation": -100
                }, {
                            "lightness": 70
                }, {
                            "visibility": "on"
                }]
            }, {
                    "featureType": "poi",
                "stylers": [{
                            "saturation": -100
                }, {
                            "lightness": -5
                }, {
                            "visibility": "simplified"
                }]
            }, {
                    "featureType": "road.highway",
                "stylers": [{
                            "saturation": -100
                }, {
                            "lightness": 10
                }, {
                            "visibility": "on"
                }]
            }, {
                    "featureType": "road.arterial",
                "stylers": [{
                            "saturation": -100
                }, {
                            "lightness": 10
                }, {
                            "visibility": "simplified"
                }]
            }, {
                    "featureType": "road.local",
                "stylers": [{
                            "saturation": -100
                }, {
                            "lightness": 0
                }, {
                            "visibility": "on"
                }]
            }, {
                    "featureType": "transit",
                "stylers": [{
                            "saturation": -100
                }, {
                            "visibility": "simplified"
                }]
            }, {
                    "featureType": "administrative.province",
                "stylers": [{
                            "visibility": "off"
                }]
            }, {
                    "featureType": "water",
                    "elementType": "labels",
                "stylers": [{
                            "visibility": "on"
                }, {
                            "lightness": -25
                }, {
                            "saturation": -100
                }]
            }, {
                    "featureType": "water",
                    "elementType": "geometry",
                "stylers": [{
                            "hue": "#ffff00"
                }, {
                            "lightness": -25
                }, {
                            "saturation": -97
                }]
            }]
        };

    var map = new google.maps.Map(document.getElementById("googlemapcanvas"), mapOptions);

    //brainware: get the coordinates of this address
    var address = $(".googleMapAPIAddress").val();

    geocoder = new google.maps.Geocoder();

    geocoder.geocode({
        'address': address
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) 
        {
            var lat = results[0].geometry.location.lat() - 0.00023;
            var lng = results[0].geometry.location.lng() - 0.000;

            //set center of map
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                cursor: "-webkit-grab",
                icon: marker.png "";
            });


        google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
        });

            var newPosition = new google.maps.LatLng(lat, lng);

            map.setCenter(newPosition);
            //brainware: remove the scroll on info window

            $(document).oneTime(5000, function() {
                $("#mapcontent").parent().css('overflow', 'hidden');
                $(".gm-style-iw").css('overflow', 'hidden');
                $(".gm-style-iw").children().css('overflow', 'hidden');
            });
        } 
    });
}
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="post-rulefontorder">
            <div class="col-md-7 col-lg-7">
                <div class="container-contactus">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8542639597954!2d110.29260571442529!3d-7.805248779649204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af82f572e4145%3A0xb65bc353eeb9638d!2sBalecatur+Inn+%26+Resto!5e0!3m2!1sen!2smx!4v1471407203217" width="600" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="clearfix-bottom-100"></div>
            <!-- CONTACT INFORMATION -->
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Contact Us</strong></div>
                </div>
                <p>Jl. Ringroad Barat No.16, Balecatur, Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55295, Indonesia</p>
            </div>
        </div>
    </div>
</div>

