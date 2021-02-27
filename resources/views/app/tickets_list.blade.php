@extends("layouts.app")
@section("content")
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">`
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">قائمة طلبات الصيانة </h3>
                    </div>
                </div>
                <div class="card-body p-5">
                    <table class="table table-hover">
                        <thead>
                        <tr class="bg-success-o-35 border-top-success " style="border-bottom: 2px solid #5b8a88">
                            <td>
                                رقم الطلب
                            </td>
                            <td>
                                اسم العقار
                            </td>
                            <td>
                                رقم الوحدة
                            </td>
                            <td>
                                رقم العقد
                            </td>
                            <td>
                                التصنيف
                            </td>
                            <td>
                                عرض
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $datum)
                            <tr>
                                <td>{{ "T-" . $datum->id }}</td>
                                <td>{{ $datum->getPropertyName() }}</td>
                                <td>{{ $datum->getUnitNumber() }}</td>
                                <td>{{ $datum->contract_number }}</td>
                                <td>{{ $datum->getCategoryName() }}</td>
                                <td>
                                    <a href="{{ route("tickets.view", $datum->id) }}">
                                        عرض
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{ $data->links()}}
                    </div>

                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Row-->
@endsection
@section("js")

    <script>
        var map, marker;
        filesList = {}
        counter = 100;
        $(document).ready(function () {

            function myMap(lat, long) {
                var myCenter = new google.maps.LatLng(lat, long);
                var mapCanvas = document.getElementById("googleMap");

                var mapOptions = {
                    center: myCenter,
                    zoom: 15,
                    treetViewControl: false,
                    mapTypeControl: false
                };

                map = new google.maps.Map(mapCanvas, mapOptions);

                // Create the search box and link it to the UI element.
                const input = document.getElementById("pac-input");
                const searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                // Bias the SearchBox results towards current map's viewport.
                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                });

                marker = new google.maps.Marker(
                    {
                        position: myCenter,
                        draggable: true
                    }
                );
                marker.setMap(map);


                //sets variable for lat and long
                $('#input_hd_lat').val(lat);
                $('#input_hd_lng').val(long);

                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }
                    // Clear out the old markers.
                    // markers.forEach((marker) => {
                    //     marker.setMap(null);
                    // });
                    // markers = [];
                    // For each place, get the icon, name and location.
                    const bounds = new google.maps.LatLngBounds();
                    places.forEach((place) => {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        // const icon = {
                        //     url: place.icon,
                        //     size: new google.maps.Size(71, 71),
                        //     origin: new google.maps.Point(0, 0),
                        //     anchor: new google.maps.Point(17, 34),
                        //     scaledSize: new google.maps.Size(25, 25),
                        // };
                        // // Create a marker for each place.
                        // markers.push(
                        //     new google.maps.Marker({
                        //         map,
                        //         icon,
                        //         title: place.name,
                        //         position: place.geometry.location,
                        //     })
                        // );

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });

                map.addListener('click', function (event) {
                    marker.setPosition(event.latLng);
                    $('#input_hd_lat').val(event.latLng.lat());
                    $('#input_hd_lng').val(event.latLng.lng());
                })

            }

            function newLocation(newLat, newLng) {
                map.setCenter({
                    lat: newLat,
                    lng: newLng
                });
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        google.maps.event.addDomListener(window, 'load', myMap(position.coords.latitude, position.coords.longitude));

                    },
                    () => {
                        google.maps.event.addDomListener(window, 'load', myMap(26.2172, 50.1971));
                    }
                );
            } else {
                google.maps.event.addDomListener(window, 'load', myMap(26.2172, 50.1971));
            }


            $(document).ready(function () {
                $(".category-link").on("click", function () {
                    $("#input_hd_category").val($(this).data("id"));
                });
            });

            let myDropzone = new Dropzone(".dropzone", {
                addRemoveLinks: true,
                url: "{{ route("files.upload") }}"
            });
            myDropzone.on("success", function (file) {
                let response = JSON.parse(file.xhr.response);
                let id = counter++;
                filesList[file.name] = id;
                $("form#tickets-store-form").prepend(
                    $("<input/>")
                        .attr("id", id)
                        .attr("type", "hidden")
                        .attr("name", "files[]")
                        .val(response.id)
                )
                // console.log(response)
            });
            myDropzone.on("removedfile", function (file) {
                let id = filesList[file.name];
                console.log($(`#${id}`))
                $(`#${id}`).remove();
                return true;
            });

        });
    </script>
@endsection
