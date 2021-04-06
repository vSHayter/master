jQuery(function($) {
    like();
});

function like() {
    $(document).on('click', '.like', (e) => {
        e.preventDefault();
        var id = $(e.target).data('id');

        $.ajax({
            type: "POST",
            url: "/user/like",
            data: {
                id: id
            },
            success: function (response) {
                $('.like[data-id=' + id + ']').toggleClass("btn btn-danger");
            }
        });
    });
}
