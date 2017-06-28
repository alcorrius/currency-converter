function init(){
    $.ajax({
        url: 'currency/get-currency-list',
        type: 'GET',
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            $.each(response, function(key, value) {
                $('#currencyIn')
                    .append($("<option></option>")
                        .attr("value",key)
                        .text(value));
                $('#currencyOut')
                    .append($("<option></option>")
                        .attr("value",key)
                        .text(value));
            });
        },
        error: function () {
            console.log('error getting currencies');
        }
    });

    $.ajax({
        url: 'rates/get-last-update-time',
        type: 'GET',
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            $('#update-time')
                    .text(response);
        },
        error: function () {
            console.log('error getting date');
        }
    });

    $("#SwapButton").click(function(e) {
        var fromVal = $("#currencyIn option:selected").val();
        var toVal = $("#currencyOut option:selected").val();

        $("#currencyIn").val(toVal);
        $("#currencyOut").val(fromVal);
    });
    $("#convertButton").click(function(e) {
        var amount = $('#amount').val();
        if(amount) {
            $.ajax({
                url: '/converter/convert',
                type: 'GET',
                data: {
                    amount: amount,
                    currencyIn: $( "#currencyIn option:selected" ).text(),
                    currencyOut : $( "#currencyOut option:selected" ).text()
                },
                contentType: 'application/json; charset=utf-8',
                success: function (response) {
                    var count = $("#history div").length;
                    if(count == 5) {
                        $('#history div').last().remove();
                    }
                    $('#result div').first().prependTo("#history");
                    $('#result div').first().remove();
                    var node = document.createElement("DIV");
                    var textnode = document.createTextNode(response);
                    node.appendChild(textnode);
                    document.getElementById("result").appendChild(node);
                },
                error: function () {
                    console.log('convertion error');
                }
            });
        }
    });
}
