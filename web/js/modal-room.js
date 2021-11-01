$('#roomModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let roomId = button.data('room-id');

    $('#roomModal .modal-body').empty();

    $.ajax({
        type: 'post',
        url: '/room/index',
        data: {
            roomId: roomId
        },
        success: function(data){
            $('#roomModal .modal-body').html(data);
        }
    });

    let modal = $(this)
    modal.find($('#roomModal .modal-header')).addClass('container');
})