@push('styles')
    <style>
        .auth-wrapper.auth-v1 .auth-inner {
            max-width: 1200px;
        }

        @media (max-width: 991px) {
            .agency-login-btns {
                display: block !important;
                float: left;
                width: 100%;
            }

            .agency-login-btns .ms-50 {
                margin-left: 5px !important;
                margin-top: 5px;
                float: left;
            }
        }

        @media (max-width: 767px) {
            .auth-v1.px-2 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }

            .auth-v1 .card-body {
                padding: 1.5rem 0.5rem;
            }
        }
    </style>
@endpush
@extends('layouts.auth')
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <div class="card mb-0">
                            <div class="card-body position-relative">
                                <a href="{{route('dashboard')}}" class="brand-logo mb-2">
                                    <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         height="28">
                                        <defs>
                                            <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                                            y2="89.4879456%">
                                                <stop stop-color="#000000" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </lineargradient>
                                            <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                                            x2="37.373316%" y2="100%">
                                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </lineargradient>
                                        </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                                <g id="Group" transform="translate(400.000000, 178.000000)">
                                                    <path class="text-primary" id="Path"
                                                          d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                          style="fill: currentColor"></path>
                                                    <path id="Path1"
                                                          d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                          fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                    <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                             points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                                    </polygon>
                                                    <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                             points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                                    </polygon>
                                                    <polygon id="Path-3" fill="url(#linearGradient-2)"
                                                             opacity="0.099999994"
                                                             points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                                    </polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <h2 class="brand-text text-primary ms-1">{{__('Asaan Estate CRM')}}</h2>
                                </a>
                                <form class="text-end" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-danger waves-effect waves-float waves-light mb-2"
                                            type="submit">
                                        <i class="me-50" data-feather="power"></i> {{ __('Log out') }}
                                    </button>
                                </form>
                                <h3 class="card-text mb-2">{{__('Agency List')}} </h3>
                                <div class="users-page">
                                    <!-- Bordered table start -->
                                    <div class="content-header" id="table-bordered">
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{__('Agency')}}</th>
                                                        <th>{{__('Owner')}}</th>
                                                        <th>{{__('Phone')}}</th>
                                                        <th>{{__('Actions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($agencies as $agency)
                                                        <tr>
                                                            <td data-th="#">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td data-th="Name">
                                                                {{ $agency->name }}
                                                            </td>
                                                            <td data-th="Owner">
                                                                {{ $agency->users->first()->name }}
                                                            </td>
                                                            <td data-th="Phone">
                                                                {{ $agency->phone_no }}
                                                            </td>

                                                            <td data-th="Actions" class="d-flex agency-login-btns">
                                                                <form
                                                                    class="ms-50"
                                                                    action="{{route('owner-login', $agency->users->first())}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                            class="btn btn-primary">
                                                                        Login
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    class="ms-50"
                                                                    action="{{route('activate-owner', $agency->users->first())}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-info">
                                                                        @if($agency->users->first()->is_active)
                                                                            Activated @else Deactivated @endif
                                                                    </button>
                                                                </form>
                                                                <button type="button"
                                                                        class="btn btn-outline-primary ms-50"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModalCenter-{{$agency->users->first()->id}}">
                                                                    Change Password
                                                                </button>
                                                                <div class="card">
                                                                    <div class="card-header p-0">
                                                                        <!-- Vertical modal -->
                                                                        <div class="vertical-modal-ex">
                                                                            <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                 id="exampleModalCenter-{{$agency->users->first()->id}}"
                                                                                 tabindex="-1"
                                                                                 aria-labelledby="exampleModalCenterTitle"
                                                                                 aria-hidden="true">
                                                                                <div
                                                                                    class="modal-dialog modal-dialog-centered">
                                                                                    <div class="modal-content">
                                                                                        <div
                                                                                            class="modal-header bg-primary">
                                                                                            <h5 class="modal-title text-white"
                                                                                                id="exampleModalCenterTitle">
                                                                                                Change Password</h5>
                                                                                            <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                        </div>
                                                                                        <form
                                                                                            action="{{route('change-password',$agency->users->first()->id)}}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <div class="modal-body">
                                                                                                <label
                                                                                                    for="new_password">New
                                                                                                    Password: </label>
                                                                                                <div class="mb-1">
                                                                                                    <input
                                                                                                        id="new_password"
                                                                                                        type="password"
                                                                                                        name="new_password"
                                                                                                        placeholder="New Password"
                                                                                                        class="form-control"/>
                                                                                                </div>

                                                                                                <label
                                                                                                    for="new_password_confirmation">Confirm
                                                                                                    New
                                                                                                    Password: </label>
                                                                                                <div class="mb-1">
                                                                                                    <input
                                                                                                        id="new_password_confirmation"
                                                                                                        type="password"
                                                                                                        name="new_password_confirmation"
                                                                                                        placeholder="Confirm New Password"
                                                                                                        class="form-control"/>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit"
                                                                                                        class="btn btn-primary">
                                                                                                    Submit
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Vertical modal end-->
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bordered table end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
