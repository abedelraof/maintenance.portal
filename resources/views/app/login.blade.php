@extends("layouts.login")
@section("content")

    <!--begin::Content-->
    <div
        class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <!--begin::Content body-->
        <div class="d-flex flex-column-fluid flex-center">
            <!--begin::Signin-->
            <div class="login-form login-signin">
                <!--begin::Form-->
                <form method="post" action="{{ route("auth.login.submit") }}"
                      class="form fv-plugins-bootstrap fv-plugins-framework"
                      novalidate="novalidate"
                      id="kt_login_signin_form">
                @csrf
                <!--begin::Title-->
                    <div class="pb-13 pt-lg-0 pt-5">
                        <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">أهلا وسهلا بك</h3>
                        <span
                            class="text-muted font-weight-bold font-size-h4">مجموعة محمد النهدي - بوابة المستأجرين</span>
                    </div>
                    <!--begin::Title-->
                    <!--begin::Form group-->
                    <div class="form-group fv-plugins-icon-container">
                        <label for="contractNumber" class="font-size-h6 font-weight-bolder text-dark">رقم العقد</label>
                        <input id="contractNumber"
                               class="form-control form-control-solid h-auto p-6 rounded-lg"
                               type="text"
                               name="contractNumber"
                               value="{{ old("contractNumber") }}"
                               placeholder="أدخل رقم العقد هنا "
                               autocomplete="off">

                        @if($errors->any("contractNumber"))
                            <div
                                class="fv-plugins-message-container  font-size-h6-xl text-danger mt1">
                                {{ $errors->first("contractNumber") }}
                            </div>
                        @endif

                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group fv-plugins-icon-container">
                        <div class="d-flex justify-content-between mt-n5">
                            <label for="id" class="font-size-h6 font-weight-bolder text-dark pt-5">رقم الهوية </label>
                        </div>
                        <input class="form-control form-control-solid h-auto p-6 rounded-lg"
                               type="text"
                               placeholder="أدخل رقم الهوية هنا"
                               name="id"
                               id="id"
                               value="{{ old("id") }}"
                               autocomplete="off">
                        @if($errors->any("id"))
                            <div
                                class="fv-plugins-message-container font-size-h6-xl text-danger mt1">
                                {{ $errors->first("id") }}
                            </div>
                        @endif
                    </div>
                    <!--end::Form group-->
                    <!--begin::Action-->
                    <div class="pb-lg-0 pb-5">
                        <button type="submit" id="kt_login_signin_submit"
                                class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">تسجبل
                            دخول
                        </button>
                    </div>
                    <!--end::Actillon-->

                    <div style="margin-top: 40px">
                        Powered by <a href="https://asaas.rent">asaas.rent</a>
                    </div>
                    <input type="hidden">
                    <div></div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signin-->
        </div>
        <!--end::Content body-->
    </div>
    <!--end::Content-->

@endsection
