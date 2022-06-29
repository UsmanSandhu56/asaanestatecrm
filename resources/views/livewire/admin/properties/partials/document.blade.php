<div wire:ignore.self id="document-details-modern"
     class="content active"
     role="tabpanel"
     aria-labelledby="document-details-modern-trigger">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="documents">{{__('Documents')}}</label>
            <input wire:model.defer="documents"
                   class="form-control @error('documents') is-invalid @enderror"
                   type="file"
                   accept=".doc,.docx,.pdf"
                   id="documents"/>
            @error('documents.*')
            <div style="color: #dc3545;">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
