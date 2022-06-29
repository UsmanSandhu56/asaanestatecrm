<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>Property</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    @include('backend.partials.styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/ext-component-swiper.css')}}">
    
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Content-->
<div
    class="app-content content ecommerce-application position-relative auto-match-page auto-match-open-page share-screen">
    <div class="content-overlay"></div>
    <!-- <div class="header-navbar-shadow"></div> -->
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12 col-sm-12 col-md-6">
                        <h2 class="content-header-title float-start mb-0 border-0"><i class="fa fa-star"></i>
                            {{$property->title}}
                        </h2>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <h2 class="content-header-title float-end mb-0 border-0 demand-head"><span
                                class="fw-bolder text-primary h1">{{__('Demand:')}}</span> {{$property->price}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body row">
            <div class="col-md-6 col-12">
                <!-- gallery swiper -->
                <section id="component-swiper-gallery">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="swiper-gallery swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    @forelse($property->getMedia('photos') as $media)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{$media->getUrl()}}"
                                                 alt="banner"/>
                                        </div>
                                    @empty
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{asset('media/property-placeholder.png')}}"
                                                 alt="banner"/>
                                        </div>
                                    @endforelse
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper mt-25">
                                    @forelse($property->getMedia('photos') as $media)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{$media->getUrl()}}"
                                                 alt="banner"/>
                                        </div>
                                    @empty
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{asset('media/property-placeholder.png')}}"
                                                 alt="banner"/>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ gallery swiper -->

                <div class="row am-icons">
                    @if($property->category_id === 1 && $property->propertyDetail !== null)
                        @if($property->propertyDetail->rooms !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-bed"></i> {{$property->propertyDetail->rooms}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($property->propertyDetail->bathrooms !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i
                                                class="fas fa-shower"></i> {{$property->propertyDetail->bathrooms}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($property->propertyDetail->parking_space !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i
                                                class="fas fa-car"></i>{{$property->propertyDetail->parking_space}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    @if($property->amenities !== null)
                        <div class="col-sm-4 col-12">
                            <div class="card-body">
                                <div class="item-name ">
                                    <span><i class="fas fa-fire"></i> <i
                                            class="far fa-check-circle @if(in_array(2, $property->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card-body">
                                <div class="item-name ">
                                    <span><i class="fas fa-bolt"></i> <i
                                            class="far fa-check-circle @if(in_array(3, $property->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card-body">
                                <div class="item-name ">
                                    <span><i class="fas fa-tint"></i> <i
                                            class="far fa-check-circle @if(in_array(4, $property->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <section class="prop-det-share">
                    <div class="row">
                        <div class="col-6 col-md-6 text-center">
                            <div class="match-amenities price-demand">
                                <h5 class="fw-bolder">{{__('Property Type')}}</h5>
                                <ul class="p-0 m-0" style="list-style:none;">
                                    <li class="fw-bolder text-primary fs-4 prop-title-h">{{$property->category->name}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 text-center">
                            <div class="match-amenities price-demand">
                                <h5 class="fw-bolder">
                                    {{__('Property Detail')}}
                                </h5>
                                <ul class="p-0 m-0" style="list-style:none;">
                                    <li class="fw-bolder text-primary fs-4 prop-title-h">{{$property->subCategory->name}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="match-description mt-2">
                    <h3>{{__('Description')}}</h3>
                    <div>
                        <p>
                            {{$property->type}}
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-12 content-right-det" id="sm-right-cont">

                <div class="match-amenities mt-2">
                    <div class="row">
                        <h4>{{__('Property Features')}}</h4>
                        <div class="col-md-6 col-6">
                            <div class="match-facing">
                                <ul>
                                    @foreach($property->amenities as $amenity)
                                        @if($loop->odd)
                                            <li>{{$amenity->type}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="match-facing">
                                <h4></h4>
                                <ul>
                                    @foreach($property->amenities as $amenity)
                                        @if($loop->even)
                                            <li>{{$amenity->type}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="match-amenities match-amenities-map mt-2">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13614.147684979305!2d74.27660715!3d31.454413199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1635513204759!5m2!1sen!2s"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="agent-call">
    <a href="tel:{{$property->customer->phone_no}}" class="fw-bolder">
        <i class="fa fa-phone"></i>
        <p class="mb-0 text-white">{{__('Intrested?')}}<span>{{__('Call Agent')}}</span></p>
    </a>
</div>

<!-- BEGIN: Footer-->
<footer class="footer-static footer-light container-xxl pt-1 pb-1">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">{{__('COPYRIGHT')}} &copy; 2021<a
                class="ms-25" href="#" target="_blank">{{__('Asaan Estate CRM')}}</a><span
                class="d-none d-sm-inline-block">, {{__('All rights Reserved')}}</span></span>
    </p>
</footer>

@include('backend.partials.scripts')
<script src="{{asset('app-assets/js/swiper.min.js')}}"></script>
<script src="{{asset('app-assets/js/ext-component-swiper.js')}}"></script>

</body>
<!-- END: Body-->
</html>
