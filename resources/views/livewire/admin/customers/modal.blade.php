<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    @if ($showEditModal)
                        {{__('Edit Customer')}}
                    @else
                        {{__('Add New Customer')}}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" class="form form-vertical"
                      wire:submit.prevent="{{ $showEditModal ? 'update' : 'store' }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label"
                                       for="name">{{__('Name')}}</label>
                                <input wire:model.defer="data.name" type="text" id="name"
                                       class="form-control @error('name')  is-invalid @enderror"
                                       name="name" placeholder="{{__('Name')}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="email">{{__('Email')}}</label>
                                <input wire:model.defer="data.email" type="text" id="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       placeholder="{{__('Email')}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label for="phone_no" class="form-label">{{__('Phone')}}</label>
                                <div class="input-group">
                                    <input wire:model.defer="data.phone_no" type="number"
                                           class="form-control @error('phone_no') is-invalid @enderror"
                                           id="phone_no"
                                           name="phone_no" placeholder="XXXXXXXXXXX"
                                           aria-describedby="phone_no" tabindex="2" autofocus/>
                                    @error('phone_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-12">
                            <label class="form-label" for="type">{{__('Type')}}</label>
                            <div class="form-check form-switch form-check-success agent-single">
                                <input wire:model.defer="data.type" type="checkbox"
                                       class="form-check-input" id="type"
                                       checked="">
                                <label class="form-check-label" for="type">
                                    <span class="switch-icon-left">{{__('Other Agency')}}</span>
                                    <span class="switch-icon-right">{{__('Individual')}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary waves-effect"
                                    data-bs-dismiss="modal" aria-label="Close">{{__('Close')}}
                            </button>
                            <button type="submit"
                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                @if ($showEditModal)
                                    <span>{{__('Update')}}</span>
                                @else
                                    <span>{{__('Save')}}</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
