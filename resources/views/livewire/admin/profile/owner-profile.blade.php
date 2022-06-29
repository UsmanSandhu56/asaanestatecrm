<!-- general tab -->
<div wire:ignore.self role="tabpanel" class="tab-pane active"
     id="account-vertical-general"
     aria-labelledby="account-pill-general" aria-expanded="true">
    <!-- header section -->
    <!--/ header section -->

    <!-- form -->
    <form wire:submit.prevent="updateAgencyProfile" class="validate-form mt-2">
        <div class="d-flex">
            <a href="#" class="me-25">
                @if ($profile)
                    <img src="{{ $profile->temporaryUrl() }}"
                         id="account-upload-img" class="rounded me-50"
                         alt="profile image"
                         height="80" width="80"/>
                @else
                    <img src="{{$agency->getFirstMediaUrl('profile')}}"
                         id="account-upload-img" class="rounded me-50"
                         alt="profile image"
                         height="80" width="80"/>
                @endif
            </a>
            <!-- upload and reset button -->
            <div class="mt-75 ms-1">
                <label for="account-upload"
+                       class="btn btn-primary waves-effect waves-float waves-light">{{__('Upload')}}</label>
                <input wire:model.defer="profile" type="file" id="account-upload"
                       hidden
                       accept="image/*"/>
            </div>
            <div class="mt-75 ms-1">

        @switch($status)

        @case('')

        <button type="button"

        class="btn btn-primary waves-effect waves-float waves-light"
        data-bs-toggle="modal" data-bs-target="#confirmationModal">{{__('Fetch Properties')}}
        </button>
        @break

        @case(0)


        <button class="btn btn-outline-primary waves-effect"  type="button">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="ms-25 align-middle">Processing...</span>
        </button>

        @break
        @case(1)
        <button type="button"

        class="btn btn-primary waves-effect waves-float waves-light"
        data-bs-toggle="modal" data-bs-target="#confirmationModal">
        </button>
        Completed.
        @break
        @case(2)
        <button type="button"

        class="btn btn-primary waves-effect waves-float waves-light"
        data-bs-toggle="modal" data-bs-target="#confirmationModal">{{__('Fetch Properties')}}
    </button>

        @break

        @default

        @endswitch


        </div>
            {{-- @if($status)
            <button class="btn btn-outline-primary waves-effect" type="button">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="ms-25 align-middle">@if($status==2)Failed @elseif($status==1)Completed @else Processing... @endif</span>

            @endif --}}

        </div>


            <!--/ upload and reset button -->

        <br><br>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label"
                           for="agency_name">{{__('Agency Name')}}</label>
                    <input wire:model.defer="agency_name" type="text"
                           class="form-control @error('agency_name')  is-invalid @enderror"
                           id="agency_name" name="name" placeholder="{{__('Agency Name')}}"/>
                    @error('agency_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label"
                           for="agency_address">{{__('Agency Address')}}</label>
                    <input wire:model.defer="agency_address" type="text"
                           class="form-control @error('agency_address')  is-invalid @enderror"
                           id="agency_address"
                           name="address" placeholder="{{__('Address')}}"/>
                    @error('agency_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label"
                           for="agency_phone_no">{{__('Phone')}}</label>
                    <input wire:model.defer="agency_phone_no" type="text"
                           class="form-control @error('agency_phone_no')  is-invalid @enderror"
                           id="agency_phone_no"
                           name="phone_no" placeholder="XXXXXXXXXXX"/>
                    @error('agency_phone_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label"
                           for="agency_email">{{__('Email')}}</label>
                    <input wire:model.defer="agency_email" type="email"
                           class="form-control @error('agency_email')  is-invalid @enderror"
                           id="agency_email"
                           name="email" placeholder="{{__('Email')}}"/>
                    @error('agency_email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="mb-1">
                    <label class="form-label"
                           for="agency_email">{{__('Zameen Agency Profile')}}</label>
                    <input
                           class="form-control @error('zameen_url')  is-invalid @enderror"
                           id="zameen_url" wire:model.defer="zameen_url"
                           name="url" placeholder="{{__('Enter URL')}}"/>

                    @error('zameen_url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <button type="submit"  class="btn btn-primary me-1 mt-1">{{__('Save changes')}}</button>
            </div>


            <div class="col-12 col-sm-6">
                <button type="button" style="display:none;" class="btn btn-secondary me-1 mt-1 click-btn" onclick="showDiv()" value="click on me">{{__('Scrape data')}}</button>
            </div>






        </div>
    </form>
    <div class="mt-75 mr-20 ms-1">



    </div>
    <!--/ form -->
</div>
<!--/ general tab -->
<!-- personal tab -->
<div wire:ignore.self class="tab-pane fade"
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
                           id="name" name="name" placeholder="{{__('Name')}}"/>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label" for="phone_no">{{__('Phone/Landline')}}</label>
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
                           name="email" placeholder="{{__('Email')}}"/>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            @can('update-commission')
            <div class="col-12 col-sm-6">
                <div class="mb-1">
                    <label class="form-label"
                           for="commission">{{__('Commision')}}</label>
                    <input wire:model.defer="commission" type="text"
                           class="form-control @error('commission')  is-invalid @enderror"
                           id="commission" name="commission" placeholder="{{__('Commision')}}"/>
                    @error('commission')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            @endcan
            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-2 me-1">{{__('Save changes')}}
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
                               placeholder="{{__('New Password')}}"/>
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
                    <label class="form-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input wire:model.defer="password_confirmation"
                               type="password" value=""
                               class="form-control @error('password_confirmation')  is-invalid @enderror"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="{{__('Confirm Password')}}"/>
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
                <button type="button" class="btn btn-primary me-1 mt-1">{{__('Save changes')}}</button>
            </div>

        </div>
    </form>
    <!--/ form -->
</div>

<!--/ change password -->

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>{{__('Delete Record')}}</h5>
            </div>

            <div class="modal-body">
                <h4>{{__('Are you sure you want to fetch data?')}}</h4>
            </div>

            <form wire:submit.prevent="InsertScraper" id="scraperform" class="validate-form mt-2">
                <input  hidden
                class="form-control @error('zameen_url')  is-invalid @enderror"
                id="zameen_url" wire:model.defer="zameen_url"
                name="zameen_url" />

                <input hidden
                class="form-control @error('agency_id')  is-invalid @enderror"
                id="agency_id" wire:model.defer="agency_id"
                name="url" />

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal" aria-label="Close">{{__('Cancel')}}
                </button>
                <button type="submit"  class="btn btn-success">{{__('Yes')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>


