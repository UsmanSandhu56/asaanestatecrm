@section('title', 'Profile')
<div>
    <div class="content-overlay">
    </div>
    <div class="header-navbar-shadow">
    </div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{__('Account Settings')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{__('Profile')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="page-account-settings" class="profile-page-res">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            @role('owner')
                            <li class="nav-item">
                                <a wire:ignore
                                   class="nav-link active prof-page-icon" id="account-pill-general"
                                   data-bs-toggle="pill"
                                   href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="home" class="font-medium-3 me-1 prof-page-ico-f"></i>
                                    <span class="fw-bold">{{__('Agency Details')}}</span>
                                </a>
                            </li>
                            @endrole
                            <!-- personal -->
                            <li class="nav-item">
                                <a wire:ignore
                                   class="prof-page-icon nav-link @rolenot('owner') active @endrolenot"
                                   id="account-pill-personal"
                                   data-bs-toggle="pill"
                                   href="#account-vertical-personal" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 me-1 prof-page-ico-f"></i>
                                    <span class="fw-bold">{{__('Personal')}}</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a wire:ignore
                                   class="prof-page-icon nav-link " id="account-pill-password"
                                   data-bs-toggle="pill"
                                   href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 me-1 prof-page-ico-f"></i>
                                    <span class="fw-bold">{{__('Change Password')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    @role('owner')
                                    @include('livewire.admin.profile.owner-profile')
                                    @else
                                    @include('livewire.admin.profile.admin-agent-profile')
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
        </div>
    </div>
</div>
