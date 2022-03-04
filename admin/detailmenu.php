<html>
    <head>
        <title>Bài 19: Chi tiết sản phẩm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css" >
    </head>
    <body>
        <?php
        include '../connect_db.php';
        $result = mysqli_query($con, "SELECT * FROM `product` WHERE `menuid` = ".$_GET['menuid']);
        //$product = mysqli_fetch_assoc($result);
        // var_dump($_SESSION['product']); exit();
        // print_r($result);
        // $imgLibrary = mysqli_query($con, "SELECT * FROM `image_library` WHERE `product_id` = ".$_GET['id']);
        // $product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
        

        ?>
                        <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box">
                <div class="product-imitation">
                    <a href="../detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['image'] ?>" title="<?= $row['name'] ?>" /></a>
                </div>
                <div class="product-desc">
                    <span class="product-price">
                        <?= number_format($row['price'], 0, ",", ".") ?>
                    </span>
                    <small class="text-muted">Category</small>
                    <!-- <a href="#" class="product-name"> <?= $row['name'] ?></a> -->

                    <div class="small m-t-xs">
                        Many desktop publishing packages and web page editors now.
                    </div>
                    <div class="m-t text-righ">

                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
                   
                <?php } ?>
    </body>
</html>