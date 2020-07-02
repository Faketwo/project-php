<?php

require_once('./checkAdmin.php'); //引入登入判斷
require_once('../db.inc.php'); //引用資料庫連線

//刪資料庫語法


$sql = "DELETE FROM `map_info` WHERE `map_infoId` = ? ";

$count = 0;


for( $i = 0 ; $i < count($_POST['chk']) ; $i++){
    
    $arrParam = [
        $_POST['chk'][$i]
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $count += $stmt->rowCount();

}


if($count > 0) {
    header("Refresh: .5; url=./map_info.php");
    $answer= "刪除成功";
    require_once('../loading.php');
    // echo "刪除成功";
} else {
    header("Refresh: .5; url=./map_info.php");
    $answer= "刪除失敗";
    require_once('../loading.php');
    // echo "刪除失敗";
}

?>