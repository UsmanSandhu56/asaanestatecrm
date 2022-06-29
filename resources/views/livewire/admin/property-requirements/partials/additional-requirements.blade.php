<div wire:ignore.self id="address-step-modern" class="content active"
     role="tabpanel"
     aria-labelledby="address-step-modern-trigger">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="title">{{__('Requirement Title')}}</label>
            <input wire:model.defer="title" type="text" id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="{{__('Requirement Title')}}"/>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label" for="description">{{__('Requirement Description')}}</label>
            <textarea wire:model.defer="description"
                      class="form-control @error('description') is-invalid @enderror"
                      id="description" rows="2"
                      placeholder="{{__('Requirement Description')}}"></textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
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
                <div class="mb-1 col-md-6">
                    <div class="t-dropdown-block">
                        <div class="t-dropdown-select">
                            <input wire:model="min_area" type="number"
                                   class="t-dropdown-input"
                                   placeholder="{{__('Min Area')}}"/>
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
                <div class="mb-1 col-md-6">
                    <div class="t-dropdown-block">
                        <div class="t-dropdown-select">
                            <input wire:model="max_area" type="number" class="t-dropdown-input" placeholder="{{__('Max Area')}}"/>
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
        <div class="col-md-6">
            <div class="row">
                <label class="form-label" for="min_price">{{__('All Inclusive Price:(PKR)')}}</label>
                <div class="mb-1 col-md-6">
                    <div class="t-dropdown-block">
                        <div class="t-dropdown-select">
                            <input wire:model="min_price" type="number"
                                   class="t-dropdown-input"
                                   placeholder="{{__('Min Price')}}"/>
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
                <div class="mb-1 col-md-6">
                    <div class="t-dropdown-block">
                        <div class="t-dropdown-select">
                            <input wire:model="max_price" type="number" class="t-dropdown-input"
                                   placeholder="{{__('Max Price')}}"/>
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
    </div>
    <div class="row">
        @if($show)
            <div class="mb-1 col-md-3">
                <label class="form-label" for="min_rooms">{{__('Min Rooms')}}</label>
                <input wire:model.defer="min_rooms" type="number" id="min_rooms"
                       class="form-control @error('min_rooms') is-invalid @enderror"
                       placeholder="{{__('Min Rooms')}}"/>
                @error('min_rooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-3">
                <label class="form-label" for="max_rooms">{{__('Max Rooms')}}</label>
                <input wire:model.defer="max_rooms" type="number" id="max_rooms"
                       class="form-control @error('max_rooms') is-invalid @enderror"
                       placeholder="{{__('Max Rooms')}}"/>
                @error('max_rooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-3">
                <label class="form-label" for="min_bathrooms">{{__('Min BathRooms')}}</label>
                <input wire:model.defer="min_bathrooms" type="number" id="min_bathrooms"
                       class="form-control @error('min_bathrooms') is-invalid @enderror"
                       placeholder="{{__('Min BathRooms')}}"/>
                @error('min_bathrooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-3">
                <label class="form-label" for="max_bathrooms">{{__('Max BathRooms')}}</label>
                <input wire:model.defer="max_bathrooms" type="number" id="max_bathrooms"
                       class="form-control @error('max_bathrooms') is-invalid @enderror"
                       placeholder="{{__('Max BathRooms')}}"/>
                @error('max_bathrooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="parking_space">{{__('Parking Space')}}</label>
                <input wire:model.defer="parking_space" type="number" id="parking_space"
                       class="form-control @error('parking_space') is-invalid @enderror"
                       placeholder="{{__('Parking Space')}}"/>
                @error('parking_space')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="year_build">{{__('House Condition')}}</label>
                <select wire:model.defer="year_build" class="form-select w-100" id="year_build">
                    <option value="{{now()->year}}">{{__('New')}}</option>
                    <option value="{{now()->subYear(5)->year}}">{{__('Used')}}</option>
                    <option value="{{now()->subYear(10)->year}}">{{__('Old')}}</option>
                </select>
            </div>
        @endif
    </div>
</div>
@include('livewire.admin.partials.scripts')
