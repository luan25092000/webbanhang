<?php
    require_once('Connect.php');
    if($_POST['districtId'] == ""){
        echo "<option value=''>--Chọn xã/phường--</option>";
    }
    $sql = "SELECT * FROM `devvn_xaphuongthitran` WHERE `maqh`=".$_POST['districtId'];
    $result = $conn->query($sql);
    $rows = array();
       if ( $result !== false && $result->num_rows > 0) {
           // output dữ liệu trên trang
           while($row = $result->fetch_assoc()) {
               echo "<option value='".$row['xaid']."'>".$row['name']."</option>";
           }
    }