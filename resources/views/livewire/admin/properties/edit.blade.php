@section('title', 'Property/Edit')
<div class="prop-form-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{__('Edit Property')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('properties')}}">{{__('Properties')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('Create Property')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Modern Horizontal Wizard -->
            <section class="modern-horizontal-wizard">
                <div class="bs-stepper wizard-modern modern-wizard-example">
                    <div class="bs-stepper-header">
                        <div class="step @if ($currentStep === 1) active @endif"
                             data-target="#account-details-modern" role="tab"
                             id="account-details-modern-trigger">
                            <button type="button" class="step-trigger"
                                    aria-selected="true">
                                    <span class="bs-stepper-box" wire:ignore>
                                        <i data-feather="home" class="font-medium-3"></i>
                                    </span>
                                <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{__('Properties')}}</span>
                                        <span class="bs-stepper-subtitle">{{__('Add Property')}}</span>
                                    </span>
                            </button>
                        </div>
                        <div class="line" wire:ignore>
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step @if ($currentStep === 2) active @endif"
                             data-target="#address-step-modern" role="tab"
                             id="address-step-modern-trigger">
                            <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box" wire:ignore>
                                        <i data-feather="file" class="font-medium-3"></i>
                                    </span>
                                <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{__('Property Details')}}</span>
                                        <span class="bs-stepper-subtitle">{{__('Add Property')}}</span>
                                    </span>
                            </button>
                        </div>
                        <div class="line" wire:ignore>
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step @if ($currentStep === 3) active @endif" data-target="#property-features"
                             role="tab"
                             id="property-features-trigger">
                            <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box" wire:ignore>
                                        <i data-feather="file-plus" class="font-medium-3"></i>
                                    </span>
                                <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{__('Property Features')}}</span>
                                        <span class="bs-stepper-subtitle">{{__('Add Features')}}</span>
                                    </span>
                            </button>
                        </div>
                        <div class="line" wire:ignore>
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step @if ($currentStep === 4) active @endif" data-target="#media-details-modern"
                             role="tab"
                             id="media-details-modern-trigger">
                            <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box" wire:ignore>
                                        <i data-feather="image" class="font-medium-3"></i>
                                    </span>
                                <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{__('Media Details')}}</span>
                                        <span class="bs-stepper-subtitle">{{__('Add Media')}}</span>
                                    </span>
                            </button>
                        </div>
                        <div class="line" wire:ignore>
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step @if ($currentStep === 5) active @endif"
                             data-target="#document-details-modern" role="tab"
                             id="document-details-modern-trigger">
                            <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box" wire:ignore>
                                        <i data-feather="file-text" class="font-medium-3"></i>
                                    </span>
                                <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{__('Document Details')}}</span>
                                        <span class="bs-stepper-subtitle">{{__('Add Document')}}</span>
                                    </span>
                            </button>
                        </div>
                        <div class="line" wire:ignore>
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step @if ($currentStep === 6) active @endif" data-target="#personal-info-modern"
                             role="tab"
                             id="personal-info-modern-trigger">
                            <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box" wire:ignore>
                                        <i data-feather="user" class="font-medium-3"></i>
                                    </span>
                                <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">{{__('Customer Details')}}</span>
                                        <span class="bs-stepper-subtitle">{{__('Add Customer Info')}}</span>
                                    </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form wire:submit.prevent="update" autocomplete="off">
                            @if ($currentStep === 1)
                                @include('livewire.admin.properties.partials.property')
                            @endif
                            @if ($currentStep === 2)
                                @include('livewire.admin.properties.partials.property-details')
                            @endif
                            @if ($currentStep === 3)
                                @include('livewire.admin.properties.partials.features')
                            @endif
                            @if ($currentStep === 4)
                                @include('livewire.admin.properties.partials.media')
                            @endif
                            @if ($currentStep === 5)
                                @include('livewire.admin.properties.partials.document')
                            @endif
                            @if ($currentStep === 6)
                                @include('livewire.admin.properties.partials.customer')
                            @endif
                            <div class="d-flex justify-content-between">
                                @if ($currentStep == 1)
                                    <div></div>
                                @endif

                                @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5 || $currentStep == 6)
                                    <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">
                                        {{__('Back')}}
                                    </button>
                                @endif

                                @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5 )
                                    <button type="button" class="btn btn-md btn-primary" wire:click="increaseStep()">
                                        {{__('Next')}}
                                    </button>
                                @endif

                                @if ($currentStep == 6)
                                    <button type="submit" class="btn btn-md btn-primary">{{__('Submit')}}</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- /Modern Horizontal Wizard -->
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('app-assets/js/bs-stepper.min.js')}}"></script>
    <script src="{{asset('app-assets/js/form-wizard.js')}}"></script>
@endpush
