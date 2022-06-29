@push('styles')
    <style>
        @media (max-width: 767px) {
            .dash-prop-req .nav-tabs {
                width: 100%;
                height: 45px !important;
            }

            .dash-prop-req .nav-tabs .nav-item {
                width: 33.33%;
                float: left;
            }

            .dash-prop-req .nav.nav-tabs .nav-item .nav-link {
                padding: 10px;
                display: flex;
                justify-content: center;
            }

            .dash-prop-req .nav.nav-tabs .nav-item .nav-link:after {
                transform: rotate(0deg) translate3d(0, 0, 0) !important;
                width: 100% !important;
                right: 0 !important;
                top: 40px !important;
                top: 40px !important;
            }

            .nav-vertical .nav.nav-tabs .nav-item .nav-link:after {
                left: 100%;
            }

            .dash-prop-req .tab-pane.active {
                padding-left: 1px !important;
            }
        }
    </style>
@endpush
<section id="chartjs-chart">
    <div class="row match-height">
        <div class="col-12" id="nav-filled">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title fs-3">{{__('Deals')}}</h4>
                </div>
                <div class="card-body">

                    <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-justified" data-bs-toggle="tab"
                               href="#home-just" role="tab" aria-controls="home-just"
                               aria-selected="true">{{__('Deals Closed')}} <span
                                    class="fw-bolder fs-4 ms-1">{{$deals->count()}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-justified" data-bs-toggle="tab"
                               href="#profile-just" role="tab" aria-controls="profile-just"
                               aria-selected="true">{{__('Deals Missed')}} <span
                                    class="fw-bolder fs-4 ms-1">{{$missedDeals->count()}}</span></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content pt-1">
                        <div class="tab-pane active" id="home-just" role="tabpanel"
                             aria-labelledby="home-tab-justified">
                            <div class="row">
                                <div class="col-md-12 col-12 p-2 text-center">
                                    <p class="card-text mb-50 text-danger fs-4 fw-bold"><i
                                            class="fa fa-user d-block mb-50 fs-2"></i>{{__('Total Commission Earned')}}
                                    </p>
                                    <span class="font-large-1 fw-bold">{{$agent_commission}}</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{__('Property')}}</th>
                                        <th>{{__('Commission')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deals->take(5) as $deal)
                                        <tr>
                                            <td data-th="Property">
                                                                <span
                                                                    class="fw-bolder mb-25">{{$deal->property->title}}</span>
                                            </td>
                                            <td data-th="Commission">{{$deal->agent_commission}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <a href="#"
                                       class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                        {{__('View All')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile-just" role="tabpanel"
                             aria-labelledby="profile-tab-justified">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{__('Property')}}</th>
                                        <th>{{__('Customer')}}</th>
                                        <th>{{__('Reason')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($missedDeals as $deal)
                                        <tr>
                                            <td data-th="Property">
                                                <span class="fw-bolder mb-25">{{$deal->title}}</span>
                                            </td>
                                            <td data-th="Customer">{{$deal->customer->phone_no}}</td>
                                            <td data-th="Reason">{{__('No Contact')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <a href="#"
                                       class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                        {{__('View All')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row match-height dash-prop-req">
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <h4 class="card-title">{{__('Total Property Requirements')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="nav-vertical">
                                <ul class="nav nav-tabs nav-left flex-column" role="tablist"
                                    style="height: 98px;">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="baseVerticalLeft-tab1"
                                           data-bs-toggle="tab" aria-controls="tabVerticalLeft1"
                                           href="#tabVerticalLeft11" role="tab"
                                           aria-selected="true">{{__('Property')}}<span
                                                class="fw-bolder fs-4 ms-1">{{$propertyRequirements->count()}}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab2"
                                           data-bs-toggle="tab" aria-controls="tabVerticalLeft2"
                                           href="#tabVerticalLeft12" role="tab"
                                           aria-selected="false">{{__('Hot')}}
                                            <span
                                                class="fw-bolder fs-4 ms-1">{{$propertyRequirements->where('is_serious',true)->count()}}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab3"
                                           data-bs-toggle="tab" aria-controls="tabVerticalLeft3"
                                           href="#tabVerticalLeft13" role="tab"
                                           aria-selected="false">{{__('Cold')}}
                                            <span
                                                class="fw-bolder fs-4 ms-1">{{$propertyRequirements->where('is_serious',false)->count()}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabVerticalLeft11" role="tabpanel"
                                         aria-labelledby="baseVerticalLeft-tab1">
                                        <div class="card card-company-table">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Property')}}</th>
                                                            <th>{{__('Customer')}}</th>
                                                            <th>{{__('Status')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($propertyRequirements->take(5) as $propertyRequirement)
                                                            <tr>
                                                                <td data-th="Property">
                                                                                    <span
                                                                                        class="fw-bolder mb-25">{{$propertyRequirement->title}}</span>
                                                                </td>
                                                                <td data-th="Customer">{{$propertyRequirement->customer->name}}
                                                                </td>
                                                                <td data-th="Status">{{($propertyRequirement->status == true) ? 'Hot' : 'Cold'}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    {{-- <div class="text-end">
                                                        <button type="submit"
                                                                class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                                            {{__('View All')}}
                                                        </button>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft12" role="tabpanel"
                                         aria-labelledby="baseVerticalLeft-tab2">
                                        <div class="card card-company-table">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Property')}}</th>
                                                            <th>{{__('Customer')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($propertyRequirements->where('is_serious',true)->take(5) as $property)
                                                            <tr>
                                                                <td data-th="Property">
                                                                                    <span
                                                                                        class="fw-bolder mb-25">{{$property->title}}</span>
                                                                </td>
                                                                <td data-th="Customer">{{$property->customer->name}}
                                                                    ({{$property->user->phone_no}})
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="text-end">
                                                        <button type="submit"
                                                                class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                                            {{__('View All')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft13" role="tabpanel"
                                         aria-labelledby="baseVerticalLeft-tab3">
                                        <div class="card card-company-table">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Property')}}</th>
                                                            <th>{{__('Customer')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($propertyRequirements->where('is_serious',false)->take(5) as $property)
                                                            <tr>
                                                                <td data-th="Property">
                                                                                    <span
                                                                                        class="fw-bolder mb-25">{{$property->title}}</span>
                                                                </td>
                                                                <td data-th="Customer">{{$property->customer->name}}
                                                                    ({{$property->user->phone_no}})
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="text-end">
                                                        <button type="submit"
                                                                class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                                            {{__('View All')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
