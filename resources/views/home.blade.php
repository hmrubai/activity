@extends('layouts.master') 
@section('content') 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Activities</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $activities }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"><p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Show All Visitors </p></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-receipt text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Daily Activities</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $activities }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"><p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Show All Activities </p></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Inactive</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"><p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> See All </p></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Active</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $user }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"> <p class="text-muted mt-3 mb-0"><i class="mdi mdi-reload mr-1" aria-hidden="true"></i> See Active List </p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                    My Location
                    <div id="map" style="width: 500px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="#"
                    target="_blank">DGDA</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="#"
                    target="_blank">Cerebrum Technology Limited</a></span>
        </div>
    </footer>
    <script>
        $("#home").addClass("active");
    
        //Get GEO Location
        var x = document.getElementById("demo");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
        }
        //end of GEO Location

        //get location via google map
        if (navigator.geolocation) { 
            navigator.geolocation.getCurrentPosition(function(position) {  
                var point = new google.maps.LatLng(position.coords.latitude, 
                                                position.coords.longitude);
                // Initialize the Google Maps API v3
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: point,
                mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // Place a marker
                new google.maps.Marker({
                position: point,
                map: map
                });
                
                
                google.maps.event.addListener(map, 'click', function (event) {
                    //alert(event.latLng);          
                    geocoder.geocode({
                        'latLng': event.latLng
                    }, function (results, status) {
                        console.log(results);
                        // if (status ==
                        //     google.maps.GeocoderStatus.OK) {
                        //     if (results[1]) {
                        //         alert(results[1].formatted_address);
                        //     } else {
                        //         alert('No results found');
                        //     }
                        // } else {
                        //     alert('Geocoder failed due to: ' + status);
                        // }
                    });
                }); 
                //google.maps.event.addDomListener(window, 'load', initialize);



            }); 
        } 
        else {
            alert('W3C Geolocation API is not available');
        }

    </script>
</div> 
@endsection
