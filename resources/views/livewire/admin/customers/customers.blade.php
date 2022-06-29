@push('styles')
    <style>
        .cust-actions {
            min-width: 150px;
        }

        @media (min-width: 860px) {
            .cust-actions {
                min-width: 150px;
            }
        }
    </style>
@endpush
@section('title', 'Customers')
<div class="users-page" wire:ignore.self>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="content-header row" id="table-bordered">
                <div class="content-header-left col-md-9 col-sm-8 col-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{__('Customers')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('Customers')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @can('customer-create')
                    <div class="content-header-right col-md-3 col-sm-4 col-7 text-end mb-2">
                        <button wire:click.prevent="create" type="button" class="btn btn-outline-primary head-btn-pages">
                            {{__('Create Customer')}}
                        </button>
                    </div>
                @endcan
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-0">
                            <!-- Vertical modal -->
                            <div class="vertical-modal-ex">
                                <!-- Modal -->
                                @include('livewire.admin.customers.modal')
                                @include('livewire.admin.partials.delete-modal')
                            </div>
                            <!-- Vertical modal end-->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone No')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Created At')}}</th>
                                    <th>{{__('Updated At')}}</th>
                                    @can('customer-delete')
                                        <th>{{__('Actions')}}</th>
                                    @elsecan('customer-edit')
                                        <th>{{__('Actions')}}</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($customers as $customer)
                                    <tr @if ($loop->last) id="last_record" @endif>
                                        <td data-th="#">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td data-th="Name">
                                            {{ $customer->name }}
                                        </td>
                                        <td data-th="Email">
                                            {{ $customer->email }}
                                        </td>
                                        <td data-th="PhoneNo">
                                            {{ $customer->phone_no }}
                                        </td>
                                        <td data-th="Type">
                                            {{ ($customer->type === 0)? 'Individual': 'Other Agency'  }}
                                        </td>
                                        <td data-th="Created At">
                                            {{ $customer->created_at->diffForhumans() }}
                                        </td>
                                        <td data-th="Updated At">
                                            {{ $customer->updated_at->diffForhumans() }}
                                        </td>
                                        <td data-th="Actions" class="cust-actions">
                                            @can('customer-delete')
                                                <button
                                                    wire:click="confirmCustomerRemoval({{$customer->id}})"
                                                    type="button"
                                                    class="btn btn-danger">
                                                    <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                </button>
                                            @endcan
                                            @can('customer-edit')
                                                <button wire:click="edit({{ $customer }})"
                                                        type="button"
                                                        class="btn btn-warning">
                                                    <i class="far fa-edit" aria-hidden="true"></i>
                                                </button>
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
</div>
@push('scripts')
     <x-load-more/>
@endpush
