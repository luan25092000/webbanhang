$(document).ready(function () {

    $(document.body).on('click', '.btn-info', function () {

        var productId = '/admin/products/' + $(this)[0].attributes[1].nodeValue;

        $.ajax({
            url: productId,
            method: 'GET',
            contentType: false,
            cache: true,
            processData: false,
            success: function (response) {

                var product = JSON.parse(response).message[0];
                var status = JSON.parse(response).status;

                if (status) {
                    $("input[name='title']").val(product.title);
                    $("input[name='quantity']").val(product.quantity);
                    $("input[name='price']").val(product.price);
                    $("input[name='edit_product']").val(product.id);
                    $("select[name='sex']").val(product.sex);
                    $("select[name='catId']").val(product.catId);
                    $("[name='imagePath']").val(product.imgPath);
                    $("[name='imagePath']").empty();
                    i = $('<img/>', { src: product.imgPath, class: "img-product" });
                    $("[name='imagePath']").append(i);
                }
            }

        });

    });

    $(document.body).on('click', '.btn-danger', function () {

        var id = $(this)[0].attributes[0].nodeValue;

        var productId = '/admin/products';

        $.ajax({

            url: productId,
            method: 'POST',
            data:{delete: id},
            // contentType: false,
            // cache: true,
            // processData: false,
            success: function (response) {

                console.log(response);

                // var product = JSON.parse(response).message[0];
                // var status = JSON.parse(response).status;

                // console.log(product.sex);

                // if (status) {
                //     $("input[name='title']").val(product.title);
                //     $("input[name='quantity']").val(product.quantity);
                //     $("input[name='price']").val(product.price);
                //     $("input[name='edit_product']").val(product.id);
                //     $("select[name='sex']").val(product.sex);
                //     $("select[name='catId']").val(product.catId);
                //     $("[name='imagePath']").val(product.imgPath);
                //     $("[name='imagePath']").empty();
                //     i = $('<img/>', { src: product.imgPath, class: "img-product" });
                //     $("[name='imagePath']").append(i);
                // }
            }

        });

    });

});