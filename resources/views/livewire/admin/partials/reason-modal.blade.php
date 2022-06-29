<div class="col-12" wire:ignore.self>
    <div class="card">
        <div class="card-header p-0">
            <!-- Vertical modal -->
            <div class="vertical-modal-ex">
                <!-- Modal -->
                <div class="modal fade" id="reasonModal" tabindex="-2"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Reason</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form wire:submit.prevent="closeRequirement">
                                <div class="modal-body">
                                    <div class="">
                                        <div class="">
                                            @foreach($reasons as $reason)
                                                <div class="form-check form-check-inline w-100 py-50">
                                                    <input class="form-check-input" type="radio"
                                                           wire:model.defer="status_reasons_id"
                                                           name="inlineRadioOptions"
                                                           id="{{$loop->iteration}}" value="{{$reason->id}}"/>
                                                    <label class="form-check-label"
                                                           for="{{$loop->iteration}}">{{$reason->title}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-outline-secondary waves-effect"
                                            data-bs-dismiss="modal" aria-label="Close">Close
                                    </button>
                                    <button type="submit"
                                            class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical modal end-->
        </div>
    </div>
</div>
