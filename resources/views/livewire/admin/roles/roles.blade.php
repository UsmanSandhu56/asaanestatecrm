@section('title', 'Roles')
<div class="users-page add-roles-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="content-header row" id="table-bordered">
                <div class="content-header-left col-md-9 col-sm-8 col-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{__('Roles')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('Roles')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @can('role-create')
                <div class="content-header-right col-md-3 col-sm-4 col-6 text-end mb-2">
                    <a href="{{route('roles.create')}}" class="btn btn-outline-primary">
                        {{__('Create Role')}}
                    </a>
                </div>
                @endcan
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Permission')}}</th>
                                    @can('role-delete')
                                        <th class="add-roles-action">{{__('Actions')}}</th>
                                    @elsecan('role-edit')
                                        <th class="add-roles-action">{{__('Actions')}}</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                    <tr @if ($loop->last) id="last_record" @endif>
                                        <td data-th="#">
                                            {{$loop->iteration}}
                                        </td>
                                        <td data-th="Name">
                                            {{$role->name}}
                                        </td>
                                        <td class="roles-permissions" data-th="Permissions">
                                            @foreach($role->permissions()->pluck('name') as $permission)
                                                <label class="badge bg-primary mb-1">{{ $permission }}</label>
                                            @endforeach
                                        </td>
                                        <td data-th="Actions">
                                            @can('role-delete')
                                                <button
                                                    wire:click="confirmRoleRemoval({{$role->id}})"
                                                    type="button"
                                                    class="btn btn-danger">
                                                    <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                </button>
                                            @endcan
                                            @can('role-edit')
                                                <a href="{{route('roles.edit', $role)}}" class="btn btn-warning">
                                                    <i class="far fa-edit" aria-hidden="true"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($perPage <= $totalRecords)
                            <x-loading-spinner/>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Bordered table end -->
        </div>
    </div>
    @include('livewire.admin.partials.delete-modal')
</div>
@push('scripts')
     <x-load-more/>
@endpush
