<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">{{ __('order/partials/confirm-modal.question') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            {{ __('order/partials/confirm-modal.confirmation') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('order/partials/confirm-modal.no_button') }}</button>
                <button type="button" class="btn btn-success" id="confirmYesBtn">{{ __('order/partials/confirm-modal.yes_button') }}</button>
            </div>
        </div>
    </div>
</div>
