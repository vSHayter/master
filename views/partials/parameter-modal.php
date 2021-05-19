<?php

?>

<div class="modal parameters-modal" id="parametersModal" tabindex="-1" role="dialog" aria-labelledby="parametersModalTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable" role="document" >
        <div class="modal-content" >
            <div class="modal-header py-2">
                <h5 class="modal-title" id="parametersModalTitle">Travelers</h5>
            </div>
            <div class="modal-body py-2">
                <div class="travelers-parameter d-flex justify-content-between">
                    <div class="travelers-parameter-label">
                        <label>Travelers</label>
                    </div>
                    <div class="control-counter">
                        <button class="btn-number" data-type="minus" data-field="travelers">-</button>
                        <input type="text" class="count" name="travelers" min="1" max="15" value="<?= $values['travelers'] ?>" readonly>
                        <button class="btn-number" data-type="plus" data-field="travelers">+</button>
                    </div>
                </div>
                <div class="rooms-parameter d-flex justify-content-between">
                    <div class="rooms-parameter-label">
                        <label>Rooms</label>
                    </div>
                    <div class="control-counter">
                        <button class="btn-number" data-type="minus" data-field="room" disabled="disabled" >-</button>
                        <input type="text" class="count" name="room" min="1" max="10" value="<?= $values['room'] ?>" readonly>
                        <button class="btn-number" data-type="plus" data-field="room">+</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Done</button>
            </div>
        </div>
    </div>
</div>
