$(document).ready(function () {

    $(document.body).on('click', '.btn-info', function () {

        var categoryId = '/admin/promotions/' + $(this)[0].attributes[1].nodeValue;

        $.ajax({
            url: categoryId,
            method: 'GET',
            contentType: false,
            cache: true,
            processData: false,
            success: function (response) {

                var promotion = JSON.parse(response).message[0];
                var status = JSON.parse(response).status;

                if (status) {
                    $("input[name='title']").val(promotion.title);
                    $("input[name='code']").val(promotion.code);
                    $("input[name='price']").val(promotion.price);
                    $("input[name='quantity']").val(promotion.quantity);
                    $("input[name='edit_promotion']").val(promotion.id);
                }
            }

        });

    });

});