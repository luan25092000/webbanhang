$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('#scrollback').fadeIn();
        } else {
            $('#scrollback').fadeOut();
        }
    })
    $('#scrollback').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 600);
    });
    $('#country').change(function (e) {
        $countryId = $(this).val();
        $.post("../../ajax/District.php", { "countryId": $countryId }, function (data) {
            $('#district').append(data);
        });
    });
    $('#district').change(function (e) {
        $districtId = $(this).val();
        $.post("../../ajax/Commune.php", { "districtId": $districtId }, function (data) {
            $('#commune').append(data);
        });
    });

    // Add product to cart ajax event
    let addToCartForms = document.querySelectorAll("form.add-to-cart");
    for (let i = 0; i < addToCartForms.length; i++) {
        addToCartForms[i].addEventListener("submit", function (e) {
            // Prevent submit
            e.preventDefault();
            // Set loading for submit button
            let btnSubmit = addToCartForms[i].querySelector(":scope button[type='submit']");
            let oldValue = $(btnSubmit).html();
            $(btnSubmit).html(`<div class="spinner-border" role="status"></div>`);
            // Send request
            $.ajax({
                type: "POST",
                url: "/api/v1/cart",
                data: $(this).serialize(),
                dataType: "json",
            }).done(function (data) {
                if (data.status) {
                    window.location.href = "/cart";
                } else {
                    displayMessageModal(data.message, "danger");
                }
            }).fail(function (err) {
                displayMessageModal("Có lỗi xảy ra", "danger");
            }).always(function() {
                // Restore old value of submit button
                $(btnSubmit).html(oldValue);
            });
        });
    }
});

function displayMessageModal(message, type = "light") {
    $('#messageModal-message').html(message);
    $('#messageModal-alert').addClass("alert-" + type);
    $('#messageModal').modal('show');
}