@section('title', 'Closed Deals')
<div class="users-page" wire:ignore.self>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="content-header row" id="table-bordered">
                <div class="content-header-left col-md-9 col-sm-8 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{__('Closed Deals')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('Closed Deals')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-0">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Property')}}</th>
                                    <th>{{__('Property Requirement')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Agency Commission')}}</th>
                                    <th>{{__('Agent Commission')}}</th>
                                    <th>{{__('Created At')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deals as $deal)
                                    <tr @if ($loop->last) id="last_record" @endif>
                                        <td data-th="#">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td data-th="Property">
                                            {{ $deal->property->title }}
                                        </td>
                                        <td data-th="Property Requirement">
                                            {{ $deal->propertyRequirement->title }}
                                        </td>
                                        <td data-th="Amount">
                                            {{ $deal->amount }}
                                        </td>
                                        <td data-th="Agency Commission">
                                            {{ $deal->agency_commission }}
                                        </td>
                                        <td data-th="Agent Commission">
                                            {{ $deal->agent_commission }}
                                        </td>
                                        <td data-th="Created At">
                                            {{ $deal->created_at->diffForhumans() }}
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

