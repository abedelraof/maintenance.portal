@extends("layouts.app")
@section("content")
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">`
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
                                <?php foreach ($categories as $key => $category): ?>
                                <li class="nav-item">
                                    <a data-id="{{ $category->id }}"
                                       class="category-link nav-link  @if($key == 1) active @endif"
                                       id="home-tab-5" data-toggle="tab"
                                       href="#home-5">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-chat-1"></i>
                                                </span>
                                        <span class="nav-text">
                                            <i class="fas fa-chevron-circle-left  mr-2"></i>
                                            <span>{{ $category->name_ar }}</span>
                                        </span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-xl-9 p-10" style="box-shadow: 2px 0 20px 0px #80808059;">
                            <div class="tab-content" id="myTabContent5">
                                <div class="tab-pane fade active show" id="home-5" role="tabpanel"
                                     aria-labelledby="home-tab-5">

                                    <form action="{{ route("tickets.store") }}" id="tickets-store-form" method="post">

                                        @csrf


                                        <input type="hidden" value="{{ old("lat") }}" name="lat" id="input_hd_lat">

                                        <input type="hidden" value="{{ old("lng") }}" name="lng" id="input_hd_lng">

                                        <input type="hidden" value="{{ $property->id }}" name="property_id"
                                               id="input_hd_property_id">

                                        <input type="hidden" value="{{ session("user")->id }}" name="customer_id"
                                               id="input_hd_customer_id">

                                        <input type="hidden" value="{{ $units[0]->id }}" name="units[]"
                                               id="input_hd_units">

                                        <input type="hidden" value="{{ old("category", $categories[1]->id) }}"
                                               name="category"
                                               id="input_hd_category">

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label">
                                                        رقم العقد *
                                                    </label>
                                                    <input type="text"
                                                           readonly
                                                           class="form-control bg-gray-100"
                                                           name="contract_number"
                                                           value="{{ $asaasContract->cid }}">

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label">
                                                        اسم العقار *
                                                    </label>
                                                    <input type="text"
                                                           class="form-control"
                                                           disabled=""
                                                           value="{{ $property->title }}"
                                                           aria-describedby="emailHelp">

                                                    @if($errors->any("property_id"))
                                                        <div
                                                            class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                            {{ $errors->first("property_id") }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label">
                                                        رقم الوحدة *
                                                    </label>
                                                    <input type="text"
                                                           class="form-control"
                                                           disabled=""
                                                           value="{{ implode(" , ", array_map(function ($item) {
    return $item->number;
}, $units)) }}"
                                                    >

                                                    @if($errors->any("units"))
                                                        <div
                                                            class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                            {{ $errors->first("units") }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="l1"
                                                           class="form-label">
                                                        تفاصيل الطلب *
                                                    </label>
                                                    <textarea name="description"
                                                              id="l1"
                                                              class="form-control" id=""
                                                              cols="30"
                                                              placeholder="أدخل تفاصيل الطلب هنا "
                                                              rows="10">{{ old("description") }}</textarea>

                                                    @if($errors->any("description"))
                                                        <div
                                                            class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                            {{ $errors->first("description") }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="l2"
                                                           class="form-label">
                                                        رقم الجوال *
                                                    </label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="l2"
                                                           name="mobileNumber"
                                                           value="{{ old("mobileNumber", session()->get("user")->mobile) }}"
                                                           aria-describedby="emailHelp">

                                                    @if($errors->any("mobileNumber"))
                                                        <div
                                                            class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                            {{ $errors->first("mobileNumber") }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="l3"
                                                           class="form-label">
                                                        رقم جوال أخر
                                                    </label>`
                                                    <input type="text"
                                                           name="otherMobileNumber"
                                                           class="form-control"
                                                           value="{{ old("otherMobileNumber") }}"
                                                           placeholder="أدخل رقم جوال اّخر هنا"
                                                           id="l3">

                                                    @if($errors->any("otherMobileNumber"))
                                                        <div
                                                            class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                            {{ $errors->first("otherMobileNumber") }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                           class="form-label">
                                                        اختر موقعك على الخريطة *
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

                                                        @if($errors->any("lat"))
                                                            <div
                                                                class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                                {{ $errors->first("lat") }}
                                                            </div>
                                                        @endif

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

                                                    @if($errors->any("files"))
                                                        <div
                                                            class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                                            {{ $errors->first("files") }}
                                                        </div>
                                                    @endif

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
