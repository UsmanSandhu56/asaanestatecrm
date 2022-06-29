@section('title', 'Property Requirement')
<div
    class="ecommerce-application position-relative auto-match-page auto-match-open-page prop-req-det">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12 col-sm-12 col-md-6">
                        <h2 class="content-header-title float-start mb-0 border-0"><i class="fa fa-star"></i>
                            {{$propertyRequirement->title}}
                        </h2>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <h3 class="content-header-title float-end mb-0 border-0 demand-head"><span
                                class="fw-bolder text-primary h3">{{__('Budget:')}}</span> {{$propertyRequirement->min_price}}
                            - {{$propertyRequirement->max_price}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body row">
            <div class="col-md-6 col-12">

                <section class="prop-det-share">
                    <div class="row">
                        <div class="col-6 col-md-6 text-center">
                            <div class="match-amenities price-demand">
                                <h5 class="fw-bolder">{{__('Property Type')}}</h5>
                                <ul class="p-0 m-0" style="list-style:none;">
                                    <li class="fw-bolder text-primary fs-4 prop-title-h">{{$propertyRequirement->category->name}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 text-center">
                            <div class="match-amenities price-demand">
                                <h5 class="fw-bolder">
                                    {{__('Property Detail')}}
                                </h5>
                                <ul class="p-0 m-0" style="list-style:none;">
                                    <li class="fw-bolder text-primary fs-4 prop-title-h">{{$propertyRequirement->subCategory->name}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="match-description mt-2">
                    <h3>{{__('Description')}}</h3>
                    <div>
                        <p>
                            {{$propertyRequirement->description}}
                        </p>
                    </div>
                </div>

                <div class="row am-icons my-2">
                    @if($propertyRequirement->category_id === 1 && $propertyRequirement->propertyRequirementDetail !== null)
                        @if($propertyRequirement->propertyRequirementDetail->max_rooms !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-bed" aria-hidden="true"></i> {{$propertyRequirement->propertyRequirementDetail->max_rooms}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($propertyRequirement->propertyRequirementDetail->max_bathrooms !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-shower" aria-hidden="true"></i> {{$propertyRequirement->propertyRequirementDetail->max_bathrooms}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($propertyRequirement->propertyRequirementDetail->parking_space !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name">
                                        <span><i class="fas fa-car" aria-hidden="true"></i> {{$propertyRequirement->propertyRequirementDetail->parking_space}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($propertyRequirement->amenities !== null)
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name ">
                                <span><i class="fas fa-fire" aria-hidden="true"></i> <i
                                        class="far fa-check-circle @if(in_array(2, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"
                                        aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name ">
                                <span>
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    <i class="far fa-check-circle @if(in_array(3, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"
                                       aria-hidden="true"></i>
                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="card-body">
                                    <div class="item-name ">
                                <span>
                                    <i class="fas fa-tint" aria-hidden="true"></i>
                                    <i class="far fa-check-circle @if(in_array(4, $propertyRequirement->amenities->pluck('id')->toArray(), true)) active @endif"
                                       aria-hidden="true"></i>
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="match-amenities mt-2">
                    <div class="row">
                        <h4>{{__('Property Features')}}</h4>
                        <div class="col-md-6 col-6">
                            <div class="match-facing">
                                @foreach($propertyRequirement->amenities as $amenity)
                                    @if($loop->odd)
                                        <li>{{$amenity->type}}</li>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="match-facing">
                                <h4></h4>
                                @foreach($propertyRequirement->amenities as $amenity)
                                    @if($loop->even)
                                        <li>{{$amenity->type}}</li>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="contact-btn">
                <div class="text-center">
                    <button class="btn btn-info back-btn"><i class="fa fa-arrow-left"></i></button>
                </div>
            </div>
            <div class="col-md-6 col-12 content-right-det" id="sm-right-cont">

                <div class="match-amenities match-amenities-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13614.147684979305!2d74.27660715!3d31.454413199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1635513204759!5m2!1sen!2s"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="card-body cntct-card-det pe-5 cntct-card-buyer">
                    <h3 class="mb-75">{{__('Tenant')}}</h3>
                    <div class="mt-1 prof-img-set">
                        <!-- <div class="prof-img">
                            <img src="http://127.0.0.1:8000/app-assets/images/avatars/12-small.png">
                        </div> -->
                        <div class="prof-img-det">
                            <p class="card-text cntct-card-name">{{$propertyRequirement->customer->name}}</p>
                            <a href="#" class="card-text"><i class="fa fa-envelope" aria-hidden="true"></i>
                                {{$propertyRequirement->customer->email}}</a><br>
                            <a href="#" class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{$propertyRequirement->propertyRequirementDetail->location}}
                            </a>
                        </div>
                    </div>
                    <div class="am-cntct-phn">
                        <a href="tel:{{$propertyRequirement->customer->phone_no}}"><i class="fa fa-phone"
                                                                                      aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
