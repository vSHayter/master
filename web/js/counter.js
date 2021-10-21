$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());

    if (!isNaN(currentVal)) {
        if (type == 'minus') {
            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr('min'))
                $(this).attr('disabled', true);
            if (fieldName == 'travelers') {
                $("#travelers").val(parseInt(input.val()))
                $("#travelersSpan").text(input.val() + ' travelers')
            } else {
                $("#room").val(parseInt(input.val()))
                $("#roomSpan").text(input.val() + ' rooms')
            }
        } else if (type == 'plus') {
            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max'))
                $(this).attr('disabled', true);
            if (fieldName == 'travelers') {
                $("#travelers").val(parseInt(input.val()))
                $("#travelersSpan").text(input.val() + ' travelers')
            } else {
                $("#room").val(parseInt(input.val()))
                $("#roomSpan").text(input.val() + ' rooms')
            }
        }
    }
});

$('.count').change(function() {
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue)
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    if(valueCurrent <= maxValue)
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
});
