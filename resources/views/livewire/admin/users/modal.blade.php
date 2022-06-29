<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    @if ($showEditModal)
                        {{__('Edit Agent')}}
                    @else
                        {{__('Add New Agent')}}
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
                                           aria-describedby="phone_no" autofocus/>
                                    @error('phone_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="password">{{__('Password')}}</label>
                                <input wire:model.defer="data.password" type="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       placeholder="{{__('Password')}}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                                <input wire:model.defer="data.password_confirmation" type="password"
                                       id="password_confirmation" class="form-control" name="password_confirmation"
                                       placeholder="{{__('Confirm Password')}}">
                            </div>
                        </div>
                          <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label"
                                       for="commission">{{__('Commission')}}</label>
                                <input wire:model.defer="data.commission" type="number" id="commission"
                                       class="form-control @error('commission')  is-invalid @enderror"
                                       name="commission" placeholder="{{__('Commission')}}">
                                @error('commission')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input wire:model.defer="data.roles"
                                               class="form-check-input @error('roles') is-invalid @enderror"
                                               type="radio" name="roles"
                                               value="{{ $role->id }}">
                                        <label class="form-check-label" for="inlineRadio1">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('roles'))
                                    <div style="color: #dc3545;">{{ $errors->first('roles') }}</div>
                                @endif
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
