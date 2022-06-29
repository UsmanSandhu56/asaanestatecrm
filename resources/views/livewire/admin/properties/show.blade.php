@section('title', 'Property')
<div class="ecommerce-application auto-match-page auto-match-open-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-sm-9 col-10 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0 border-0">
                            <i class="fa fa-star"></i> {{ $property->title }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-4 col-sm-3 col-2 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                aria-haspopup="true" aria-expanded="false" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter"><i class="fa fa-share-alt"></i></button>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header p-0">
                                    <!-- Vertical modal -->
                                    <div class="vertical-modal-ex">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1"
                                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="exampleModalCenterTitle">
                                                            {{ __('Share Link') }}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form form-vertical">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="text-start social-share-btns">
                                                                        <a href="javascript:void(0)"
                                                                           class="social-share-fb share__link--facebook">
                                                                            <i
                                                                                class="fa fa-facebook share__link--facebook"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)"
                                                                           class="social-share-wa share__link--whatsapp">
                                                                            <i
                                                                                class="fa fa-whatsapp share__link--whatsapp"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)"
                                                                           class="social-share-tw share__link--twitter">
                                                                            <i
                                                                                class="fa fa-twitter share__link--twitter"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)"
                                                                           class="social-share-li share__link--linkedin">
                                                                            <i
                                                                                class="fa fa-linkedin share__link--linkedin"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)"
                                                                           class="social-share-en share__link--mail">
                                                                            <i
                                                                                class="far fa-envelope share__link--mail"></i>
                                                                        </a>
                                                                        <!-- <a href="#" class="social-share-cp"><i class="fa fa-copy"></i></a> -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div
                                                                        class="input-group input-group-merge mt-1 shadow">
                                                                        <input id="clip-text" type="text"
                                                                               class="form-control search-product"
                                                                               value="{{ Request::fullUrl() }}"/>
                                                                        <span
                                                                            class="input-group-text tooltip-btn cursor-pointer"
                                                                            data-clipboard-demo=""
                                                                            data-clipboard-target="#clip-text"> <i
                                                                                data-feather="copy"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-danger waves-effect"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close">{{ __('Close') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Vertical modal end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body row">
            <div class="col-md-6 col-12">
                <!-- gallery swiper -->
                <section id="component-swiper-gallery">
                    <div class="card shadow-none">
                        <div class="main-selection-am main-selection-am-top">
                            <p>{{ $property->category->name }}</p>
                            <p>{{ $property->purpose === 1 ? 'Rent' : 'Buy' }}</p>
                            <p>{{ $property->address->city }}</p>
                            <p>{{ $property->area }}</p>
                            <p>PKR {{ $property->price }}</p>
                        </div>
                        <div class="card-body">
                            <div class="swiper-gallery swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    @forelse($property->getMedia('photos') as $media)
                                        <div class="swiper-slide">
                                            <img class="img-fluid" src="{{ $media->getUrl() }}" alt="banner"/>
                                        </div>
                                    @empty
                                        <div class="swiper-slide">
                                            <img class="img-fluid"
                                                 src="{{ asset('media/property-placeholder.png') }}" alt="banner"/>
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
                                            <img class="img-fluid" src="{{ $media->getUrl() }}" alt="banner"/>
                                        </div>
                                    @empty
                                        <div class="swiper-slide">
                                            <img class="img-fluid"
                                                 src="{{ asset('media/property-placeholder.png') }}" alt="banner"/>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ gallery swiper -->
                <div class="row am-icons">
                    @if ($property->category_id === 1 && $property->propertyDetail !== null)
                        @if ($property->propertyDetail->rooms !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-bed"></i>
                                            {{ $property->propertyDetail->rooms }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($property->propertyDetail->bathrooms !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-shower"></i>
                                            {{ $property->propertyDetail->bathrooms }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($property->propertyDetail->parking_space !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-car"></i>
                                            {{ $property->propertyDetail->parking_space }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    @if ($property->amenities !== null)
                        <div class="col-sm-4 col-12">
                            <div class="card-body">
                                <div class="item-name ">
                                    <span><i class="fas fa-fire"></i> <i
                                            class="far fa-check-circle @if (in_array(2, $property->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card-body">
                                <div class="item-name ">
                                    <span><i class="fas fa-bolt"></i> <i
                                            class="far fa-check-circle @if (in_array(3, $property->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card-body">
                                <div class="item-name ">
                                    <span><i class="fas fa-tint"></i> <i
                                            class="far fa-check-circle @if (in_array(4, $property->amenities->pluck('id')->toArray(), true)) active @endif"></i></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="match-description match-description-des mt-2">
                    <h3>{{ __('Description') }}</h3>
                    <div>
                        <p>
                            {{ $property->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 sm-screen-btns">
                <div class="text-center">
                    <a href="#" class="sm-phone"><i class="fa fa-phone"></i></a>
                    <a href="#" class="sm-ellipse" id="ellipse-btn-jq"><i class="fas fa-ellipsis-h"></i></a>
                    <a href="#" class="sm-flag"><i class="far fa-flag"></i></a>
                </div>
            </div>
            <div class="contact-btn">
                <div class="text-center">
                    <button class="btn btn-info back-btn"><i class="fa fa-arrow-left"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-12 content-right-det" id="sm-right-cont">
                <div class="match-amenities">
                    <div class="main-selection-am">
                        <p>{{ $property->category->name }}</p>
                        <p>{{ $property->purpose === 1 ? 'Rent' : 'Sell' }}</p>
                        <p>{{ $property->address->city }}</p>
                        <p>{{ $property->area }}</p>
                        <p>PKR {{ $property->price }}</p>
                    </div>
                    <div class="row">
                        <h4>{{ __('Property Features') }}</h4>
                        <div class="col-6">
                            <div class="match-facing">
                                <ul>
                                    @foreach ($property->amenities as $amenity)
                                        @if ($loop->odd)
                                            <li>{{ $amenity->type }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="match-facing">
                                <ul>
                                    @foreach ($property->amenities as $amenity)
                                        @if ($loop->even)
                                            <li>{{ $amenity->type }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="match-description match-description-mob mt-2">
                    <h3>{{ __('Description') }}</h3>
                    <div>
                        <p>
                            {{ $property->description }}
                        </p>
                    </div>
                </div>
                <div class="card-body cntct-card-det">
                    <h3 class="mb-75">{{ __('Contact') }}</h3>
                    <div class="mt-1 prof-img-set">
                        <!-- <div class="prof-img">
                            <img src="../app-assets/images/avatars/12-small.png">
                        </div> -->
                        <div class="prof-img-det">
                            <p class="card-text cntct-card-name">{{ $property->customer->name }}</p>
                            <a href="#" class="card-text"><i class="fa fa-envelope"></i>
                                {{ $property->customer->email }}
                            </a><br>
                            <a href="#" class="card-text"><i class="fa fa-map-marker"></i>
                                {{ $property->address->location }}</a>
                        </div>
                    </div>
                    <div class="am-cntct-phn">
                        <a href="tel:{{ $property->customer->phone_no }}"><i class="fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('app-assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/ext-component-swiper.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#ellipse-btn-jq").click(function () {
                $("#sm-right-cont").toggleClass("diplay-sm-desc");
            });
        });
    </script>
    @include('livewire.admin.partials.social-share')
@endpush
