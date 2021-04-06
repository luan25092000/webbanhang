<?php
    require_once('Connect.php');
    $servername = "mysql";
    $username = "root";
    $password = "kaito";
    $dbname = "shop";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if($_POST['countryId'] == ""){
        echo "<option value=''>--Chọn quận/huyện--</option>";
    }
    $sql = "SELECT * FROM `devvn_quanhuyen` WHERE `matp`=".$_POST['countryId'];
    $result = $conn->query($sql);
    $rows = array();
       if ( $result !== false && $result->num_rows > 0) {
           // output dữ liệu trên trang
           while($row = $result->fetch_assoc()) {
               echo "<option value='".$row['maqh']."'>".$row['name']."</option>";
           }
    }