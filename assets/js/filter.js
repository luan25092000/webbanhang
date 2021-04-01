$(document).ready(function () {

    $(document.body).on('change', '#form-select-filter', function () {

        var select = $( "select#form-select-filter option:checked" ).val();

        var productPath = '/product';

        $.ajax({
            url: productPath,
            method: 'POST',
            data:{filter: select},
            success: function (response) {
                $(".wrapper").html(response);
                // $("select#form-select-filter");
                $(`select#form-select-filter option[value=${select}]`).attr('selected', 'selected');
 
                // Or just...
                // $("#myselect").val(3);
            }

        });

    });

});