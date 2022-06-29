<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
<script src="{{asset('app-assets/js/select2.full.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/app.js')}}"></script>
<!-- END: Theme JS-->
<script src="https://kit.fontawesome.com/92840116b8.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('app-assets/js/form-select2.js')}}"></script>
<script src="{{asset('app-assets/js/flatpickr.min.js')}}"></script>
@include('backend.partials.success_error_msg')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map_key.map_key') }}&libraries=places&callback=initialize"
    async defer></script>
<script src="{{ asset('js/mapInput.js') }}"></script>
<script>
    $(document).ready(function () {
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
    });
</script>

<script>
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    })

    window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
        toastr.success(event.detail.success, 'Success!');
    })

    window.addEventListener('show-delete-modal', event => {
        $('#confirmationModal').modal('show');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmationModal').modal('hide');
        toastr.success(event.detail.success, 'Success!');
    })

    window.addEventListener('show-reason-modal', event => {
        $('#reasonModal').modal('show');
    })

    window.addEventListener('hide-reason-modal', event => {
        $('#reasonModal').modal('hide');
        toastr.success(event.detail.success, 'Success!');
    })
</script>


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
