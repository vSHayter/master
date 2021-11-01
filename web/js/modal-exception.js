$('#exceptionModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let type = button.data('type');
    let body;

    if(type === 'warning') {
        body = 'Sign in to do this.'
    } else {
        body = 'To leave a review about this hotel, you need to book a room in it.';
    }

    let modal = $(this)
    modal.find($('#exceptionModal .modal-body')).text(body)
});

