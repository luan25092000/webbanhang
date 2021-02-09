<?php require_once("./api/v1/products.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thời trang nữ</title>
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
            <small><a href="./index.php" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span
                    class="introduce">Thời trang nữ</span></small>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="menu-about">
                        <h4>
                            <span>
                                THỜI TRANG NỮ
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <span>Sản phẩm/ trang </span><select class="form-select">
                        <option selected>12</option>
                        <option value="1">20</option>
                        <option value="2">50</option>
                        <option value="3">100</option>
                    </select>
                </div>
                <div class="col-md-6 text-right">
                    <span>Sắp xếp </span><select class="form-select">
                        <option selected>Mặc định</option>
                        <option value="1">Giá giảm dần</option>
                        <option value="2">Giá tăng dần</option>
                        <option value="3">Tên sản phẩm A - Z</option>
                        <option value="4">Tên sản phẩm Z - A</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <?php $rows = ProductAPI::getBySex('Nam');
                    foreach($rows->message as $row):
                ?>
                <div class="col-lg-3 mt-3">
                    <form action="" method="get">
                        <div class="product-item-box">
                            <div class="product-item">
                                <div class="image">
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>">
                                        <img src="<?= $row['imgPath'] ?>" alt="2" width="100%" height="100%"
                                            class="product-image product-image360" />
                                    </a>
                                    <a href="./product-detail.php?id=<?= $row['id'] ?>" class="more-info"><i class="fas fa-search"></i> XEM
                                        THÊM</a>
                                    <div class="discount">-10%</div>
                                </div>
                                <a href="./product-detail.php?id=<?= $row['id'] ?>" class="product-name mt-4" name="product-name"><?= $row['title'] ?></a>
                                <div class="price-new" name="price-new"><?= number_format($row['price'], 0, '', ',') ?>₫<span class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center mt-3">
                            <button class="btn btn-buy-product" type="submit"><i
                                    class="fas fa-shopping-cart mr-2"></i>Mua</button>
                        </div>
                    </form>

                </div>
                <?php endforeach; ?>
            </div>
            <?php include 'footer.php'; ?>
        </div>

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