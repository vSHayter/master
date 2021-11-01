$('#bookingModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let roomId = button.data('booking-room');
    let roomType = button.data('room-type');
    let modal = $(this)
    modal.find('.form-group.field-booking-id_room > label').text(roomType)
    modal.find($('#booking-id_room')).val(roomId)
});