$(document).ready(function () {

    function removeAccents(str) {
        var AccentsMap = [
          "aàảãáạăằẳẵắặâầẩẫấậ",
          "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
          "dđ", "DĐ",
          "eèẻẽéẹêềểễếệ",
          "EÈẺẼÉẸÊỀỂỄẾỆ",
          "iìỉĩíị",
          "IÌỈĨÍỊ",
          "oòỏõóọôồổỗốộơờởỡớợ",
          "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
          "uùủũúụưừửữứự",
          "UÙỦŨÚỤƯỪỬỮỨỰ",
          "yỳỷỹýỵ",
          "YỲỶỸÝỴ"    
        ];
        for (var i=0; i<AccentsMap.length; i++) {
          var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
          var char = AccentsMap[i][0];
          str = str.replace(re, char);
          str = str.replace(/\s/g, '');
        }
        return str;
      }

    $(document.body).on('change', '#form-select-filter', function () {

        var select = $( "select#form-select-filter option:checked" ).val();
        var productPath = '/product';
        var data = {filter: select};
        var key = $( "#key" ).val();
        if(key) {
            data["key"] = key;
        }
        
        $.ajax({
            url: productPath,
            method: 'POST',
            data:data,
            success: function (response) {
                $(".wrapper").html(response);
                $(`select#form-select-filter option[value=${select}]`).attr('selected', 'selected');
 
            }

        });

    });

    $(document.body).on('click', '.female-product', function () {

        var female = $(this).text();

        $.ajax({
            url: "/",
            method: 'POST',
            data:{filter: female, type: "female"},
            success: function (response) {
                
                var femaleClick = removeAccents(female);

                $(".wrapper").html(response);
                $(`a.female-product.nav-link.female-product.active`).removeClass("active");
                $(`#${femaleClick}`).addClass("active");
 
            }

        });

    });


    $(document.body).on('click', '.male-product', function () {

        var male = $(this).text();

        $.ajax({
            url: "/",
            method: 'POST',
            data:{filter: male, type: "male"},
            success: function (response) {
                
                var maleClick = removeAccents(male);

                $(".wrapper").html(response);
                $(`a.male-product.nav-link.male-product.active`).removeClass("active");
                $(`#${maleClick}`).addClass("active");
 
            }

        });

    });


});