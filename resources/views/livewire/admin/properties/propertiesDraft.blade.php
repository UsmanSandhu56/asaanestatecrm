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
@section('title', 'Property Drafts')
<div class="ecommerce-application auto-match-page properties-drafts prop-drafts-mob-set">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-sm-7 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{__('Property Drafts')}}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""></a>
                                </li>
                                <li class="breadcrumb-item active">{{__('Properties')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-end col-md-4 col-sm-5 col-12 d-md-block">
                <div class="breadcrumb-right">
                    <div class="dropdown">
                        
                        
                    </div>
                </div>
            </div>
           
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
                              @foreach($properties as $property)
                                    <div class="card ecommerce-card result-card-body property-listing property-listing-prop align-items-center">
                                 

                                        <div class="item-options text-center home-area-detail det-mob-card w-100">
                                            <div class="prop-det card-seller-det-mob">
                                                <div class="item-wrapper">
                                                    <h2 class="text-body fw-bolder">{{ $property->title }}</h2>
                                                </div>
                                                <div class="item-wrapper card-loc mb-1 mt-1">
                                                    <span><i class="fa fa-map-marker"></i></span>
                                                    <a href="#" class="text-body">@if($property->address){{$property->address->location}}@else Not defined @endif</a>
                                                </div>
                                                <div class="mob-hide-det">
                                                    <div class="item-quantity">
                                                        <div>
                                                            <h5><span></span></h5>
                                                        </div>
                                                        <div>
                                                            <h5><span></span></h5>
                                                        </div>
                                                        <div>
                                                            <h5><span></span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="btn btn-primary det-price-btn" target="_self">
                                                <span>{{__('Demand: PKR')}} {{ $property->price }} </span>
                                            </span>

                                            <!-- <div class="price-mob-hid">
                                                <div class="mob-price-btn">
                                                    <p>{{__('Demand: PKR')}}</p>
                                                    <div class="d-flex align-items-center">
                                                        <a href=""
                                                           class="btn btn-warning fw-bolder fs-4 mt-1 waves-effect waves-float waves-light">
                                                            {{__('Close The Deal')}}
                                                        </a>
                                                        <button
                                                            class="btn btn-primary fw-bolder fs-4 mt-1 ms-50 waves-effect waves-float waves-light">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button"
                                                                wire:click.prevent="confirmPropertyRemoval()"
                                                                class="btn btn-danger fw-bolder fs-4 mt-1 ms-50 waves-effect waves-float waves-light">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="card-body result-items-card">
                                            @if($property->category_id === 1 && $property->propertyDetailDraft !== null)
                                            
                                                <div class="item-name result-items">
                                                    @if($property->propertyDetailDraft->rooms !== null) 
                                                        <span><i class="fas fa-bed" aria-hidden="true"></i> {{ $property->propertyDetailDraft->rooms }}</span>
                                                    @endif
                                                    @if($property->propertyDetailDraft->bathrooms !== null)
                                                        <span><i class="fas fa-shower" aria-hidden="true"></i>{{ $property->propertyDetailDraft->bathrooms }} </span>
                                                    @endif
                                                    @if($property->propertyDetailDraft->parking_space !== null)
                                                        <span><i class="fas fa-car" aria-hidden="true"></i>{{ $property->propertyDetailDraft->parking_space }} </span>
                                                    @endif
                                                </div>
                                            @endif
                                           
                                        
                                        </div>

                                        <div class="card-body card-seller-det">
                                            <div class="item-quantity">
                                               
                                                    <span class="mt-1"></span>
                                                    <span></span>
                                                    <span class="mb-1"></span>
                                                </h5>
                                                <div class="">
                                          
                                                    <a href="{{ route('property-draft-edit',$property->id )}}"
                                                       class="btn btn-primary fw-bolder fs-5 mt-1 waves-effect waves-float waves-light">
                                                        <i class="far fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                   
                                                                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                              
                               
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
