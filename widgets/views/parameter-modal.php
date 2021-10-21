<div class="parameters-modal hide" id="parameters-modal" >
    <div class="modal-content">
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
                    <input type="text" class="count" name="travelers" min="1" max="30" value="<?= $travelers ?>" readonly>
                    <button class="btn-number" data-type="plus" data-field="travelers">+</button>
                </div>
            </div>
            <div class="rooms-parameter d-flex justify-content-between">
                <div class="rooms-parameter-label">
                    <label>Rooms</label>
                </div>
                <div class="control-counter">
                    <button class="btn-number" data-type="minus" data-field="room" disabled="disabled" >-</button>
                    <input type="text" class="count" name="room" min="1" max="15" value="<?= $room ?>" readonly>
                    <button class="btn-number" data-type="plus" data-field="room">+</button>
                </div>
            </div>
        </div>
        <div class="modal-footer py-2">
            <button type="button" class="btn btn-primary btn-block" id="parameter-button">Done</button>
        </div>
    </div>
</div>