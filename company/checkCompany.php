<?php

$getproductId = (int)$_GET['productId'];
$sqlCompany = "SELECT `companyId` FROM `product`
               WHERE `productId` = '$getproductId'";
@$stmtCompany = $pdo->prepare($sqlCompany);
@$stmtCompany->execute();
@$arrCompany = $stmtCompany->fetchAll(PDO::FETCH_ASSOC)[0];
// echo @$arrCompany['companyId'];

if($_SESSION['Id'] !== @$arrCompany['companyId']){
    header("Refresh: 1; url=./admin2.php");
    ?>

    <style>
    body{
        background: black;
        color: white;
        font-size: 2rem;
    }
    .img {
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%, -50%);
    }
    .img img{
        width:400px;
        filter:grayscale(100%);
    }
    </style>
    <body>
    您無權使用該網頁…1秒後自動回商品列表
    <div class="img">
    <img src="https://i.imgur.com/VefdvoR.jpg" alt="">
    </div> 
    </body>

    <?php
    exit();

}