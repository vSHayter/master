let searchTimeout;

$(document).ready(function() {
    $("#cityName").on('keyup', function() {
        let name = $('#cityName').val();

        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        searchTimeout = setTimeout(function() {
            if (name === "") {
                $("#display").html("");
            } else {
                $.ajax({
                    type: "POST",
                    url: location.origin + "/city/search",
                    data: {
                        search: name
                    },
                    success: function (response) {
                        $("#display").html(response);
                    }
                });
            }
        },500)
    });
});

$(document).on('click', function (e) {
    if ($(e.target).closest("#display").length === 0) {
        $("#display").hide();
    }
});

function fillCityName(Value) {
    $('#cityName').val(Value);
    $('#display').hide();
}

function fillCityId(Value) {
    $('#cityId').val(Value);
    $('#display').hide();
}

