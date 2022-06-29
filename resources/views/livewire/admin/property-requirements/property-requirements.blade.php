@section('title', 'Property Requirements')
<div class="ecommerce-application auto-match-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-sm-8 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{__('Property Requirements')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('Property Requirements')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-4 col-sm-4 col-12 text-end mb-2">
                @can('property-requirement-create')
                <a href="{{route('property-requirements.create')}}" class="btn btn-outline-primary">
                    {{__('Create Requirements')}}
                </a>
                @endcan
                @if($propertyRequirements->count() >= 8)
                    <div wire:ignore class="form-modal-ex text-end position-relative">
                        <button type="button" id="filter-btn" class="btn btn-outline-primary btn-icon btn-round btn-sm">
                            <i data-feather="filter"></i>
                        </button>
                        @if(!empty($filterCounter))
                            <span class="badge rounded-pill bg-warning badge-up">{{$filterCounter}}</span>
                        @endif
                    </div>
                @endif
            </div>
            @if($propertyRequirements->count() >= 8)
                @include('livewire.admin.partials.filters')
            @endif
        </div>
        <div class="content-body">
            <div class="bs-stepper checkout-tab-steps">
                <!-- Wizard starts -->
                <div class="bs-stepper-header">
                    <div class="step" data-target="#step-cart" role="tab" id="step-cart-trigger">
                        <button type="button" class="step-trigger">

                        </button>
                    </div>
                </div>
                <!-- Wizard ends -->

                <div class="bs-stepper-content">
                    <div id="step-cart" class="content auto-match-content " role="tabpanel">
                        <div id="place-order" class="list-view product-checkout">
                            <div class="text-center">
                                <div wire:loading wire:target="filter" class="spinner-border text-success"
                                     role="status">
                                    <span class="sr-only">{{__('Loading...')}}</span>
                                </div>
                            </div>
                            <div wire:loading.remove wire:target="filter" class="checkout-items">
                                @forelse($propertyRequirements as $propertyRequirement)
                                    <div @if ($loop->last) id="last_record" @endif
                                        class="card ecommerce-card result-card-body property-listing property-listing-req">
                                        <div class="item-options text-center home-area-detail det-mob-card">
                                            <div class="prop-det">
                                                <div class="item-wrapper">
                                                    <h2 class="text-body fw-bolder">{{$propertyRequirement->title}}</h2>
                                                </div>
                                                <div class="item-wrapper card-loc mb-1 mt-1">
                                                    <span><i class="fa fa-map-marker"></i></span>
                                                    <a href="#"
                                                       class="text-body">{{$propertyRequirement->propertyRequirementDetail->location}}</a>
                                                </div>
                                                <span class="det-price-btn" target="_self">
                                                    <h5 class="fw-bolder text-primary">{{__('Budget')}}: <span class="fw-bold">{{$propertyRequirement->min_price}} - {{$propertyRequirement->max_price}}</span></h5>
                                                </span>
                                            </div>

                                            <div class="card-body result-items-card det-icons-2"
                                                 style="padding-bottom: 0 !important;">
                                                @if($propertyRequirement->category_id === 1 && $propertyRequirement->propertyRequirementDetail !== null)
                                                    <div class="item-name result-items">
                                                        @if($propertyRequirement->propertyRequirementDetail->max_rooms !== null)
                                                            <span><i class="fas fa-bed"></i> {{$propertyRequirement->propertyRequirementDetail->max_rooms}}</span>
                                                        @endif
                                                        @if($propertyRequirement->propertyRequirementDetail->max_bathrooms !== null)
                                                            <span><i class="fas fa-shower"></i> {{$propertyRequirement->propertyRequirementDetail->max_bathrooms}}</span>
                                                        @endif
                                                        @if($propertyRequirement->propertyRequirementDetail->parking_space !== null)
                                                            <span><i class="fas fa-car"></i> {{$propertyRequirement->propertyRequirementDetail->parking_space}}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($propertyRequirement->amenities !== null)
                                                    <div class="item-name result-items mt-1">
                                                <span><i class="fas fa-fire"></i> <i
                                                        class="far fa-check-circle @if(in_array(2, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                        <span><i class="fas fa-bolt"></i> <i
                                                                class="far fa-check-circle @if(in_array(3, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                        <span><i class="fas fa-tint"></i> <i
                                                                class="far fa-check-circle @if(in_array(4, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                    </div>
                                                @endif
                                                <div class="item-quantity">
                                                    <p class="quantity-title mb-0 mt-2">
                                                        {{$propertyRequirement->description}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body result-items-card">
                                            @if($propertyRequirement->category_id === 1 && $propertyRequirement->propertyRequirementDetail !== null)
                                                <div class="item-name result-items">
                                                    @if($propertyRequirement->propertyRequirementDetail->max_rooms !== null)
                                                        <span><i class="fas fa-bed" aria-hidden="true"></i> {{$propertyRequirement->propertyRequirementDetail->max_rooms}}</span>
                                                    @endif
                                                    @if($propertyRequirement->propertyRequirementDetail->max_bathrooms !== null)
                                                        <span><i class="fas fa-shower" aria-hidden="true"></i> {{$propertyRequirement->propertyRequirementDetail->max_bathrooms}}</span>
                                                    @endif
                                                    @if($propertyRequirement->propertyRequirementDetail->parking_space !== null)
                                                        <span><i class="fas fa-car" aria-hidden="true"></i> {{$propertyRequirement->propertyRequirementDetail->parking_space}}</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if($propertyRequirement->amenities !== null)
                                                <div class="item-name result-items">
                                                    <span>
                                                        <i class="fas fa-fire" aria-hidden="true"></i>
                                                        <i class="far fa-check-circle @if(in_array(2, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"
                                                           aria-hidden="true"></i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                                        <i class="far fa-check-circle @if(in_array(3, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"
                                                           aria-hidden="true"></i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-tint" aria-hidden="true"></i>
                                                        <i class="far fa-check-circle @if(in_array(4, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"
                                                           aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="card-body card-body-description">

                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    {{$propertyRequirement->description}}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="card-body card-seller-det rounded">
                                            <div class="item-quantity">
                                                <div>
                                                    <h5>{{__('Buyer')}}: <span
                                                            class="mt-1">{{$propertyRequirement->customer->name}}</span><span>{{$propertyRequirement->customer->phone_no}}</span>
                                                    </h5>
                                                    <div class="">
                                                        <a href="{{route('property-requirements.close-deal', $propertyRequirement)}}"
                                                           class="btn btn-warning fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            {{__('Close The Deal')}}
                                                        </a>
                                                        @can('property-requirement-edit')
                                                            <a href="{{route('property-requirements.edit', $propertyRequirement)}}"
                                                               class="btn btn-primary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                                <i class="far fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                        @endcan
                                                        <a href="{{route('property-requirements.show', $propertyRequirement)}}"
                                                           class="btn btn-info fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            <i class="far fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{route('property-requirements.matches', $propertyRequirement)}}"
                                                           class="btn btn-secondary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </a>
                                                        @can('property-requirement-delete')
                                                            <button
                                                                wire:click.prevent="confirmPropertyRequirementRemoval({{ $propertyRequirement }})"
                                                                type="button"
                                                                class="btn btn-danger fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                                <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                                wire:click.prevent="confirmRequirementReason({{$propertyRequirement}})"
                                                                class="btn btn-dark fs-5 mt-1 waves-effect waves-float waves-light">
                                                            <i class="fa fa-exclamation" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-ptoperty d-flex align-items-center justify-content-center">
                                        <h3 class="text-center">
                                            <img src="{{asset('app-assets/images/ico/empty-page.png')}}"
                                                 alt="empty-page">
                                            <br>
                                            {{__('There are no properties to display')}} <br>

                                            @can('property-requirement-create')
                                            <a href="{{route('property-requirements.create')}}">{{__('Click here to Create Property Requirements')}}</a>
                                            @endcan
                                        </h3>
                                    </div>
                                @endforelse
                            </div>
                            @if ($perPage <= $totalRecords)
                                <x-loading-spinner/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.partials.reason-modal')
    @include('livewire.admin.partials.delete-modal')
</div>
@push('scripts')
    @include('livewire.admin.partials.scripts')
    <script src="https://kit.fontawesome.com/92840116b8.js" crossorigin="anonymous"></script>
    <script src="{{asset('app-assets/js/bs-stepper.min.js')}}"></script>
    <script src="{{asset('app-assets/js/app-ecommerce-checkout.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".grid-view-btn").click(function () {
                $(".auto-match-content").addClass("grid-view-box");
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".list-view-btn").click(function () {
                $(".auto-match-content").removeClass("grid-view-box");
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#filter-btn").click(function () {
                $(".filters-form").toggleClass("show-filters");
            });
        });
    </script>
    <script>
        $(window).ready(function () {
            if ($(window).width() <= 767) {
                $(".auto-match-content").addClass("grid-view-box");
            }
        });
    </script>
    <x-load-more/>
@endpush
