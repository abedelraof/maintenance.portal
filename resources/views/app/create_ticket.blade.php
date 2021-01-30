@extends("layouts.app")
@section("content")
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">اضافة طلب صيانة جديد </h3>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!--begin::Example-->
                    <div class="row no-gutters" style="overflow: hidden;">
                        <div class="col-xl-3">
                            <ul class="nav flex-column nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab-5" data-toggle="tab"
                                       href="#home-5">
																			<span class="nav-icon">
																				<i class="flaticon2-chat-1"></i>
																			</span>
                                        <span class="nav-text">
                                                                <i class="fas fa-tint-slash mr-2"></i>
                                                                <span>صيانة مياه</span>
                                                            </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-5" data-toggle="tab"
                                       href="#profile-5" aria-controls="profile">
																			<span class="nav-icon">
																				<i class="flaticon2-layers-1"></i>
																			</span>

                                        <span class="nav-text">
                                                                <i class="fas fa-hammer mr-2"></i>
                                                                <span>صيانة كهرباء</span>
                                                            </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab-5" data-toggle="tab"
                                       href="#profile-5" aria-controls="profile">
																			<span class="nav-icon">
																				<i class="flaticon2-layers-1"></i>
																			</span>
                                        <span class="nav-text">
                                                                <i class="fas fa-door-open mr-2"></i>
                                                                <span>صيانة مصاعد</span>
                                                            </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-5" data-toggle="tab"
                                       href="#profile-5" aria-controls="profile">
																			<span class="nav-icon">
																				<i class="flaticon2-layers-1"></i>
																			</span>
                                        <span class="nav-text">
                                                                <i class="fas fa-temperature-low mr-2"></i>
                                                                <span>صيانة تكييف</span>
                                                            </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-5" data-toggle="tab"
                                       href="#profile-5" aria-controls="profile">
																			<span class="nav-icon">
																				<i class="flaticon2-layers-1"></i>
																			</span>
                                        <span class="nav-text">
                                                                <i class="fas fa-soap mr-2"></i>
                                                                <span>تنظيف</span>
                                                            </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab-5" data-toggle="tab"
                                       href="#profile-5" aria-controls="profile">
																			<span class="nav-icon">
																				<i class="flaticon2-layers-1"></i>
																			</span>
                                        <span class="nav-text">
                                                                <i class="fab fa-mixcloud mr-2"></i>
                                                                <span>طلبات اخرى</span>
                                                            </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-9 p-10" style="box-shadow: 2px 0 20px 0px #80808059;">
                            <div class="tab-content" id="myTabContent5">
                                <div class="tab-pane fade active show" id="home-5" role="tabpanel"
                                     aria-labelledby="home-tab-5">

                                    <form>

                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1"
                                                           class="form-label">اسم
                                                        العقار</label>
                                                    <input type="text" class="form-control"
                                                           id="exampleInputEmail1" disabled=""
                                                           value="عقار الأطباء 10"
                                                           aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                           class="form-label">رقم
                                                        الوحدة</label>
                                                    <input type="text" class="form-control"
                                                           disabled=""
                                                           value="شقة رقم 201 , حاصل رقم 2010"
                                                           id="exampleInputPassword1">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1"
                                                           class="form-label">تفاصيل
                                                        الطلب</label>
                                                    <textarea name="" class="form-control" id=""
                                                              cols="30"
                                                              placeholder="أدخل تفاصيل الطلب هنا "
                                                              rows="10"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1"
                                                           class="form-label">
                                                        رقم الجوال
                                                    </label>
                                                    <input type="text" class="form-control"
                                                           id="exampleInputEmail1"
                                                           value="0597848418"
                                                           aria-describedby="emailHelp">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                           class="form-label">
                                                        رقم جوال أخر
                                                    </label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل رقم جوال اّخر هنا"
                                                           id="exampleInputPassword1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                           class="form-label">
                                                        اختر موقعك على الخريطة
                                                    </label>
                                                    <div>
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

                                        <div class="row mt-3">
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                           class="form-label">
                                                        ارفاق ملفات
                                                    </label>
                                                    <div action="/file-upload" class="dropzone">
                                                        <div class="dz-message" data-dz-message="">
                                                            <span>قم بسحب وافلات الصور هنا أو بامكانك الضغط هنا لتحميل الملف</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-xl-6">
                                                <button type="submit"
                                                        class="btn btn-lg btn-primary">
                                                    إرسال الطلب
                                                </button>
                                            </div>
                                        </div>


                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Example-->
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
                $('.lat').text(lat);
                $('.long').text(long);

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
                // click on map and set you marker to that position
                // google.maps.event.addListener(map, 'click', function (event) {
                //     console.log("test")
                //     marker.setPosition(event.latLng);
                // });
            });

            $(".dropzone").dropzone({url: "/file/post"});

        });
    </script>
@endsection
