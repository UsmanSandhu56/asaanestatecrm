<div wire:ignore.self id="media-details-modern"
     class="content active" role="tabpanel"
     aria-labelledby="media-details-modern-trigger">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="photos">{{__('Photos')}}</label>
            <input wire:model.defer="photos"
                   class="form-control @error('photos') is-invalid @enderror"
                   type="file"
                   accept="image/png, image/jpeg, image/jpg"
                   id="photos" multiple/>
            @error('photos.*')
            <div style="color: #dc3545;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label" for="videos">{{__('Videos')}}</label>
            <input  wire:model.defer="videos" type="url" placeholder="https://www.youtube.com"
                   class="form-control @error('videos') is-invalid @enderror"
                  
                   id="videos" />
            @error('videos')
            <div style="color: #dc3545;">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
