<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('../db.inc.php'); //引用資料庫連線
?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>編輯文章類別</title>
    <style>
    /* button mainColor*/
    .btn-mainColor {
    color: #fff !important;
    background-color: #8f8681 !important;
    border-color: #8f8681 !important;
    }
    .btn-mainColor:hover {
    color: #fff !important;
    background-color: #A47F6A !important;
    border-color: #A47F6A !important;
    }
    .border {
        border: 1px solid;
    }
    img.itemImg {
        width: 250px;
    }
    tr th {
        text-align: center;
    }
    </style>
</head>
<?php require_once('./templates/title.php'); ?>
<?php require_once('./templates/sidebar.php'); ?>
<?php require_once('./templates/title_article_column.php'); ?>
<body>
    <form name="myForm" method="POST" action="articleUpdateCategory.php">
        <table class="border">
            <thead>
                <tr>
                    <th class="border">文章類別名稱</th>
                    <th class="border">新增時間</th>
                    <th class="border">更新時間</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //SQL 敘述
            $sql = "SELECT `article_categories`.`categoryId`, `article_categories`.`categoryName`, `article_categories`.`created_at`, `article_categories`.`updated_at`
                    FROM  `article_categories`
                    WHERE `article_categories`.`categoryId` = ? ";

            $arrParam = [
                (int)$_GET['editCategoryId']
            ];

            //查詢
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            //資料數量大於 0，則列出相關資料
            if($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <tr>
                    <td class="border">
                        <input type="text" name="categoryName" value="<?php echo $arr[0]['categoryName']; ?>" maxlength="100" />
                    </td>
                    <td class="border"><?php echo $arr[0]['created_at']; ?></td>
                    <td class="border"><?php echo $arr[0]['updated_at']; ?></td>
                </tr>
            <?php
            } else {
            ?>
                <tr>
                    <td colspan="3">沒有資料</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                <?php if($stmt->rowCount() > 0){ ?>
                    <td class="border" colspan="3"><input type="submit" class="btn btn-mainColor btn-sm" name="smb" value="修改類別"></td>
                <?php } ?>
                </tr>
            </tfoo>
        </table>
        <input type="hidden" name="editCategoryId" value="<?php echo (int)$_GET['editCategoryId']; ?>">
    </form>
</body>
</html>