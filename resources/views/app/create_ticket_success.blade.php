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
                                            <i class="fab fa-audible mr-2"></i>
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


                                    <div style="
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-top: 50px;
    margin-bottom: 50px;
">
                                        <img src="/img/check.svg" alt="" style="
    height: 200px;
    margin-bottom: 30px;
">
                                        <p style="
    margin-bottom: 30px;
    font-size: 20px;
">
                                            شكرا لك تم استلام طلبك بنجاح سيتم التنواصل معك قريبا
                                        </p>
                                        <div>
                                            <a href="{{ route("tickets.create") }}" class="btn btn-lg btn-primary">
                                                اضافة طلب جديد
                                            </a>
                                        </div>
                                    </div>

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
