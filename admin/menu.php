<header>
        <div id="logo">
            <img src="https://devmaster.edu.vn/images/logo.png" alt="Viện Công Nghệ Và Đào Tạo Devmaster">
        </div>
        <style>
 *{
    margin: 0;
    padding: 0;
}
header, nav{
    /* canh giữa cách lề mỗi bên 10% */
    margin: 5px 10%;
}
nav{
    background: #484848; /*tô màu cho menu cha*/
    border-radius: 5px; /* bo góc */
}
nav ul{
    display: flex;
}
nav> ul li{
    list-style: none; /* bỏ dấu chấm mặc định của li */
    /* kẻ đường bên trái và bên phải của li */
    border-right: 1px solid #ccc;
    border-left:1px solid #333;
}
nav> ul li a{
    display: block;
    padding: 0 25px;
    line-height: 50px;
    color: #f1f2f3;
    text-decoration: none;
}
nav ul li:first-child {
    border-left: none; /* bỏ đường kè trái của phần tử đầu tiên */
}
nav> ul li:first-child a{
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}
/* Khi hover đến li, tô màu cho thẻ a */
nav ul li:hover>a{
    background: red;
    opacity: .7;
    color: yellow;
}
/*menu con*/
/*Ẩn các menu con cấp 1,2,3*/
nav li ul{
    display: none;
    min-width: 350px;
    position: absolute;
}
nav li>ul li{
    width: 100%;
    border: none;
    border-bottom: 1px solid #ccc;
    background: #999;
    text-align: left;
}
nav li>ul li:first-child a{
    border-bottom-left-radius: 0px;
    border-top-left-radius: 0px;
}
nav li>ul li:last-child {
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
nav li>ul li:last-child a{
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
/*khi hover thì hiện menu con*/
nav  li:hover > ul{
    display:  block;
}
/*Hiển thị menu con cấp 2,3,4 bên cạnh phải*/
nav > ul li > ul li >ul{
    margin-left: 352px;
    margin-top: -50px;
}
        </style>
    </header>
    <?php
// include 'header.php';
session_start();
include '../connect_db.php';
$sql = 'SELECT * FROM menu1';
 
$result = mysqli_query($con, $sql);
 
$categories = array();
 
while ($row = mysqli_fetch_assoc($result)){
    $categories[] = $row;
}

function showCategories($categories, $parent_id = 0, $char = '', $stt = 0)
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        if ($stt == 0){
            // là cấp 1
        }
        else if ($stt == 1){
            // là cấp 2
        }
        else if ($stt == 2){
            // là cấp 3
        }
         
        echo '<ul>';
        foreach ($cate_child as $key => $item)
        {
            // Hiển thị tiêu đề chuyên mục
            echo '<li>';echo"<a href='detailmenu.php?menuid=".$item['id']."'>";
            echo $item['name'];
            echo'</a>';

            
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item['id'], $char.'|---', ++$stt);
    
            echo '</li>';
        }
        echo '</ul>';
    }
}






?>
    <nav>
        <ul>
            <?php showCategories($categories); ?>
        </ul>
    </nav>


