<?php require 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="./css/pc.css" media="all" />
    <link rel="stylesheet" href="./css/tablet.css" media="all and (max-width:1024px) and (min-width:768px)" />
    <link rel="stylesheet" href="./css/mobile.css" media="all and (max-width:767px)" />
    <!-- Title -->
    <link rel="shortcut icon" type="image/png" href="./img/favicon.ico" />
    <!-- Owl carousel -->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.css">
</head>

<body>
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-lg-3">
                    <div class="menu-about">
                        <h4>
                            <span>
                                Chính sách bán hàng
                            </span>
                        </h4>
                        <ul class="box-sales-policy">
                            <li>
                                <span>1</span>Giao hàng TOÀN QUỐC
                            </li>
                            <li>
                                <span>2</span>Thanh toán khi nhận hàng
                            </li>
                            <li>
                                <span>3</span>Đổi trả trong
                                <span class="color-pink">15 ngày</span>
                            </li>
                            <li>
                                <span>4</span>Hoàn ngay tiền mặt
                            </li>
                            <li>
                                <span>5</span>Chất lượng đảm bảo
                            </li>
                            <li>
                                <span>6</span>Miễn phí vận chuyển:
                                <span class="color-pink">Đơn hàng từ 3 món trở lên</span>
                            </li>
                        </ul>
                        <div class="buy-guide">
                            <h3>Hướng Dẫn Mua Hàng</h3>
                            <ul class="buy-guide-policy">
                                <li>
                                    <span>1</span>Mua hàng trực tiếp tại website
                                    <b>http://www.runtime.vn</b>
                                </li>
                                <li>
                                    <span>2</span>Gọi điện thoại
                                    <b class="color-pink">033 918 1998</b> để mua hàng
                                </li>
                                <li>
                                    <span>3</span>Mua tại Trung tâm CSKH:
                                    <b class="color-pink">5/12A Quang Trung, P.14, Q.Gò Vấp, Tp.HCM</b>
                                </li>
                                <li>
                                    <span>4</span>Mua sỉ/buôn xin gọi
                                    <b>0908 77 00 95</b> để được hỗ trợ.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-about">
                        <h4>
                            <span>
                                SẢN PHẨM HOT
                            </span>
                        </h4>
                        <div class="row">
                            <?php
                            $sql = "SELECT * FROM product WHERE sex = 'Nữ'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0)
                                while($row = mysqli_fetch_assoc($result)):
                            ?>
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-image">
                                        <a href="./product-detail.php?id=<?= $row['id'] ?>">
                                            <img src=<?= $row['imgPath'] ?> class="card-img-top" alt="<?= $row['title'] ?>" />
                                        </a>
                                    </div>
                                </div>
                                <div class="box-product-block">
                                    <div class="name text-center">
                                        <a href="./product-detail.php?id=<?= $row['id'] ?>" title="<?= $row['title'] ?>">
                                            <b><?= $row['title'] ?></b>
                                        </a>
                                    </div>
                                </div>
                                <div class="price text-center">
                                    <span class="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫</span>
                                    <span class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span>
                                </div>
                                <div class="btn-buy text-center">
                                    <button class="btn btn-default">Mua ngay</button>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <small><a href="./index.php" class="text-dark">Trang chủ</a> <i
                            class="fas fa-angle-double-right"></i> <a href="./index.php" class="text-dark">Sản phẩm</a>
                        <i class="fas fa-angle-double-right"></i> <span class="introduce">Chi tiết sản
                            phẩm</span></small>
                    <div class="row mt-4">
                        <?php
                        $sql = "SELECT * FROM product WHERE id = ".$_GET['id'];
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0)
                            while($row = mysqli_fetch_assoc($result)):
                        ?>
                        <div class="col-md-6 sp-large">
                            <a href="./product-detail.php?id=<?= $row['id'] ?>"><img src=<?= $row['imgPath'] ?> alt="<?= $row['title'] ?>"></a>
                        </div>
                        <div class="col-md-6 describe">
                            <h2 class="ng-binding"><?= $row['title'] ?></h2>
                            <div class="price">
                                <span class="price-new ng-binding"><?= number_format($row['price'], 0, '', ',') ?>₫</span>
                                <span class="price-old ng-binding"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span>
                            </div>
                            <span class="product-code ng-binding"><b>Mã SP:</b> </span>
                            <p class="describe-detail">
                                <?= $row['title'] ?> – Kiểu Dáng Thời Trang, Chất Liệu Tơ Gân Mềm Mịn, Gam Màu
                                Tươi Tắn – Mang Đến Vẻ Ngoài Trẻ Trung, Duyên Dáng Cho Bạn Gái. Giá <?= number_format($row['priceOld'], 0, '', ',') ?>₫, Còn
                                <?= number_format($row['price'], 0, '', ',') ?>₫, Giảm 40%.&nbsp;</p>
                            <iframe
                                src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fluankma&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=415196006363533"
                                width="450" height="35" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            <div class="quantity-input">
                                <h5>Số lượng</h5>
                                <input style="width:20%;" type="number" value="1"
                                    class="text ng-valid ng-dirty ng-valid-number ng-touched" ng-model="InputQuantity"
                                    ng-init="InputQuantity=1" name="qty">
                            </div>
                            <div class="btn-buy mt-4">
                                <button class="btn btn-add-to-cart"><i class="fas fa-shopping-cart"></i>Thêm vào giỏ
                                    hàng</button>
                                <button class="btn btn-buynow"><i class="fas fa-check"></i>Mua ngay</button>
                            </div>

                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-md-12">
                        <div class="menu-about">
                            <h4>
                                <span>
                                    Chi tiết sản phẩm
                                </span>
                            </h4>
                            <div class="content-describe">
                                - Áo công sở được thiết kế đơn giản, nhưng không kém phần tinh tế, với form áo vừa vặn,
                                cổ bẻ, điểm nhấn ở phần tay búp sen được may cách điệu, đẹp mắt. <br />
                                Điểm nổi bật
                                - Chất liệu tơ gân mềm mịn, thông thoáng và thấm hút mồ hôi tốt, nên tạo được cảm giác
                                thoải mái cho người mặc
                                - Ba gam màu: hồng, xanh, trắng tươi tắn, trẻ trung, rất dễ để kết hợp với chân váy công
                                sở, quần tây, jeans,… tạo vẻ ngoài chỉn chu khi đi làm. <br>
                                - Trọng lượng gói hàng cả bao bì: 150 gram <br>

                                Điều kiện <br>
                                - Hotdeal giao sản phẩm theo màu đến tận tay khách hàng. <br>
                                + Đối với khu vực TP.HCM: Miễn phí. <br>
                                + Đối với các tỉnh thành khác: Chuyển phát nhanh theo phí bưu điện. <br>
                                - Áp dụng cho Áo công sở tay búp sang trọng <br>
                                - Màu sắc: hồng, xanh, trắng <br>
                                - Kích cỡ: Freesize <br>
                                - Thời gian cuối giao sản phẩm đến hết 23/05/2015, không giao sản phẩm ngày chủ nhật.
                                <br>
                                - Khách hàng không bù thêm tiền khi nhận sản phẩm. <br>
                                - Khách hàng vui lòng kiểm tra sản phẩm trước khi nhận hàng, Hotdeal không chịu trách
                                nhiệm đổi trả sản phẩm sau khi giao hàng. <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Owl carousel -->
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>