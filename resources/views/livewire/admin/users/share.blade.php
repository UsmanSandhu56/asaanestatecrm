<div class="col-12" wire:ignore.self>
    <div class="card">
        <div class="card-header p-0">
            <!-- Vertical modal -->
            <div class="vertical-modal-ex">
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                    Share User Login Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-vertical">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-start social-share-btns">
                                                <a href="javascript:void(0)"
                                                   class="social-share-wa share__link--whatsapp">
                                                    <i class="fa fa-whatsapp share__link--whatsapp"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="social-share-en share__link--mail">
                                                    <i class="far fa-envelope share__link--mail"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                class="input-group input-group-merge mt-1 shadow">
                                                <input id="clip-text" type="text"
                                                       class="form-control search-product"
                                                       value="{{"Reset Your Password to Login: " . Request::root() . "/reset-password/" . $phone_no}}"/>
                                                <span
                                                    class="input-group-text tooltip-btn cursor-pointer"
                                                    data-clipboard-demo=""
                                                    data-clipboard-target="#clip-text"> <i
                                                        data-feather="copy"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-danger waves-effect"
                                        data-bs-dismiss="modal" aria-label="Close">{{__('Close')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical modal end-->
        </div>
    </div>
</div>
