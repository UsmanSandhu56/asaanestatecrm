@section('title', 'Confirm Deal')
<div>
    <div class="ecommerce-application auto-match-page close-d-deal auto-match-open-page">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-sm-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-2 border-0 fw-bolder fs-1">{{__('Preview')}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="print-ty-bor">
                <div class="content-body row">
                    <div class="col-md-6 col-6 close-border">
                        <h2 class="content-header-title mb-2 border-0"><i
                                class="fa fa-star"></i> {{__('Property Details')}}</h2>
                        <div class="match-amenities">
                            <div class="row">
                                <h4 class="text-primary fw-bolder prop-title-h">{{$propertyDeal->property->title}}</h4>
                                <div class="col-md-6 col-12">
                                    <div class="match-utilities">
                                        <p>{{$propertyDeal->property->area}}
                                            | {{$propertyDeal->property->subCategory->name}}
                                            | {{$propertyDeal->property->address->location}}</p>
                                        <h5>{{__('Demand')}}</h5>
                                        <ul class="p-0" style="list-style:none;">
                                            <li class="fw-bolder text-primary fs-4 prop-title-h">{{$propertyDeal->property->price}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 content-right-det">
                        <h2 class="content-header-title mb-2 border-0"><i
                                class="fa fa-star"></i> {{__('Property Requirements')}}
                        </h2>
                        <div class="match-amenities">
                            <div class="row">
                                <h4 class="text-primary fw-bolder prop-title-h">{{$propertyDeal->propertyRequirement->title}}</h4>
                                <div class="col-md-6 col-12">
                                    <div class="match-utilities">
                                        <h4>{{__('Plot:')}} <span
                                                class="fs-5">{{$propertyDeal->propertyRequirement->subCategory->name}}</span>
                                        </h4>
                                        <h4>{{__('Location:')}} <span
                                                class="fs-5">{{$propertyDeal->propertyRequirement->propertyRequirementDetail->location}}</span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="match-facing">
                                        <h4>{{__('Budget')}}: <span
                                                class="fs-5">{{$propertyDeal->propertyRequirement->min_price .' - '. $propertyDeal->propertyRequirement->min_price}} </span>
                                        </h4>
                                        <h4>{{__('Area:')}} <span
                                                class="fs-5">{{$propertyDeal->propertyRequirement->min_area . ' - ' . $propertyDeal->propertyRequirement->max_area}}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body row">
                    <div class="col-md-6 col-6">
                        <div class="card-body cntct-card-det pe-5">
                            <h3 class="mb-75">{{__('Seller')}}</h3>

                            <div class="mt-1 prof-img-set">
                                <!-- <div class="prof-img">
                                    <img src="{{asset('app-assets/images/avatars/12-small.png')}}">
                                </div> -->
                                <div class="prof-img-det">
                                    <p class="card-text cntct-card-name">{{$propertyDeal->property->customer->name}}</p>
                                    <a href="#" class="card-text"><i
                                            class="fa fa-envelope"></i> {{$propertyDeal->property->customer->email}}
                                    </a><br>
                                    <a href="#" class="card-text"><i
                                            class="fa fa-map-marker"></i> {{$propertyDeal->property->address->location}}
                                    </a>
                                </div>
                            </div>
                            <div class="am-cntct-phn">
                                <a href="#"><i class="fa fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 content-right-det">
                        <div class="card-body cntct-card-det pe-5 cntct-card-buyer">
                            <h3 class="mb-75">{{__('Buyer')}}</h3>
                            <div class="mt-1 prof-img-set">
                                <!-- <div class="prof-img">
                                    <img src="{{asset('app-assets/images/avatars/12-small.png')}}">
                                </div> -->
                                <div class="prof-img-det">
                                    <p class="card-text cntct-card-name">{{$propertyDeal->propertyRequirement->customer->name}}</p>
                                    <a href="#" class="card-text"><i
                                            class="fa fa-envelope"></i> {{$propertyDeal->propertyRequirement->customer->email}}
                                    </a><br>
                                    <a href="#" class="card-text"><i
                                            class="fa fa-map-marker"></i> {{$propertyDeal->propertyRequirement->propertyRequirementDetail->location}}
                                    </a>
                                </div>
                            </div>
                            <div class="am-cntct-phn">
                                <a href="#"><i class="fa fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 deal-det-show">
                        <h2 class="content-header-title mb-2 border-0"><i class="fa fa-star"></i> {{__('Deal Details')}}
                        </h2>
                        <div class="mb-1">
                            <h3>{{__('Amount')}} </h3> {{__('PKR')}}- <span>{{$propertyDeal->amount}}</span>
                        </div>
                        <div class="mb-1">
                            <h3>{{__('Agency Commission')}} </h3> {{__('PKR')}}-
                            <span>{{$propertyDeal->agency_commission}}</span>
                        </div>
                        <div class="mb-1">
                            <h3>{{__('Agent Commission')}} </h3> {{__('PKR')}}-
                            <span>{{$propertyDeal->agent_commission}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 mx-auto text-center mb-1">
                    <button wire:click="store" id="anim-btn" class="btn btn-warning fw-bolder fs-3 w-100">{{__('Confirm & Submit')}}
                    </button>
                </div>
                <div class="col-12 col-sm-6 mx-auto text-center">
                    <a class="btn btn-outline-secondary w-100 fs-3 mb-75"
                       href="{{ url()->previous() }}"> {{__('Back')}} </a>
                </div>
            </div>
        </div>
    </div>
    <div id="congrats-animation">
        <div class="js-container container"></div>
        <div
            style="text-align:center;position:fixed;width:100%;height:100%;top:calc(50% - 180px);;left:0px;z-index: 11111;">
            <div class="checkmark-circle">
                <div class="background"></div>
                <div class="checkmark draw"></div>
            </div>
            <h1>{{__('Congratulations!')}}</h1>
            <p>{{__('On closing the deal you have recieved')}}<br> <span class="fw-bolder text-primary fs-4">{{$propertyDeal->agent_commission}}</span>
                {{__('commission.')}}</p>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        const Confettiful = function (el) {
            this.el = el;
            this.containerEl = null;

            this.confettiFrequency = 3;
            this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E', '#EFFF1D'];
            this.confettiAnimations = ['slow', 'medium', 'fast'];

            this._setupElements();
            this._renderConfetti();
        };

        Confettiful.prototype._setupElements = function () {
            const containerEl = document.createElement('div');
            const elPosition = this.el.style.position;

            if (elPosition !== 'relative' || elPosition !== 'absolute') {
                this.el.style.position = 'relative';
            }

            containerEl.classList.add('confetti-container');

            this.el.appendChild(containerEl);

            this.containerEl = containerEl;
        };

        Confettiful.prototype._renderConfetti = function () {
            this.confettiInterval = setInterval(() => {
                const confettiEl = document.createElement('div');
                const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
                const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
                const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
                const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];

                confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
                confettiEl.style.left = confettiLeft;
                confettiEl.style.width = confettiSize;
                confettiEl.style.height = confettiSize;
                confettiEl.style.backgroundColor = confettiBackground;

                confettiEl.removeTimeout = setTimeout(function () {
                    confettiEl.parentNode.removeChild(confettiEl);
                }, 3000);

                this.containerEl.appendChild(confettiEl);
            }, 25);
        };

        window.confettiful = new Confettiful(document.querySelector('.js-container'));
    </script>
    <script type="text/javascript">

        $("#anim-btn").click(function () {
            $('#congrats-animation').css('display', 'block');
            setTimeout(function () {
                $('#congrats-animation').css('display', 'none');
            }, 3000);
        });

    </script>
@endpush
