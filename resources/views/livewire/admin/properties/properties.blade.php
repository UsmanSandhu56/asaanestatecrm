@push('styles')
    <style>
        .carousel-item {
            height: 250px;
            align-items: center;
            display: flex !important;
            justify-content: center;
        }
    </style>
@endpush
@section('title', 'Properties')
<div class="ecommerce-application auto-match-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-sm-7 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{__('Properties')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('Properties')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-end col-md-4 col-sm-5 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        @can('property-create')
                            <a href="{{route('properties.create')}}" class="btn btn-outline-primary">
                                {{__('Create Property')}}
                            </a>
                        @endcan
                        @if($properties->count() >= 8)
                            <div class="form-modal-ex text-end position-relative">
                                <button type="button" id="filter-btn" wire:ignore
                                        class="btn btn-outline-primary btn-icon btn-round btn-sm">
                                    <i data-feather="filter"></i>
                                </button>
                                @if(!empty($filterCounter))
                                    <span class="badge rounded-pill bg-warning badge-up">{{$filterCounter}}</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if($properties->count() >= 8)
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
                                @forelse($properties as $property)
                                    <div @if ($loop->last) id="last_record" @endif
                                        class="card ecommerce-card result-card-body property-listing property-listing-prop align-items-center">
                                        <div class="item-img-box position-relative ps-1 pe-1">
                                            <div id="carouselExampleFade2{{$loop->index}}"
                                                 class="carousel slide carousel-fade"
                                                 data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="caro-overlay"></div>
                                                    @forelse($property->getMedia('photos') as $media)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            <img src="{{$media->getUrl()}}"
                                                                 class="img-fluid d-block w-100 h-100" alt="cf-img-1"/>
                                                        </div>
                                                    @empty
                                                        <div class="carousel-item active">
                                                            <img src="{{asset('media/property-placeholder.png')}}"
                                                                 class="img-fluid d-block w-100 h-100" alt="cf-img-1"/>
                                                        </div>
                                                    @endforelse
                                                </div>
                                                <a class="carousel-control-prev"
                                                   href="#carouselExampleFade2{{$loop->index}}"
                                                   role="button"
                                                   data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">{{__('Previous')}}</span>
                                                </a>
                                                <a class="carousel-control-next"
                                                   href="#carouselExampleFade2{{$loop->index}}"
                                                   role="button"
                                                   data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">{{__('Next')}}</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="item-options text-center home-area-detail det-mob-card w-100">
                                            <div class="prop-det card-seller-det-mob">
                                                <div class="item-wrapper">
                                                    <h2 class="text-body fw-bolder">{{$property->title}}</h2>
                                                </div>
                                                <div class="item-wrapper card-loc mb-1 mt-1">
                                                    <span><i class="fa fa-map-marker"></i></span>
                                                    <a href="#" class="text-body">{{$property->address->location}}</a>
                                                </div>
                                                <div class="mob-hide-det">
                                                    <div class="item-quantity">
                                                        <div>
                                                            <h5><span>{{$property->customer->name}}</span></h5>
                                                        </div>
                                                        <div>
                                                            <h5><span>{{$property->customer->phone_no}}</span></h5>
                                                        </div>
                                                        <div>
                                                            <h5><span>{{$property->customer->email}}</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="btn btn-primary det-price-btn" target="_self">
                                                <span>{{__('Demand: PKR')}} {{$property->price}}</span>
                                            </span>

                                            <div class="price-mob-hid">
                                                <div class="mob-price-btn">
                                                    <p>{{__('Demand: PKR')}} {{$property->price}}</p>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{route('properties.close-deal',$property->id)}}"
                                                           class="btn btn-warning fw-bolder fs-4 mt-1 waves-effect waves-float waves-light">
                                                            {{__('Close The Deal')}}
                                                        </a>
                                                        <button
                                                            class="btn btn-primary fw-bolder fs-4 mt-1 ms-50 waves-effect waves-float waves-light">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button"
                                                                wire:click.prevent="confirmPropertyRemoval({{ $property }})"
                                                                class="btn btn-danger fw-bolder fs-4 mt-1 ms-50 waves-effect waves-float waves-light">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body result-items-card">
                                            @if($property->category_id === 1 && $property->propertyDetail !== null)
                                                <div class="item-name result-items">
                                                    @if($property->propertyDetail->rooms !== null)
                                                        <span><i class="fas fa-bed" aria-hidden="true"></i> {{$property->propertyDetail->rooms}}</span>
                                                    @endif
                                                    @if($property->propertyDetail->bathrooms !== null)
                                                        <span><i class="fas fa-shower" aria-hidden="true"></i> {{$property->propertyDetail->bathrooms}}</span>
                                                    @endif
                                                    @if($property->propertyDetail->parking_space !== null)
                                                        <span><i class="fas fa-car" aria-hidden="true"></i> {{$property->propertyDetail->parking_space}}</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if($property->amenities !== null)
                                                <div class="item-name result-items">
                                                    <span>
                                                        <i class="fas fa-fire" aria-hidden="true"></i>
                                                        <i class="far fa-check-circle @if(in_array(2, $property->amenities->pluck('id')->toArray(), true)) active @endif"
                                                           aria-hidden="true"></i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                                        <i class="far fa-check-circle @if(in_array(3, $property->amenities->pluck('id')->toArray(), true)) active @endif"
                                                           aria-hidden="true"></i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-tint" aria-hidden="true"></i>
                                                        <i class="far fa-check-circle @if(in_array(4, $property->amenities->pluck('id')->toArray(), true)) active @endif"
                                                           aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="card-body card-seller-det">
                                            <div class="item-quantity">
                                                <h5>{{__('Seller')}}:
                                                    <span class="mt-1">{{$property->customer->name}}</span>
                                                    <span>{{$property->customer->phone_no}}</span>
                                                    <span class="mb-1">{{$property->customer->email}}</span>
                                                </h5>
                                                <div class="">
                                                    <a href="{{route('properties.close-deal',$property->id)}}"
                                                       class="btn btn-warning fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                        {{__('Close The Deal')}}
                                                    </a>
                                                    <a href="{{route('properties.edit', $property)}}"
                                                       class="btn btn-primary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                        <i class="far fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{route('properties.show', $property)}}"
                                                       class="btn btn-info fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                        <i class="far fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{route('properties.matches', $property)}}"
                                                       class="btn btn-secondary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </a>
                                                    <button wire:click.prevent="confirmPropertyRemoval({{ $property }})"
                                                            type="button"
                                                            class="btn btn-danger fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                        <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                    </button>
                                                    {{--                                                    <button type="button"--}}
                                                    {{--                                                            class="btn btn-dark fs-5 mt-1 waves-effect waves-float waves-light"--}}
                                                    {{--                                                            aria-haspopup="true"--}}
                                                    {{--                                                            aria-expanded="false"--}}
                                                    {{--                                                            data-bs-toggle="modal"--}}
                                                    {{--                                                            data-bs-target="#exampleModalCenterreason">--}}
                                                    {{--                                                        <i class="fa fa-exclamation" aria-hidden="true"></i>--}}
                                                    {{--                                                    </button>--}}
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
                                                <a href="{{route('properties.create')}}">{{__('Click here to Create Property')}}</a>
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
    {{--    @include('livewire.admin.partials.reason-modal')--}}
    @include('livewire.admin.partials.delete-modal')
</div>
@push('scripts')
    @include('livewire.admin.partials.scripts')
    <script src="{{asset('app-assets/js/bs-stepper.min.js')}}"></script>
    <script src="{{asset('app-assets/js/app-ecommerce-checkout.js')}}"></script>

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
