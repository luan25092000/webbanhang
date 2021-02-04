<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra đơn hàng</title>
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
            <div class="container mt-3">
                <div class="row check-order-container">
                    <div class="col-lg-10">
                        <small><a href="./index.php" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span class="introduce">Kiểm tra đơn hàng</span></small>
                        <h5 class="mt-3">KIỂM TRA ĐƠN HÀNG</h5>
                        <form action="" method="get">
                            <div class="form-group">
                                <label>Nhập mã đơn hàng</label>
                                <input type="number" placeholder="Mã số đơn hàng" name="cartId" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">XEM NGAY</button>
                        </form>
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