$(function () {
    $("#parameters").click(function () {
        $("#parameters-modal").removeClass("hide").addClass("show");
    });
    $("#parameter-button").click(function () {
        $("#parameters-modal").removeClass("show").addClass("hide");
    });
});