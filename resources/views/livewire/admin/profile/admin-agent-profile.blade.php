<!-- personal tab -->
<div wire:ignore.self role="tabpanel" class="tab-pane active"
     id="account-vertical-personal"
     aria-labelledby="account-pill-personal" aria-expanded="true">
    <!-- header section -->
    <!--/ header section -->

    <!-- form -->
    <form wire:submit.prevent="updateProfile" class="validate-form mt-2">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label"
                           for="name">{{__('Name')}}</label>
                    <input wire:model.defer="name" type="text"
                           class="form-control @error('name')  is-invalid @enderror"
                           id="name" name="name" placeholder="Name"/>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label" for="phone_no">{{__('Phone')}}</label>
                    <input wire:model.defer="phone_no" type="text"
                           class="form-control @error('phone_no')  is-invalid @enderror"
                           id="phone_no"
                           name="phone_no" placeholder="XXXXXXXXXXX"/>
                    @error('phone_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label" for="email">{{__('Email')}}</label>
                    <input wire:model.defer="email" type="email"
                           class="form-control @error('email')  is-invalid @enderror"
                           id="email"
                           name="email" placeholder="Email"/>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-2 me-1">{{__('Save
                                                        changes')}}
                </button>
            </div>
        </div>
    </form>
    <!--/ form -->
</div>
<!--/ personal tab -->
<!-- change password -->
<div wire:ignore.self class="tab-pane fade"
     id="account-vertical-password" role="tabpanel"
     aria-labelledby="account-pill-password" aria-expanded="false">
    <!-- form -->
    <form wire:submit.prevent="changePassword" class="validate-form">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label" for="current_password">{{__('Current Password')}}</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input wire:model.defer="current_password" type="password"
                               class="form-control @error('current_password')  is-invalid @enderror"
                               id="current_password" name="password" value=""
                               placeholder="{{__('Current Password')}}"/>
                        <div class="input-group-text cursor-pointer"
                             @error('current_password') style="border-color: #dc3545; " @enderror>
                            <span wire:ignore> <i data-feather="eye"></i> </span>
                        </div>
                        @error('current_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label" for="new_password">{{__('New Password')}}</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input wire:model.defer="new_password" type="password"
                               id="new_password"
                               name="new_password" value=""
                               class="form-control @error('new_password')  is-invalid @enderror"
                               placeholder="New Password"/>
                        <div class="input-group-text cursor-pointer"
                             @error('new_password') style="border-color: #dc3545; " @enderror>
                            <span wire:ignore> <i data-feather="eye"></i> </span>
                        </div>
                        @error('new_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label" for="password_confirmation">{{__('Confirm
                                                            Password')}}</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input wire:model.defer="password_confirmation"
                               type="password" value=""
                               class="form-control @error('password_confirmation')  is-invalid @enderror"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Confirm Password"/>
                        <div class="input-group-text cursor-pointer"
                             @error('password_confirmation') style="border-color: #dc3545; " @enderror>
                            <span wire:ignore> <i data-feather="eye"></i> </span>
                        </div>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary me-1 mt-1">{{__('Save changes')}}</button>
            </div>
            
        </div>
    </form>
    <!--/ form -->
</div>
<!--/ change password -->
