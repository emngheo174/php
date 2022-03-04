<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>e commerce product list - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="csse.css"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="css/cart.css" >
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <?php
        $param = "";
        $sortParam = "";
        $orderConditon = "";
        //Tìm kiếm
        $search = isset($_GET['name']) ? $_GET['name'] : "";
        if ($search) {
            $where = "WHERE `name` LIKE '%" . $search . "%'";
            $param .= "name=" . $search . "&";
            $sortParam = "name=" . $search . "&";
        }

        //Sắp xếp
        $orderField = isset($_GET['field']) ? $_GET['field'] : "";
        $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
        if (!empty($orderField) && !empty($orderSort)) {
            $orderConditon = "ORDER BY `product`.`" . $orderField . "` " . $orderSort;
            $param .= "field=" . $orderField . "&sort=" . $orderSort . "&";
        }

        include './connect_db.php';
        //*phan trang
        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; //Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page;
        if ($search) {
            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%' " . $orderConditon . "  LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%'");
        } else {
            $products = mysqli_query($con, "SELECT * FROM `product` " . $orderConditon . " LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
        }
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        include './menu.php';
        ?>
        
         
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div id="wrapper-product" class="container">
<div class="row">

                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>

                        <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box">
                <div class="product-imitation">
                    <a href="detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['image'] ?>" title="<?= $row['name'] ?>" style="width: 200px;" /></a>
                </div>
                <div class="product-desc">
                    <span class="product-price">
                        <?= number_format($row['price'], 0, ",", ".") ?>
                    </span>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> <?= $row['name'] ?></a>

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



                <?php
                include './pagination.php';
                ?>
</div>
</div>


        <div id="cart-icon">
            <a data-fancybox data-type="ajax" data-src="ajax-cart.php" href="javascript:;">
                <img width="100" src="images/cart.png" alt="alt"/>
            </a>
        </div>


        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="libs/fancybox/jquery.fancybox.min.js"></script>
        <script>
                    $(".quick-buy-form").submit(function (event) {
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: './process_cart.php?action=add',
                            data: $(this).serializeArray(),
                            success: function (response) {
                                response = JSON.parse(response);
                                if (response.status == 0) { //Có lỗi
                                    alert(response.message);
                                } else { //Mua thành công
                                    alert(response.message);
//                                    location.reload();
                                }
                            }
                        });
                    });
        </script>
</body>
</html>