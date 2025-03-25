<!-- Santiago-->
<div class='modal fade' id='discountModal' tabindex='-1' aria-labelledby='discountModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content text-center'>
            <div class='modal-header'>
                <h5 class='modal-title'>{{__('order/partials/discount-wheel.spinning_message')}}</h5>
            </div>
            <div class='modal-body'>
                <div class='wheel-container'>
                    <div class='wheel' id='wheel'></div>
                </div>
                <button id='spinButton' class='btn btn-primary mt-3'>{{ __('order/partials/discount-wheel.button') }}</button>
                <p id='discountResult' class='mt-3'></p>
            </div>
        </div>
    </div>
</div>