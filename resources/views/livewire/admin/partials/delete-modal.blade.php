<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>{{__('Delete Record')}}</h5>
            </div>

            <div class="modal-body">
                <h4>{{__('Are you sure you want to delete this record?')}}</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal" aria-label="Close">{{__('Close')}}
                </button>
                <button type="button" wire:click.prevent="destroy" class="btn btn-danger">{{__('Delete')}}</button>
            </div>
        </div>
    </div>
</div>
