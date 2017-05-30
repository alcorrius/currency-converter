function init(){
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
                        $('#history div').first().remove();
                    }
                    $('#result div').first().appendTo("#history");
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