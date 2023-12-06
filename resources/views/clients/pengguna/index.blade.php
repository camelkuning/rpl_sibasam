@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 25px;">
                @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>

        </div>
        
        <div id="maps" class="w-100" style="height: 400px">

        </div>
        <input type="text" id="latitudeInput">
        <input type="text" id="longitudeInput">


        <script>
            function initMap() {
                map = new google.maps.Map(document.getElementById("maps"), {
                    center: {
                        lat: -6.175392,
                        lng: 106.827153,
                    },
                    zoom: 15,
                });
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            var userLocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };
                            var marker = new google.maps.Marker({
                                position: userLocation,
                                map: map,
                                title: "Lokasi Saat Ini",
                            });
                            map.setCenter(userLocation);
                            // Mengisi nilai latitude dan longitude ke dalam input teks

                            document.getElementById("latitudeInput").value =
                                userLocation.lat;
                            document.getElementById("longitudeInput").value =
                                userLocation.lng;
                        },
                        function(error) {
                            console.error("Error: " + error.message);
                        }
                    );
                } else {
                    console.error("Error: Your browser doesn't support geolocation.");
                }
            }
        </script>
    </div>
@endsection

@push('js')
    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    </script>
@endpush
