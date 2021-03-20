$(document).ready(function () {

    $(document.body).on('click', '.btn-info', function () {

        var categoryId = '/admin/categories/' + $(this)[0].attributes[1].nodeValue;

        $.ajax({
            url: categoryId,
            method: 'GET',
            contentType: false,
            cache: true,
            processData: false,
            success: function (response) {

                var category = JSON.parse(response).message[0];
                // console.log(response);
                var status = JSON.parse(response).status;

                if (status) {
                    $("input[name='title']").val(category.title);
                    $("input[name='slug']").val(category.slug);
                    $("input[name='content']").val(category.content);
                    $("input[name='edit_category']").val(category.id);
                }
            }

        });

    });

});