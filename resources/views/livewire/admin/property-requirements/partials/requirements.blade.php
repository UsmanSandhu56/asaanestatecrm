<div wire:ignore.self id="account-details-modern"
     class="content active" role="tabpanel"
     aria-labelledby="account-details-modern-trigger">
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label w-100" for="purpose">{{__('Purpose')}}</label>
            <div class="btn-group w-100" role="group">
                <input wire:model.defer="purpose" type="radio" class="btn-check"
                       name="btnradio" id="btnradio1"
                       value="0" autocomplete="off" checked="">
                <label class="btn btn-outline-primary waves-effect" for="btnradio1">{{__('Buy')}}</label>

                <input wire:model.defer="purpose" type="radio" class="btn-check"
                       name="btnradio" id="btnradio2"
                       value="1" autocomplete="off">
                <label class="btn btn-outline-primary waves-effect" for="btnradio2">{{__('Rent')}}</label>
            </div>
            @if ($errors->has('purpose'))
                <div style="color: #dc3545;">{{ $errors->first('category_id') }}</div>
            @endif
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label w-100" for="category">{{__('Property Type')}}</label>
            <div class="btn-group w-100" role="group2">
                @foreach ($categories as $category)
                    <input
                        wire:change="getSubcategories({{$category->id}})"
                        wire:model.defer="category_id" type="radio"
                        class="btn-check"
                        id="{{$loop->iteration}}"
                        name="category" value="{{$category->id}}"
                        autocomplete="off"/>
                    <label class="btn btn-outline-primary"
                           for="{{$loop->iteration}}">{{__($category->name)}}
                    </label>
                @endforeach
            </div>
            @if ($errors->has('category_id'))
                <div style="color: #dc3545;">{{ $errors->first('category_id') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="sub_category">{{__('Plot Details')}}</label>
            <select wire:model.defer="sub_category_id"
                    class="form-select w-100 @error('sub_category_id') is-invalid @enderror"
                    id="sub_category">
                @if ($subCategories->count() == 0)
                    <option value=""> {{__('Choose Property Type First')}}</option>
                @endif
                @foreach ($subCategories as $subCategory)
                    <option
                        value="{{ $subCategory->id }}"> {{ __($subCategory->name) }} </option>
                @endforeach
            </select>
            @error('sub_category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-2 col-md-6 urgency-bar">
            <label class="w-100 m-0" for="urgency">{{__('Urgency')}}</label>
            <label for="a" class="text-start ur-label">{{__('Immediate')}}</label>
            <label for="b" class="ur-label">{{__('2-3 weeks')}}</label>
            <label for="c" class="text-end ur-label">{{__('1+ month')}}</label>
            <input wire:model.defer="urgency" type="radio" name="urgency" value="0"
                   hidden id="b" />
            <input wire:model.defer="urgency"checked type="radio" name="urgency" value="1"
                   hidden id="a"/>
            <input wire:model.defer="urgency" type="radio" name="urgency" value="2"
                   hidden id="c"/>
            <div class="slider">
                <div class="marker"></div>
            </div>
        </div>
       
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="city">{{__('City')}}</label>
            <input wire:model.defer="city" type="text" id="city"
            autocomplete="off" class="form-control @error('city') is-invalid @enderror"
                   placeholder="{{__('Enter a city name')}}"/>
            @error('city')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="autocomplete">{{__('Location')}}</label>
            <input wire:model.defer="location"
                   onchange="this.dispatchEvent(new InputEvent('input'))"
                   name="autocomplete"
                   type="text" id="autocomplete"
                   class="form-control "
                   placeholder="{{__('Enter Location')}}"/>
            @error('location')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-check mb-1 col-md-6">
        <input wire:model.defer="is_serious" class="form-check-input" type="checkbox" name="is_serious" id="is_serious">
        <label class="form-label" for="is_serious">{{__('Is Hot')}}</label>
        @error('is_serious')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group" hidden>
        <label>{{__('Latitude')}}</label>
        <input type="text" wire:model.defer="latitude" id="latitude"
               name="latitude"
               class="form-control">
    </div>
    <div class="form-group" hidden>
        <label>{{__('Longitude')}}</label>
        <input type="text" wire:model.defer="longitude" name="longitude"
               id="longitude"
               class="form-control">
    </div>
    <div class="form-group" hidden>
        <label class="form-label">{{__('City')}}</label>
        <input id="locality" wire:model.defer="city"/>
    </div>
    <div class="form-group" hidden>
        <label class="form-label">{{__('Sub Locality 1')}}</label>
        <input id="sublocality_level_1" wire:model.defer="sublocality_level_1"
               name="sublocality_level_1"/>
    </div>
    <div class="form-group" hidden>
        <label class="form-label">{{__('Sub Locality 2')}}</label>
        <input id="sublocality_level_2" wire:model.defer="sublocality_level_2"
               name="sublocality_level_2"/>
    </div>
    <div class="form-group" hidden>
        <label class="form-label">{{__('Sub Locality 3')}}</label>
        <input id="sublocality_level_3" wire:model.defer="sublocality_level_3"
               name="sublocality_level_3"/>
    </div>
</div>
