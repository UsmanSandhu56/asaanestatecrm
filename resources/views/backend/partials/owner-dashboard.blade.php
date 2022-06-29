@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/rs-css/chart-apex.css')}}">
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
                                <div class="col-md-6 col-12 p-2 text-center">

                                    <p class="card-text mb-50 text-danger fs-4 fw-bold"><i
                                            class="fa fa-users d-block mb-50 fs-2"></i>{{__('Agency Commission')}}
                                    </p>
                                    <span class="font-large-1 fw-bold">{{$agency_commission}}</span>
                                </div>
                                <div class="col-md-6 col-12 p-2 text-center">
                                    <p class="card-text mb-50 text-danger fs-4 fw-bold"><i
                                            class="fa fa-user d-block mb-50 fs-2"></i>{{__('Agents Commission')}}
                                    </p>
                                    <span class="font-large-1 fw-bold">{{$agent_commission}}</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{__('Property')}}</th>
                                        <th>{{__('Agency Commission')}}</th>
                                        <th>{{__('Agent Name')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deals->take(5) as $deal)
                                        <tr>
                                            <td data-th="Property">
                                                                <span
                                                                    class="fw-bolder mb-25">{{$deal->property->title}}</span>
                                            </td>
                                            <td data-th="Agency Commission">{{$deal->agency_commission}}</td>
                                            <td data-th="Agent Name">{{$deal->user->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="text-end">
                                    <a href="#"
                                       class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                        {{__('View All')}}
                                    </a>
                                </div> --}}
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
                                        <th>{{__('Agent')}}</th>
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
                                            <td data-th="Agent Name">{{$deal->user->name}}</td>
                                            <td data-th="Reason">{{__('No Contact')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="text-end">
                                    <a href="#"
                                       class="btn btn-primary mt-2 waves-effect waves-float waves-light">
                                        {{__('View All')}}
                                    </a>
                                </div> --}}
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
                                                            <th>{{__('Agent')}}</th>
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
                                                                <td data-th="Status">{{($propertyRequirement->is_serious == true) ? 'Hot' : 'Cold'}}</td>
                                                                <td data-th="Assigned To">{{$propertyRequirement->user->name}}</td>
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
                                                            <th>{{__('Agent')}}</th>
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
                                                                <td data-th="Assigned To">{{$property->user->name}}</td>
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
                                                            <th>{{__('Agent')}}</th>
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
                                                                <td data-th="Assigned To">{{$property->user->name}}</td>
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

    <div class="row match-height">
        <div class="col-12">
            <div class="card card-company-table">
                <div class="card-header">
                    <h4 class="card-title">{{__('Our Top Agents')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{__('Agent')}}</th>
                                <th>{{__('Deals Close')}}</th>
                                <th>{{__('Deals Missed')}}</th>
                                <th>{{__('Commission')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($top_agents as $agent)
                                <tr>
                                    <td data-th="Agent"><span class="fw-bolder mb-25">{{$agent->name}}</span>
                                    </td>
                                    <td data-th="Deals Close">{{$agent->property_deals_count}}</td>
                                    <td data-th="Deals Missed">{{$agent->property_requirements_count}}</td>
                                    <td data-th="Commission" class="text-primary">{{__('PKR')}}
                                        - {{$agent->property_deals_sum_agent_commission}}</td>
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
    </div>

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div
                    class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                    <div>
                        <h4 class="card-title">{{__('Growth')}}</h4>
                    </div>
                    <div class="bookmark-wrapper d-flex align-items-center">
                        <select class="form-select pe-3" id="selectTimeLimit" wire:model="records">
                            <option selected value="{{now()->subDays(7)->format('Y-m-d')}}">7 Days Records</option>
                            <option value="{{now()->subDays(15)->format('Y-m-d')}}">15 Days Records</option>
                            <option value="{{now()->subDays(30)->format('Y-m-d')}}">30 Days Records</option>
                            <option value="{{now()->subMonths(6)->format('Y-m-d')}}">6 Month Records</option>
                            <option value="{{now()->subWeeks(52)->format('Y-m-d')}}">1 Year Records</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="line-area-chart"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{asset('app-assets/js/apexcharts.min.js')}}"></script>
    <script>
        $(function () {
            'use strict';
            console.log('1st');
            var flatPicker = $('.flat-picker'),
                isRtl = $('html').attr('data-textdirection') === 'rtl',
                chartColors = {
                    column: {
                        series1: '#826af9',
                        series2: '#d2b0ff',
                        bg: '#f8d3ff'
                    },
                    success: {
                        shade_100: '#7eefc7',
                        shade_200: '#06774f'
                    },
                    donut: {
                        series1: '#ffe700',
                        series2: '#00d4bd',
                        series3: '#826bf8',
                        series4: '#2b9bf4',
                        series5: '#FFA1A1'
                    },
                    area: {
                        series3: '#a4f8cd',
                        series2: '#60f2ca',
                        series1: '#2bdac7'
                    }
                };

            // --------------------------------------------------------------------
            var areaChartEl = document.querySelector('#line-area-chart'),
                areaChartConfig = {
                    chart: {
                        height: 400,
                        type: 'area',
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: false,
                        curve: 'straight'
                    },
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'start'
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
                    series: [
                        {
                            name: 'Total',
                            data: @js($total)
                        },
                        {
                            name: 'Sold',
                            data: @js($sold)
                        },
                        {
                            name: 'Tenanted',
                            data: @js($tenanted)
                        }
                    ],
                    xaxis: {
                        categories: @js($days)
                    },
                    fill: {
                        opacity: 1,
                        type: 'solid'
                    },
                    tooltip: {
                        shared: false
                    },
                    yaxis: {
                        opposite: isRtl
                    }
                };
            if (typeof areaChartEl !== undefined && areaChartEl !== null) {
                var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
                areaChart.render();
            }
        });
    </script>
    <script>
        Livewire.on('setGraphData', (tenanted, sold, days, total) => {
            $(function () {
                'use strict';
                console.log('1st');
                var flatPicker = $('.flat-picker'),
                    isRtl = $('html').attr('data-textdirection') === 'rtl',
                    chartColors = {
                        column: {
                            series1: '#826af9',
                            series2: '#d2b0ff',
                            bg: '#f8d3ff'
                        },
                        success: {
                            shade_100: '#7eefc7',
                            shade_200: '#06774f'
                        },
                        donut: {
                            series1: '#ffe700',
                            series2: '#00d4bd',
                            series3: '#826bf8',
                            series4: '#2b9bf4',
                            series5: '#FFA1A1'
                        },
                        area: {
                            series3: '#a4f8cd',
                            series2: '#60f2ca',
                            series1: '#2bdac7'
                        }
                    };

                // --------------------------------------------------------------------
                var areaChartEl = document.querySelector('#line-area-chart'),
                    areaChartConfig = {
                        chart: {
                            height: 400,
                            type: 'area',
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: false,
                            curve: 'straight'
                        },
                        legend: {
                            show: true,
                            position: 'top',
                            horizontalAlign: 'start'
                        },
                        grid: {
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
                        series: [
                            {
                                name: 'Total',
                                data: total
                            },
                            {
                                name: 'Sold',
                                data: sold
                            },
                            {
                                name: 'Tenanted',
                                data: tenanted
                            }
                        ],
                        xaxis: {
                            categories: days
                        },
                        fill: {
                            opacity: 1,
                            type: 'solid'
                        },
                        tooltip: {
                            shared: false
                        },
                        yaxis: {
                            opposite: isRtl
                        }
                    };
                if (typeof areaChartEl !== undefined && areaChartEl !== null) {
                    var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
                    areaChart.render();
                }
            });
        })
    </script>
@endpush
