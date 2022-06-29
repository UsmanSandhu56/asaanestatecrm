@section('title', 'Close The Deal')
<div class="ecommerce-application auto-match-page close-d-deal auto-match-open-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-sm-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-2 border-0">{{__('Close The Deal')}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body row">
            <div class="col-md-6 col-6 close-border">
                <h2 class="content-header-title mb-2 border-0"><i class="fa fa-star"></i> {{__('Property Details')}}
                </h2>
                <div class="match-amenities match-amenities-left">
                    <div class="row">
                        <h4 class="text-primary fw-bolder prop-title-h">{{$property->title}}</h4>
                        <div class="col-md-12 col-12">
                            <div class="match-utilities">
                                <p>{{$property->area}} | {{$property->subCategory->name}}
                                    | {{$property->address->location}}</p>
                                <h5>{{__('Demand')}}</h5>
                                <ul class="p-0" style="list-style:none;">
                                    <li class="fw-bolder text-primary fs-4 prop-title-h">{{$property->price}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6 content-right-det">
                <h2 class="content-header-title mb-1 border-0 cl-deal-head position-relative"><i class="fa fa-star"></i>
                    {{__('Property Requirements')}} <a href="{{route('property-requirements.create')}}"
                        class="btn btn-primary" target="_blank">+</a>
                </h2>
                <div class=" match-amenities" x-data="{ isOpen: true }" @click.away="isOpen = false">
                    <div class="position-relative">
                        <div class="input-group input-group-merge mb-1 shadow">
                            <input wire:model.debounce.500ms="requirementSearch" x-ref="requirementSearch"
                                @keydown.window="if (event.keyCode === 191) {event.preventDefault(); $refs.requirementSearch.focus();}"
                                @focus="isOpen = true" @keydown="isOpen = true" @keydown.escape.window="isOpen = false"
                                @keydown.shift.tab="isOpen = false" type="number" id="phone_no"
                                class="form-control search-product" placeholder="{{__('Customer Phone')}}" />
                            <span class="input-group-text" wire:ignore>
                                <i data-feather="search" class="text-muted"></i>
                            </span>
                        </div>
                        @if (strlen($requirementSearch) >= 5)
                        <div class="rounded w-100 mt-50 position-absolute serch-field-result"
                            x-show.transition.opacity="isOpen">
                            @if ($searchResults->count() > 0)
                            <ul class="list-group">
                                @foreach ($searchResults->take(5) as $result)
                                <li class="list-group-item p-1 ">
                                    <div class="">
                                        @foreach($result->propertyRequirements as $requirement)
                                        <div class="d-block w-100 @if(!$loop->last) serch-field-list @endif">
                                            <a wire:click.prevent="setPropertyRequirement({{ $requirement }})" @click="isOpen = false"
                                                class="block border-0 bg-transparent fw-bolder w-100" @if ($loop->last)
                                                @keydown.tab="isOpen = false" @endif>
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-0">{{$requirement->title }}</p>
                                                    <p class="ms-1 mb-0 badge bg-primary">
                                                        {{($requirement->purpose === 0) ? 'Buy' : 'Rent'  }}</p>
                                                </div>
                                                <div class="fw-bold fs-6 d-flex serch-field-det">
                                                    <p class="mb-0 me-2" @click="isOpen = false">{{ $result->name }}</p>
                                                    <p class="mb-0 me-2">
                                                        {{ $requirement->min_price .' - '. $requirement->max_price}}
                                                        PKR</p>
                                                </div>

                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            @endif
                        </div>
                        @endif
                    </div>
                    @isset($propertyRequirement)
                    <div class="row">
                        <h4 class="text-primary fw-bolder prop-title-h">{{$propertyRequirement->title}}</h4>
                        <div class="col-md-6 col-12">
                            <div class="match-utilities">
                                <h4>{{__('Plot:')}} <span
                                        class="fs-5">{{$propertyRequirement->subCategory->name}}</span>
                                </h4>
                                <h4>{{__('Location:')}} <span
                                        class="fs-5">{{$propertyRequirement->propertyRequirementDetail->location}}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="match-facing">
                                <h4>{{__('Budget:')}} <span class="fs-5">{{$propertyRequirement->min_price}} -
                                        {{$propertyRequirement->max_price}}</span>
                                </h4>
                                <h4>{{__('Area:')}} <span class="fs-5">{{$propertyRequirement->min_area}} -
                                        {{$propertyRequirement->max_area}}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="card-body cntct-card-det pe-5">
                    <h3 class="mb-75">{{__('Seller')}}</h3>

                    <div class="mt-1 prof-img-set">
                        <!-- <div class="prof-img">
                            <img src="{{asset('app-assets/images/avatars/12-small.png')}}">
                        </div> -->
                        <div class="prof-img-det">
                            <p class="card-text cntct-card-name">{{$property->customer->name}}</p>
                            <a href="#" class="card-text"><i class="fa fa-envelope"></i> {{$property->customer->email}}
                            </a><br>
                            <a href="#" class="card-text"><i class="fa fa-map-marker"></i>
                                {{$property->address->location}}</a>
                            <br>
                            <a href="#" class="card-text"><i class="fa fa-phone"></i> {{$property->customer->phone_no}}
                            </a>
                        </div>
                    </div>
                    <div class="am-cntct-phn">
                        <a href="tel:{{$property->customer->phone_no}}"><i class="fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            @isset($propertyRequirement)
            <div class="col-md-6 col-6 content-right-det">
                <div class="card-body cntct-card-det pe-5 cntct-card-buyer">
                    <h3 class="mb-75">{{__('Buyer')}}</h3>
                    <div class="mt-1 prof-img-set">
                        <!-- <div class="prof-img">
                                <img src="{{asset('app-assets/images/avatars/12-small.png')}}">
                            </div> -->
                        <div class="prof-img-det">
                            <p class="card-text cntct-card-name">{{$propertyRequirement->customer->name}}</p>
                            <a href="#" class="card-text"><i class="fa fa-envelope"></i>
                                {{$propertyRequirement->customer->email}}</a><br>
                            <a href="#" class="card-text"><i class="fa fa-map-marker"></i>
                                {{$propertyRequirement->propertyRequirementDetail->location}}
                            </a>
                            <br>
                            <a href="#" class="card-text"><i class="fa fa-phone"></i>
                                {{$propertyRequirement->customer->phone_no}}
                            </a>
                        </div>
                    </div>
                    <div class="am-cntct-phn">
                        <a href="tel:{{$propertyRequirement->customer->phone_no}}"><i class="fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            @endisset
        </div>
        <div class="row">
            <div class="col-12 mt-3 mb-3">
                <h2 class="content-header-title mb-2 border-0"><i class="fa fa-star"></i>
                    {{__('Deal Details (Rent/Sale)')}}</h2>
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <form wire:submit.prevent="store" class="form form-vertical">
                                @error('propertyRequirement')
                                <div style="color: #dc3545;">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="row">
                                    <input type="hidden" wire:model.defer="propertyRequirement">
                                    <input type="hidden" wire:model.defer="property">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="amount">{{__('Amount')}}</label>
                                            <input wire:model="amount" type="number" id="amount"
                                                class="form-control @error('amount') is-invalid @enderror" name="amount"
                                                placeholder="{{__('Deal Amount')}}" />
                                            @error('amount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <label class="form-label text-primary" for="price-words">
                                                @if(!empty($amount))
                                                <?php
                                                    $f = new NumberFormatter("en-IN", NumberFormatter::SPELLOUT);
                                                    echo $f->format($amount)
                                                    ?>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="agency_commission">{{__('Agency Commission')}}</label>
                                            <input type="number" wire:model="agency_commission" id="agency_commission"
                                                class="form-control @error('agency_commission') is-invalid @enderror"
                                                name="agency_commission" placeholder="Agency Commission" />
                                            @error('agency_commission')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <label class="form-label text-primary" for="price-words">
                                                @if(!empty($agency_commission))
                                                <?php
                                                    $f = new NumberFormatter("en-IN", NumberFormatter::SPELLOUT);
                                                    echo $f->format($agency_commission)
                                                    ?>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="agent_commission">{{__('Agent Commission')}}</label>
                                            <input type="number" wire:model="agent_commission" id="agent_commission"
                                                step="any"
                                                class="form-control @error('agent_commission') is-invalid @enderror"
                                                name="agent_commission" placeholder="0" />
                                            @error('agent_commission')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <label class="form-label text-primary" for="price-words">
                                                @if(!empty($agent_commission))
                                                <?php
                                                    $f = new NumberFormatter("en-IN", NumberFormatter::SPELLOUT);
                                                    echo $f->format($agent_commission)
                                                    ?>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 mx-auto text-center">
                                        <button type="submit"
                                            class="btn btn-warning fw-bolder fs-2 w-100">{{__('Deal Close')}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
