<div wire:ignore.self id="address-step-modern"
     class="content active"
     role="tabpanel"
     aria-labelledby="address-step-modern-trigger">
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="title">{{__('Property Title')}}</label>
            <input wire:model="title" type="text" id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="{{__('Property Title')}}"/>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="price">{{__('All Inclusive Price:(PKR)')}}</label>
            <input wire:model="price" type="number" id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   placeholder="{{__('Price')}}"/>
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <label class="form-label text-primary" for="price-words">
                @if(!empty($price))
                    @php
                    $f = new NumberFormatter("en-IN", NumberFormatter::SPELLOUT);
                    echo $f->format($price)
                    @endphp
                @endif
            </label>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="description">{{__('Description')}}</label>
            <textarea wire:model="description"
                      class="form-control @error('description') is-invalid @enderror"
                      id="description" rows="2"
                      placeholder="{{__('Description')}}"></textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label d-flex align-items-center justify-content-between"
                   for="area">{{__('Land Area')}} ({{$areaUnit}})
                <span>
                <select wire:model.defer="unit_id"
                        class="form-select bg-transparent shadow-none btn-outline-primary rounded px-50 py-0 text-dark "
                        id="unit_id" wire:model="areaUnit">
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
            <input wire:model="area" type="number" id="area"
                   class="form-control @error('area') is-invalid @enderror"
                   placeholder="{{__('Land Area')}}"/>
            @error('area')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1 col-md-6">

        </div>
    </div>


    <div class="row">
        @if($show)
            <div class="mb-1 col-md-6">
                <label class="form-label" for="rooms">{{__('Rooms')}}</label>
                <input wire:model="rooms" type="number" id="rooms"
                       class="form-control @error('rooms') is-invalid @enderror"
                       placeholder="{{__('Rooms')}}"/>
                @error('rooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="bathrooms">{{__('BathRooms')}}</label>
                <input wire:model="bathrooms" type="number" id="bathrooms"
                       class="form-control @error('bathrooms') is-invalid @enderror"
                       placeholder="{{__('BathRooms')}}"/>
                @error('bathrooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="parking_space">{{__('Parking Space')}}</label>
                <input wire:model="parking_space" type="number" id="parking_space"
                       class="form-control @error('parking_space') is-invalid @enderror"
                       placeholder="{{__('Parking Space')}}"/>
                @error('parking_space')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="year_build">{{__('Year Build')}}</label>
                <input wire:model="year_build" type="number" id="year_build"
                       class="form-control @error('year_build') is-invalid @enderror"
                       placeholder="{{__('Year Build')}}"/>
                @error('year_build')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        @endif
    </div>
</div>
