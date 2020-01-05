

var map;
var uluru;
$(document).ready(function(){
    geoLocationInit();
    function geoLocationInit() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }

    function success(position) {
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;
        // console.log(latval,lngval);
        $('#hidden_lat').val(latval.toFixed(6)); 
        $('#hidden_lng').val(lngval.toFixed(6)); 
        uluru = new google.maps.LatLng(latval,lngval);
        createMap(uluru);
        // nearbySearch(uluru, "resturant");
        searchRestaurant(latval,lngval);
    }
        
    function fail() {
        alert("it fails");
    }

    // Create Map
    function createMap(uluru) {
         map = new google.maps.Map(
            document.getElementById('map'), 
            {
                zoom: 10, 
                center: uluru,

            }
        );  

        var icon = {
            url: "http://maps.google.com/mapfiles/ms/micons/green-dot.png", // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon : icon
        });
    }

    // Create Marker
    function createMarker(latlng,icn,name) {
        var icon = {
            url: icn, // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icon,
            title: name
        });

        var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
         name +
        '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }

    // NearBy Search
    
    // function nearbySearch(uluru,type) {
    //     var request = {
    //         location: uluru,
    //         radius: '2500',
    //         type: [type]
    //     };
            
    //     service = new google.maps.places.PlacesService(map);
    //     service.nearbySearch(request, callback);
    
    //     function callback(results, status) {
    //         // console.log(results);
    //         if (status == google.maps.places.PlacesServiceStatus.OK) {
    //             for (var i = 0; i < results.length; i++) {
    //             var place = results[i];
    //             latlng = place.geometry.location;
    //             icn = 'http://maps.google.com/mapfiles/ms/micons/restaurant.png';
    //             name = place.name;
    //             createMarker(latlng,icn,name);
    //             }
    //         }
    //     }
    // }

    // Search Resturant

    function searchRestaurant(lat,lng){
        $.get('/searchRestaurant',{lat:lat,lng:lng},function(match){

            $.each(match,function(i,val){
                var glatval=val.lat;
                var glngval=val.long;
                var gname=val.restaurant_name;
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'http://maps.google.com/mapfiles/ms/micons/red-dot.png';
                createMarker(GLatLng,gicn,gname);
                // var html='<h5><li>'+gname+'</li></h5>';
                // $('#girlsResult').append(html);
            });
        });
    }

    $('#myform').submit(function(e){
        e.preventDefault();
        var rest_id = $('#restaurant_id').val();
        $.get('/calculate',{rest_id:rest_id},function(match) {
                var directionsRenderer;
                var directionsService;
                var map;
                var destination_lat;
                var destination_lng;
                var current_lat = parseFloat($('#hidden_lat').val());
                var current_lng = parseFloat($('#hidden_lng').val());
                var des_lat = parseFloat(match.lat);
                var des_lng = parseFloat(match.long);

                destination_lat = des_lat.toFixed(6);
                destination_lng = des_lng.toFixed(6);
               
                var destination_name = match.restaurant_name;
                var distance = distance(current_lat, current_lng, destination_lat, destination_lng,"K");
                $('#alt_msg').css("display", "block");
                $('#res_name').html(destination_name);
                $('#distance_km').html(distance);
                function distance(lat1, lon1, lat2, lon2, unit) {
                    if ((lat1 == lat2) && (lon1 == lon2)) {
                        return 0;
                    }
                    else {
                        var radlat1 = Math.PI * lat1/180;
                        var radlat2 = Math.PI * lat2/180;
                        var theta = lon1-lon2;
                        var radtheta = Math.PI * theta/180;
                        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                        if (dist > 1) {
                            dist = 1;
                        }
                        dist = Math.acos(dist);
                        dist = dist * 180/Math.PI;
                        dist = dist * 60 * 1.1515;
                        if (unit=="K") { dist = dist * 1.609344 }
                        if (unit=="N") { dist = dist * 0.8684 }
                        return dist.toFixed(2);
                    }
                }
                  
                // var GLatLng = new google.maps.LatLng(glatval, glngval);
                // var gicn= 'http://maps.google.com/mapfiles/kml/paddle/red-circle.png';
                // createMarker(GLatLng,gicn,gname);
                
                initMap();
                function initMap() {                 
                    $('#floating-panel').css("display", "block");
                     directionsRenderer = new google.maps.DirectionsRenderer;
                     directionsService = new google.maps.DirectionsService;
                    //   var GLatLng = new google.maps.LatLng(current_lat, current_lng);
                    //  console.log(GLatLng);
                    map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 17,
                      center: {lat: current_lat, lng: current_lng},
                      
                    });
                    directionsRenderer.setMap(map);
            
                    calculateAndDisplayRoute(directionsService, directionsRenderer);
                    document.getElementById('mode').addEventListener('change', function() {
                      calculateAndDisplayRoute(directionsService, directionsRenderer);
                    });
                }
                function calculateAndDisplayRoute(directionsService, directionsRenderer) {
                    // console.log(destination_lat,destination_lng);
                    // console.log("desti");
                    var selectedMode = document.getElementById('mode').value;
                    directionsService.route({
                        //origin: {lat: 1.3553567, lng: 103.8678708},  // Haight.
                        //destination: {lat: 1.36, lng: 103.3},  // Ocean Beach.
                       
                        origin: {lat: parseFloat( current_lat ), lng: parseFloat( current_lng )},  // Haight.
                        destination: {lat: parseFloat( destination_lat ), lng: parseFloat( destination_lng )},  // Ocean Beach.
                      // Note that Javascript allows us to access the constant
                      // using square brackets and a string value as its
                      // "property."
                      travelMode: google.maps.TravelMode[selectedMode]
                    }, function(response, status) {
                      if (status == 'OK') {
                        directionsRenderer.setDirections(response);
                      } else {
                        window.alert('Directions request failed due to ' + status);
                      }
                    });
                  }
        });
    });
    
});
