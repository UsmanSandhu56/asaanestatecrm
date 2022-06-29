<link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
<link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.png')}}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
      rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/select2.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/bordered-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/semi-dark-layout.css')}}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/page-auth.css')}}">

<!-- END: Page CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/style.css')}}">
<!-- END: Custom CSS-->
<style>
    .phone_no {
        padding: 0.571rem 1rem !important;
    }
</style>
<style>
    .users-page .table {
        width: 100%;
        min-width: 250px;
        max-width: 100%;
    }

    .users-page .table th {
        display: none;
    }

    .users-page .table td {
        display: block;
    }

    .users-page .table td:before {
        content: attr(data-th) ": ";
        font-weight: bold;
        width: 80px;
        display: inline-block;
        float: left;
    }

    @media screen and (max-width: 601px) {
        .users-page .table tr:nth-child(2) {
            border-top: none;
        }
    }

    @media screen and (min-width: 600px) {

        .users-page .table td:before {
            display: none;
        }

        .users-page .table th,
        .users-page .table td {
            display: table-cell;
            padding: .25em .5em;
        }

        .users-page .table th:first-child,
        .users-page .table td:first-child {
            padding-left: 0;
        }

        .users-page .table th:last-child,
        .users-page .table td:last-child {
            padding-right: 0;
        }

        .users-page .table th,
        .users-page .table td {
            padding: 1em !important;
        }
    }
</style>
