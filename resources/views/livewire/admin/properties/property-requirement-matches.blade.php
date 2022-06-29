@section('title', 'Requirement Matches')
<div class="ecommerce-application auto-match-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-sm-8 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{__('Property Matches')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('property-requirements')}}">
                                        {{__('Requirement')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('Requirement Matches')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @if($matches->count() >= 8)
                <div class="content-header-right col-md-4 col-sm-4 col-12 text-end mb-2">
                    <div wire:ignore class="form-modal-ex text-end position-relative">
                        <button type="button" id="filter-btn" class="btn btn-outline-primary btn-icon btn-round btn-sm">
                            <i data-feather="filter"></i>
                        </button>
                        @if(!empty($filterCounter))
                            <span class="badge rounded-pill bg-warning badge-up">{{$filterCounter}}</span>
                        @endif
                    </div>
                </div>
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
                                @forelse($matches as $match)
                                    <div
                                        class="card ecommerce-card result-card-body property-listing property-listing-req">
                                        <div class="item-options text-center home-area-detail det-mob-card">
                                            <div class="prop-det">
                                                <div class="item-wrapper">
                                                    <h2 class="text-body fw-bolder">{{$match->title}}</h2>
                                                </div>
                                                <div class="item-wrapper card-loc mb-1 mt-1">
                                                    <span><i class="fa fa-map-marker"></i></span>
                                                    <a href="#"
                                                       class="text-body">{{$match->propertyRequirementDetail->location}}</a>
                                                </div>
                                                <span class="det-price-btn" target="_self">
                                                    <h5 class="fw-bolder text-primary">{{__('Budget:')}} <span
                                                            class="fw-bold">{{$match->min_price}} - {{$match->max_price}}</span></h5>
                                                </span>
                                            </div>
                                            <div class="card-body result-items-card det-icons-2"
                                                 style="padding-bottom: 0 !important;">
                                                @if($match->category_id === 1 && $match->propertyRequirementDetail !== null)
                                                    <div class="item-name result-items">
                                                        @if($match->propertyRequirementDetail->max_rooms !== null)
                                                            <span><i class="fas fa-bed"></i> {{$match->propertyRequirementDetail->max_rooms}}</span>
                                                        @endif
                                                        @if($match->propertyRequirementDetail->max_bathrooms !== null)
                                                            <span><i class="fas fa-shower"></i> {{$match->propertyRequirementDetail->max_bathrooms}}</span>
                                                        @endif
                                                        @if($match->propertyRequirementDetail->parking_space !== null)
                                                            <span><i class="fas fa-car"></i> {{$match->propertyRequirementDetail->parking_space}}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($match->amenities !== null)
                                                    <div class="item-name result-items mt-1">
                                                <span><i class="fas fa-fire"></i>
                                                    <i class="far fa-check-circle @if(in_array(2, $match->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                        <span><i class="fas fa-bolt"></i>
                                                            <i class="far fa-check-circle @if(in_array(3, $match->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                        <span><i class="fas fa-tint"></i>
                                                            <i class="far fa-check-circle @if(in_array(4, $match->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                    </div>
                                                @endif
                                                <div class="item-quantity">
                                                    <p class="quantity-title mb-0 mt-2">
                                                        {{$match->description}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body result-items-card">
                                            @if($match->category_id === 1 && $match->propertyRequirementDetail !== null)
                                                <div class="item-name result-items">
                                                    @if($match->propertyRequirementDetail->max_rooms !== null)
                                                        <span><i class="fas fa-bed"></i> {{$match->propertyRequirementDetail->max_rooms}}</span>
                                                    @endif
                                                    @if($match->propertyRequirementDetail->max_bathrooms !== null)
                                                        <span><i class="fas fa-shower"></i> {{$match->propertyRequirementDetail->max_bathrooms}}</span>
                                                    @endif
                                                    @if($match->propertyRequirementDetail->parking_space !== null)
                                                        <span><i class="fas fa-car"></i> {{$match->propertyRequirementDetail->parking_space}}</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if($match->amenities !== null)
                                                <div class="item-name result-items">
                                               <span><i class="fas fa-fire"></i>
                                                    <i class="far fa-check-circle @if(in_array(2, $match->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                    <span><i class="fas fa-bolt"></i>
                                                            <i class="far fa-check-circle @if(in_array(3, $match->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                    <span><i class="fas fa-tint"></i>
                                                            <i class="far fa-check-circle @if(in_array(4, $match->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="card-body card-body-description">

                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    {{$match->description}}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="card-body card-seller-det rounded">
                                            <div class="item-quantity">
                                                <div>
                                                    <h5>{{__('Buyer:')}} <span
                                                            class="mt-1">{{$match->customer->name}}</span><span>{{$match->customer->phone_no}}</span>
                                                    </h5>
                                                    <div class="">
                                                        <a href="{{route('property-requirements.close-deal', $match)}}"
                                                           class="btn btn-warning fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            {{__('Close The Deal')}}
                                                        </a>
                                                        <a href="{{route('property-requirements.edit', $match)}}"
                                                           class="btn btn-primary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            <i class="far fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{route('property-requirements.matches', $match)}}"
                                                           class="btn btn-secondary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </a>
                                                        <button
                                                            wire:click.prevent="confirmPropertyRequirementRemoval({{ $match }})"
                                                            type="button"
                                                            class="btn btn-danger fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                            <i class="far fa-trash-alt" aria-hidden="true"></i>
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

                                            @can('property-create')
                                            
                                                <a href="{{route('property-requirements.create')}}">{{__('Click here to Create a Property Requirements Match')}}</a>
                                            @endcan
                                        </h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endpush
