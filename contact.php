<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
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
                <div class="row">
                    <div class="col-lg-9">
                        <small><a href="./index.php" class="text-dark">Trang chủ</a> <i class="fas fa-angle-double-right"></i> <span class="introduce">Liên hệ</span></small> 
                        <h4 class="mt-4"><span>THÔNG TIN LIÊN HỆ</span></h4>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <a href="./index.php"><img src="./img/logo/logo.png" alt="" width=200/></a>
                            </div>
                            <div class="col-lg-9">
                                <h5>NHÓM LẬP TRÌNH WEB</h5>
                                <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: Học viện kĩ thuật mật mã</p>
                                <p><i class="fas fa-phone-alt"></i> Điện thoại: (08) 89 810 3236</p>
                                <p><i class="fas fa-envelope-open"></i> Mail: nguyenhuuluan17@gmail.com</p>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">
                                 <h6 class="mt-4"><span>GỬI THÔNG TIN LIÊN HỆ</span></h6>
                                 <small><p>Xin vui lòng điền các yêu cầu vào mẫu dưới đây và gửi cho chúng tôi. Chúng tôi sẽ trả lời bạn ngay sau khi nhận được. Xin chân thành cảm ơn!</p></small>
                            </div>
                            <div class="col-lg-6">
                                <form action="" method="get">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Họ tên" id="username" name="username">
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Địa chỉ" id="address" name="address">
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Điện thoại" id="phone" name="phone">
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pager"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tiêu đề" id="title" name="title    ">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Nội dung" id="comment"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.137209327497!2d106.65496261411663!3d10.800801561698355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752937159dbd15%3A0x286f2a16b253c64b!2zSOG7jWMgVmnhu4duIEvhu7kgVGh14bqtdCBN4bqtdCBNw6M!5e0!3m2!1svi!2s!4v1612410249811!5m2!1svi!2s" width="400" height="320" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h5 class="mt-4"><span>HỖ TRỢ TRỰC TUYẾN</span></h5>
                        <p>Hotline: (08) 89 810 3236</p>
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