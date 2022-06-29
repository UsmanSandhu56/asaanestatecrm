@section('title', 'Create Role')
<div class="users-page" wire:ignore.self>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="content-header row">
                <div class="content-header-leftcol-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{__('Create Role')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('Create Role')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <form wire:submit.prevent="store">
                        <div class="row">
                            <div class="mb-1 col-sm-12">
                                <h6><label class="form-label" for="name">{{__('Role Name')}}</label></h6>
                                <input wire:model.defer="name" type="text" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="{{__('Role Name')}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1 col-sm-12">
                                <div class="create-role-permission mt-1">
                                    <h6 class="pb-1 mb-0 font-medium-2">
                                        <span class="align-middle">{{__('Permission')}}</span>
                                    </h6>
                                    @foreach($permissions as $permission)
                                        <div class="form-check mt-50">
                                            <input type="checkbox" wire:model.defer="permission_id"
                                                   id="{{ $loop->index }}" value="{{$permission->id}}"
                                                   class="form-check-input">
                                            <label class="form-check-label"
                                                   for="{{ $loop->index }}">{{$permission->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if ($errors->has('permission_id'))
                                <div style="color: #dc3545;">{{ $errors->first('permission_id') }}</div>
                            @endif
                            <div class="text-end">
                                <button class="btn btn-primary">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Bordered table end -->
        </div>
    </div>
</div>
