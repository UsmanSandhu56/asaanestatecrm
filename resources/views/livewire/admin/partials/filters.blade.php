<div class="col-12">
    <form wire:submit.prevent="filter" class="form form-vertical">
        <div class="row align-items-end">
            <div class="col-6 col-md-3">
                <div class="mb-1">
                    <label class="form-label" for="purpose">{{__('Purpose')}}</label>
                    <select wire:model.defer="purpose" class="form-select" id="purpose">
                        <option value="0">{{__('Sale')}}</option>
                        <option value="1">{{__('Rent')}}</option>
                    </select>
                </div>
            </div>
            <div class="mb-1 col-6 col-md-3">
                <label class="form-label" for="city">{{__('City')}}</label>
                <input wire:model="city"
                       type="text" id="city"
                       class="form-control"
                       placeholder="Enter a city"/>
            </div>

            <div class="col-6 col-md-3">
                <div class="mb-1">
                    <label class="form-label" for="property-type">{{__('Property Type')}}</label>
                    <select wire:model.defer="category_id" wire:model="category"
                            class="form-select"
                            id="property-type">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="mb-1">
                    <label class="form-label" for="property-details">{{__('Property Details')}}</label>
                    <select class="form-select" id="property-details">
                        @foreach ($subCategories as $subCategory)
                            <option
                                value="{{ $subCategory->id }}"> {{ $subCategory->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-1 col-6 col-md-3">
                <label class="form-label" for="autocomplete">{{__('Location')}}</label>
                <input wire:model="location"
                       name="autocomplete"
                       type="text" id="autocomplete"
                       onchange="this.dispatchEvent(new InputEvent('input'))"
                       class="form-control"
                       placeholder="Enter Location"/>
            </div>

            <div class="col-6 col-md-0">
            </div>

            <div class="col-12 col-md-3">
                <div class="row">
                    <label class="form-label" for="min_price">{{__('All Inclusive Price:(PKR)')}}</label>
                    <div class="col-6 col-md-6">
                        <div class="t-dropdown-block">
                            <div class="t-dropdown-select">
                                <input wire:model="min_price" type="number"
                                       class="t-dropdown-input"
                                       placeholder="Min Price"/>
                                <span class="t-select-btn"></span>
                            </div>
                            <ul class="t-dropdown-list">
                                @foreach ($minPrices as $minPrice)
                                    <li wire:click="$set('min_price',{{$minPrice}})"
                                        class="t-dropdown-item"> {{$minPrice}}</li>
                                @endforeach
                            </ul>
                            @if ($errors->has('min_price'))
                                <div style="color: #dc3545;">{{ $errors->first('min_price') }}</div>
                            @endif
                            <label class="form-label text-primary" for="price-words">
                                @if(!empty($min_price))
                                    <?php
                                    $f = new NumberFormatter("en-IN", NumberFormatter::SPELLOUT);
                                    echo $f->format($min_price)
                                    ?>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="t-dropdown-block">
                            <div class="t-dropdown-select">
                                <input wire:model="max_price" type="number" class="t-dropdown-input"
                                       placeholder="Max Price"/>
                                <span class="t-select-btn"></span>
                            </div>
                            <ul class="t-dropdown-list">
                                @foreach ($maxPrices as $maxPrice)
                                    <li wire:click="$set('max_price',{{$maxPrice}})"
                                        class="t-dropdown-item"> {{$maxPrice}}</li>
                                @endforeach
                            </ul>
                            @if ($errors->has('max_price'))
                                <div style="color: #dc3545;">{{ $errors->first('max_price') }}</div>
                            @endif
                            <label class="form-label text-primary" for="price-words">
                                @if(!empty($max_price))
                                    <?php
                                    $f = new NumberFormatter("en-IN", NumberFormatter::SPELLOUT);
                                    echo $f->format($max_price)
                                    ?>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="row">
                    <label class="form-label d-flex align-items-center justify-content-between"
                           for="area">{{__('Land Area')}}
                        ({{$areaUnit}})
                        <span>
                                            <select wire:model.defer.defer="unit_id" wire:model="areaUnit"
                                                    class="form-select bg-transparent shadow-none btn-outline-primary rounded px-50 py-0 text-dark @error('unit_id') is-invalid @enderror"
                                                    id="unit_id">
                                                @foreach ($units as $uint)
                                                    <option value="{{ $uint->id }}">{{ $uint->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </span>
                    </label>
                    <div class=" col-6 col-md-6">
                        <div class="t-dropdown-block">
                            <div class="t-dropdown-select">
                                <input wire:model="min_area" type="number"
                                       class="t-dropdown-input"
                                       placeholder="Min Area"/>
                                <span class="t-select-btn"></span>
                            </div>
                            <ul class="t-dropdown-list">
                                @foreach ($areaUnitMinValue as $minValue)
                                    <li wire:click="$set('min_area',{{$minValue}})"
                                        class="t-dropdown-item"> {{$minValue}}</li>
                                @endforeach
                            </ul>
                            @if ($errors->has('min_area'))
                                <div style="color: #dc3545;">{{ $errors->first('min_area') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="t-dropdown-block">
                            <div class="t-dropdown-select">
                                <input wire:model="max_area" type="number" class="t-dropdown-input"
                                       placeholder="Max Area"/>
                                <span class="t-select-btn"></span>
                            </div>
                            <ul class="t-dropdown-list">
                                @foreach ($areaUnitMaxValue as $maxValue)
                                    <li wire:click="$set('max_area',{{$maxValue}})"
                                        class="t-dropdown-item"> {{$maxValue}}</li>
                                @endforeach
                            </ul>
                            @if ($errors->has('max_area'))
                                <div style="color: #dc3545;">{{ $errors->first('max_area') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($category_id == 1)
                <div class="col-6 col-md-3 filters-form">
                    <div class="mb-1">
                        <label class="form-label" for="year_build">{{__('Property Condition')}}</label>
                        <select wire:model.defer="year_build" class="form-select w-100" id="year_build">
                            <option value="{{now()->year}}">{{__('New')}}</option>
                            <option value="{{now()->subYear(5)->year}}">{{__('Old')}}</option>
                            <option value="{{now()->subYear(10)->year}}">{{__('Under Construction')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-3 filters-form">
                    <div class="mb-1">
                        <label class="form-label" for="min_rooms">{{__('Min Rooms')}}</label>
                        <input wire:model.defer="min_rooms" type="number" id="min_rooms"
                               class="form-control"
                               name="min_rooms" placeholder="Min Rooms">
                    </div>
                </div>
                <div class="col-6 col-md-3 filters-form">
                    <div class="mb-1">
                        <label class="form-label" for="max_rooms">{{__('Min Rooms')}}</label>
                        <input wire:model.defer="max_rooms" type="number" id="max_rooms"
                               class="form-control"
                               name="max_rooms" placeholder="Max Rooms">
                    </div>
                </div>
                <div class="col-6 col-md-3 filters-form">
                    <div class="mb-1">
                        <label class="form-label" for="min_bathrooms">{{__('Min Bathrooms')}}</label>
                        <input wire:model.defer="min_bathrooms" type="number" id="min_bathrooms"
                               class="form-control"
                               name="min_bathrooms"
                               placeholder="Min Bathrooms">
                    </div>
                </div>
                <div class="col-6 col-md-3 filters-form">
                    <div class="mb-1">
                        <label class="form-label" for="max_bathrooms">{{__('Max Bathrooms')}}</label>
                        <input wire:model.defer="max_bathrooms" type="number" id="max_bathrooms"
                               class="form-control"
                               name="max_bathrooms"
                               placeholder="Max Bathrooms">
                    </div>
                </div>
            @endif
            {{--                        <div class="col-6 col-md-3 filters-form">--}}
            {{--                            <div class="mb-1">--}}
            {{--                                <label class="form-label" for="parking-slots">{{__('Parking Slots')}}</label>--}}
            {{--                                <input type="number" id="parking-slots" class="form-control" name="parking-slots"--}}
            {{--                                       placeholder="Parking Slots">--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            <div class="col-12 col-md-3">
                <button type="submit"
                        class="btn btn-outline-primary waves-effect w-100 mb-1">{{__('Search')}}
                </button>
            </div>
        </div>
    </form>
</div>
