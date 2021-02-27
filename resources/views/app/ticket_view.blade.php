@extends("layouts.app")
@section("content")

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH8nToB0uXjiezLX0LX6thrjMJSn_7MkI&callback=initMap&libraries=places&v=weekly"
        defer></script>
    <style>

        .card.card-custom {
            box-shadow: 0 2px 1px 1px #00000014;
        }

        .card {
            height: 100%;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            max-width: 60%;
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
            border: 1px solid gray;
            margin: 10px;
            line-height: 34px;
            height: 34px;
            box-shadow: 0px 2px 6px 0px #00000059;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .gallery-x {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .gallery-x-item {
            height: 200px;
            width: 200px;
            margin: 10px;
            overflow: hidden;
        }

        .gallery-x-item > .gallery-x-object {
            width: 100%;
        }

        .gallery-x-object.gallery-x-object-file {
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
            height: 100%;
            color: gray;
        }

        .gallery-x-object.gallery-x-object-file i {
            font-size: 50px;
            margin-bottom: 10px;
        }

    </style>




    <!--begin::Row-->
    <div class="row mb-8">

        <div class="col-lg-4">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            عرض تفاصيل طلب رقم #{{ $model->id }}
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">

                    <div class="mt-2">
                        <strong class="color5 mr-3"> تاريخ الطلب</strong>
                        <span><?php echo date("Y-m-d", strtotime($model->created_at)); ?></span>
                    </div>

                    <div class="mt-2">
                        <strong class="color5 mr-3">اسم المستأجر</strong>
                        <span><?php echo session()->get("user")->name; ?></span>
                    </div>

                    @if($model->renter_mobile)
                        <div class="mt-2">
                            <strong class="color5 mr-3">رقم الجوال</strong>
                            <span><?php echo $model->renter_mobile; ?></span>
                        </div>
                    @endif

                    @if($model->otherMobileNumber)
                        <div class="mt-2">
                            <strong class="color5 mr-3">رقم جوال اخر</strong>
                            <span><?php echo $model->otherMobileNumber; ?></span>
                        </div>
                    @endif

                    @if($model->category)
                        <div class="mt-2">
                            <strong class="color5 mr-3">التصنيف</strong>
                            <span><?php echo $model->category->name_ar; ?></span>
                        </div>
                    @endif

                    @if($model->getVendorName())
                        <div class="mt-2">
                            <strong class="color5 mr-3">مزود الخدمة</strong>
                            <span><?php echo $model->getVendorName(); ?></span>
                        </div>
                    @endif

                    @if(!empty($model->contract_number))
                        <div class="mt-2">
                            <strong class="color5 mr-3">رقم العقد</strong>
                            <span><?php echo $model->contract_number; ?></span>
                        </div>
                    @endif

                    @if($model->getPropertyName())
                        <div class="mt-2">
                            <strong class="color5 mr-3">اسم العقار</strong>
                            <span><?php echo $model->getPropertyName(); ?></span>
                        </div>
                    @endif

                    @if($model->property_location)
                        <div class="mt-2">
                            <strong class="color5 mr-3">مكان العقار</strong>
                            <span><?php echo $model->property_location; ?></span>
                        </div>
                    @endif

                    @if($model->getUnitNumber())
                        <div class="mt-2">
                            <strong class="color5 mr-3">الوحدة</strong>
                            <span><?php echo $model->getUnitNumber(); ?></span>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            تفاصيل الطلب
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5">

                    {{ $model->notes }}

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            موقع الطلب على الخريطة
                        </h3>
                    </div>
                </div>
                <div class="card-body p-5" style="position: relative">
                    <input
                        id="pac-input"
                        class="controls"
                        type="text"
                        placeholder="Search Box"
                    />
                    <div id="googleMap"
                         style="height: 400px"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="card card-custom gutter-b" style="height: auto">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    الملفات المرفقة
                </h3>
            </div>
        </div>
        <div class="card-body p-5">
            <div class="gallery-x">
                @foreach($files as $file)
                    <a href="{{ $file->full_path }}" target="_blank"
                       class="gallery-x-item img-thumbnail">
                        @if($file->isImage)
                            <img src="{{ $file->full_path }}" alt="..."
                                 class="gallery-x-object">
                        @else
                            <div class="gallery-x-object gallery-x-object-file">
                                <i class="fa fa-file-text-o"></i>
                                <span>{{ $file->name }}</span>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var map, marker;
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

            let lat = "{{ $model->property_latitude }}";
            let lng = "{{ $model->property_longitude }}";
            if (lat && lng) {
                google.maps.event.addDomListener(window, 'load', myMap(lat, lng));
            } else {
                google.maps.event.addDomListener(window, 'load', myMap(26.2172, 50.1971));
            }

        });
    </script>
@endsection
