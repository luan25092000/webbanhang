$(document).ready(function () {

    $(document.body).on('click', '.btn-success', function () {

        var order = '/admin/orders/' + $(this)[0].attributes["data-id"].nodeValue;

        $.ajax({
            url: order,
            method: 'GET',
            contentType: false,
            cache: true,
            processData: false,
            success: function (response) {  

                var order = JSON.parse(response)[0];

                $("[id='bodyShow']").empty();
                order.forEach(e => {
                    
                    var x = Number(e.price);
                    x = x.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});

                    i = $(`<tr>
                    
                    <td>${e.id}</td>
                    <td>${e.name}</td>
                    <td>${x}</td>
                    <td>${e.quantity}</td>

                    </tr>`);
                    $("[id='bodyShow']").append(i);
                });

            }

        });

    });

});