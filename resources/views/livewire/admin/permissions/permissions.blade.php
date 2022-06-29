@section('title', 'Permissions')
<div class="users-page">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="content-header row" id="table-bordered">
                <div class="content-header-left col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{__('Permissions')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('Permissions')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Created At')}}</th>
                                    <th>{{__('Updated At')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td data-th="#">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td data-th="Name">
                                            {{ $permission->name }}
                                        </td>
                                        <td data-th="Created At">
                                            {{$permission->created_at->diffForhumans() }}
                                        </td>
                                        <td data-th="Updated At">
                                            {{ $permission->updated_at->diffForhumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bordered table end -->
        </div>
    </div>
</div>
