var searchTimeout;

$(document).ready(function() {
    $("#cityName").on('keyup', function() {
        var name = $('#cityName').val();

        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        searchTimeout = setTimeout(function() {
            if (name === "") {
                $("#display").html("");
            } else {
                $.ajax({
                    type: "POST",
                    url: "city/search",
                    data: {
                        search: name
                    },
                    success: function (response) {
                        $("#display").html(response).show();
                    }
                });
            }
        },500)
    });
});

function fillCityName(Value) {
    $('#cityName').val(Value);
    $('#display').hide();
}

function fillCityId(Value) {
    $('#cityId').val(Value);
    $('#display').hide();
}