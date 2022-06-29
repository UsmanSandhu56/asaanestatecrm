<div wire:ignore.self id="property-features" class="content active" role="tabpanel"
     aria-labelledby="property-features-trigger">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="amenity_id">{{__('Property Features')}}</label>
            <div class="row ps-1">
                @foreach ($amenities as $amenity)
                    <div class="form-check col-md-3 mb-1">
           
                        <input type="checkbox"   @if($amenity->id<=4) checked @endif wire:model.defer="amenity_id"  value="{{$amenity->id}}"
                               class="form-check-input" name="amenity_id[]"
                               id="amenity_id{{$loop->iteration}}"/>{{  $amenity->index}}

                        <label class="form-check-label" for="amenity_id{{$loop->iteration}}">{{$amenity->type}}</label>
                    
                    </div>
                @endforeach
                @if ($errors->has('amenity_id'))
                    <div style="color: #dc3545;">{{ $errors->first('amenity_id') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
