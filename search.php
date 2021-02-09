<?php require_once("./api/v1/products.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
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
        <div class="container mt-3 mb-3">
            <div class="row mb-4">
                <div class="col-lg-3 col-md-12">
                    <div class="menu-news">
                        <h5 class="new-title">SẢN PHẨM</h5>
                        <ul>
                            <li><i class="fas fa-arrow-circle-right"></i> <a href="./female-product.php">THỜI TRANG
                                    NỮ</a></li>
                            <hr />
                            <li><i class="fas fa-arrow-circle-right"></i> <a href="./male-product.php">THỜI TRANG
                                    NAM</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="row ml-4">
                        <?php 
                        $key = $_GET['key'];
                        $rows = ProductAPI::getProductByKey("$key");
                        foreach($rows->message as $row):
                    ?>
                        <div class="col-md-3 mb-4">
                            <form action="" method="post">
                                <div class="product-item-box">
                                    <div class="product-item">
                                        <div class="image-search">
                                            <a href="./product-detail.php?id=<?= $row['id'] ?>">
                                                <img src="<?= $row['imgPath'] ?>" alt="<?= $row['title'] ?>"
                                                    width="100%" height="100%" name="product-image"
                                                    class="product-image" />
                                            </a>
                                            <a href="./product-detail.php?id=<?= $row['id'] ?>" class="more-info-search"><i
                                                    class="fas fa-search"></i> XEM THÊM</a>
                                        </div>
                                        <a href="./product-detail.php?id=<?= $row['id'] ?>" class="product-name-search mt-4"><?= $row['title'] ?></a>
                                        <div class="price-new" name="price-new">
                                            <?= number_format($row['price'], 0, '', ',') ?>₫ <span
                                                class="price-old"><?= number_format($row['priceOld'], 0, '', ',') ?>₫</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="price" value="<?= $row['price'] ?>" />
                                <input type="hidden" name="title" value="<?= $row['title'] ?>" />
                                <input type="hidden" name="quantity" value="<?= $row['quantity'] ?>" />
                                <div class="col text-center">
                                    <button type="submit" class="buy" name="buy"><i class="fas fa-shopping-cart"></i>
                                        Mua</button>
                                </div>
                            </form>
                        </div>
                        <?php endforeach; ?>
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