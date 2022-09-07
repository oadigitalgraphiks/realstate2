<!-- delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{translate('Delete Confirmation')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mt-1">{{translate('Are you sure to delete this?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                <a  href="" type="button" id="delete-link" class="btn btn-danger">{{ translate('Delete!') }}</a>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

