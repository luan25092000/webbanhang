$(document).ready(function () {

    $(document.body).on('click', '.btn-success', function () {

        var customersPath = '/admin/customers/' + $(this)[0].attributes["data-name"].nodeValue;

        $.ajax({
            url: customersPath,
            method: 'GET',
            contentType: false,
            cache: true,
            processData: false,
            success: function (response) {

                var response = JSON.parse(response);

                $("[class='modal-body']").empty();

                response.forEach((res, id) => {

                    console.log(id);

                    tableTop = $(`
                    <h4>${res[0].code}</h4>

                    <table class="table table-cus table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Promo</th>
                            </tr>
                        </thead>
                        <tbody id="bodyShow_${id}">
                    `);

                    $("[class='modal-body']").append(tableTop);

                    tableBottom = $(`
                        </tbody>
                    </table>
                    `);

                    res.forEach(e => {

                        var x = Number(e.price);
                        x = x.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });

                        i = $(`
                        <tr>
                            <td>${e.id}</td>
                            <td>${e.name}</td>
                            <td>${x}</td>
                            <td>${e.quantity}</td>
                            <td>${e.promotion}</td>
                        </tr>
                        `);

                        $(`[id='bodyShow_${id}']`).append(i);

                    });
                    $("[class='modal-body']").append(tableTop);

                    var x = Number(res[0].total - res[0].promotion + 25000);
                    x = x.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });

                    total = $(`
                        <hr class="d-block w-100">
                        <span><b>Tổng</b>: ${x}</span>
                    `)

                    $(`[id='bodyShow_${id}']`).append(total);
                });
            }

        });

    });

});