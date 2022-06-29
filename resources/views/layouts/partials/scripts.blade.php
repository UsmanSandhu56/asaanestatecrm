<script src="https://kit.fontawesome.com/92840116b8.js" crossorigin="anonymous"></script>

<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/page-auth-login.js')}}"></script>
<script src="{{asset('app-assets/js/select2.full.min.js')}}"></script>
<script src="{{asset('app-assets/js/form-select2.js')}}"></script>
<!-- END: Page JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if (request()->routeIs('agencies.index') || request()->routeIs('payment-details'))
    @include('backend.partials.success_error_msg')
@endif
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
