<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
$servername = "35.240.190.9";
$dbusername = "test1";
$dbpassword = "test1";
$dbname = "Cs251_project";
$username= $_SESSION['username'];
$output = "";
$count = 1;
$res_id = $_GET["id"];
$user_id = '';
$isOpen = "";
$rowseller = "";
date_default_timezone_set('Asia/Bangkok');
$user_time = date("H:i:s");

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($username == NULL) {
    header("Location: login.php");
}

$conn->set_charset("utf8");
?>
<head>
    <meta charset="utf-8">
    <title>Leave a review</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/navbar_css.css">
    <link href="css/seller_css.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">

                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <!-- <i class="fab fa-facebook-f"></i> -->
                        </a>
                        <a class="text-white px-3" href="">
                            <!-- <i class="fab fa-twitter"></i> -->
                        </a>
                        <a class="text-white px-3" href="">
                            <!-- <i class="fab fa-linkedin-in"></i> -->
                        </a>
                        <a class="text-white px-3" href="">
                            <!-- <i class="fab fa-instagram"></i> -->
                        </a>
                        <a class="text-white pl-3" href="">
                            <!-- <i class="fab fa-youtube"></i> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->



    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                    <div class="navbar-nav ml-auto py-0">
                        <a id="main"class="nav-item nav-link active" style="font-size: 120%;font-weight: 100 !important">หน้าหลัก</a>
                        <a id="random" class="nav-item nav-link" style="font-size: 120%;font-weight: 100 !important">สุ่ม!</a>
                    </div>



                    <a id="kinraidee" class="navbar-brand mx-5 d-none d-lg-block">
                        <div class="logo" style="margin-left: 10%;">
                            <img src="img/logo2.png" width="100" height="100">
                        </div>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a  id="shop" class="nav-item nav-link" style="font-size: 120%;font-weight: 100 !important">ร้านทั้งหมด</a>
                        <a  id="review" class="nav-item nav-link" style="font-size: 120%;font-weight: 100 !important">รีวิวล่าสุด</a>
                        <div class="containery">
                            <input type="text" id= "searchy" name="searchy" placeholder="ค้นหา..." class="input" />
                        
                            <a href="search.php" class="btny" id="btny" style="left: 20%;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>
                    

                    <div class="action">


                        <div class="profile" onclick="menuToggle();">
                            <div class="logo" style="margin-left: 10%;">
                            <?php
                                $query = "
                                    SELECT * FROM user
                                    WHERE email = '$username'                   
                                    ";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result); //fetch result to variable $row
                                $active = $row['is_seller'] ;
                                // $uid = $row['user_id'] ;
                                $image_base64 = base64_encode($row["photo"]);
                                $user_id = $row["user_id"];

                                echo '<img src="data:image/jpeg;base64,' . $image_base64 . '" style="width="100" height="100"></img>';

                                ?>
                            </div>
                        </div>
    
                        <div class="menu" id="menu">
                            <h3 class="heyeiei" style="text-align: center;">
                                <?php

                                echo $row['full_name'] . " " . $row['last_name'];

                                ?>
                                <?php
                                echo $row['email'];
                                ?>
                                <div class="badge">
                                    <div class="badge-container" style="background-color: dodgerblue;">
                                        <?php
	                                        if($row['is_seller'] == 1) {
		                                        echo "<h5>Seller</h5>";
	                                        } else {
		                                        echo "<h5>Buyer</h5>";
	                                        }
                                        ?>
                                    </div>
                                </div>
                            </h3>
                            <ul style="margin-top: 5%;">
                                <li>
                                    <span class="material-icons icons-size">mode</span>
                                    <a href="editform.php">Edit Account</a>
                                </li>
                                <?php
                                $uid = $row['user_id'];
                                $isSeller = $row['is_seller'];
                                $query = "SELECT * FROM restaurant WHERE user_id = '$uid'";
                                $result = mysqli_query($conn, $query);

                                if ($row = mysqli_fetch_array($result)) {
                                    if ($isSeller == 1) {
                                        echo '<li><span class="material-icons icons-size">shop</span>';
                                        echo '<a href="editshop.php?id=' . $row['restaurant_id'] . '">Edit Shop</a></li>';
                                    }
                                }
                                ?>
                                <li style="margin-bottom: -20%;">
                                    <span class="material-icons icons-size">logout</span>
                                    <a href="#" onclick="resetForm()">Log out</a>
                                </li>
    
                            </ul>
                        </div>
                    </div>
                    <script>
                        function menuToggle() {
                            const toggleMenu = document.querySelector('.menu');
                            toggleMenu.classList.toggle('active')
                        }


                    </script>
    
                </div>
    
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- กันคนมุุด-->
    <?php
    $querycheck = "SELECT restaurant_id FROM restaurant
                   WHERE restaurant_id = $res_id";
    $resultcheck = mysqli_query($conn,$querycheck);
    if(!$rowcheck = mysqli_fetch_array($resultcheck)){
        echo "<script>Swal.fire({
            title: 'ผิดพลาด',
            text: 'ไม่พบร้านในฐานข้อมูล',
            icon: 'warning',
            confirmButtonText: 'กลับไปยังหน้าหลัก'
            }).then((result) => {
            
                window.location.href = 'mainbuyer.php';
            
            });
                </script>";
    // echo '<script>window.location.href = "mainbuyer.php";</script>';
    exit;
    }
    
    ?>
    
    <div class="container-sub1">
        <div style="padding-left: 3%;">
            <?php
                $query = "SELECT photo,restaurant_id,restaurant_name,open_time,close_time FROM restaurant
                          WHERE restaurant_id = '$res_id'";
                $result = mysqli_query($conn,$query);
                if($row = mysqli_fetch_array($result)){
                    $image_base64 = base64_encode($row["photo"]);
                    echo '<img src="data:image/jpeg;base64,' . $image_base64 . '" width="100" height="100"></img>';
                }


            ?>          
        </div>
        <div class = "restaurant-title">
            <b><span class="tsmall"> <?php echo $row["restaurant_name"];?></span></b>
        
            <br>
            <?php
                $querycount =
                    "SELECT COUNT(*) AS starcount FROM review WHERE restaurant_id = '$res_id'";
                $resultcount = mysqli_query($conn, $querycount);
                $rowcount = mysqli_fetch_assoc($resultcount);
                $querystar =
                    "SELECT SUM(star) AS star FROM review WHERE restaurant_id = '$res_id'";
                $resultstar = mysqli_query($conn, $querystar);
                $rowstar = mysqli_fetch_assoc($resultstar);



            ?>
            <span> <?php echo ($rowcount["starcount"] != 0 ? number_format($rowstar["star"]/$rowcount["starcount"],1) : 0);?> </span>
            <img src="img/yellowstarpng.png" style="width:20px;height:20px;margin-top:-3%"> </img>
            <span>(<?php echo $rowcount["starcount"]?> รีวิว)</span><br>

            <?php
                $isOpen = $user_time >= $row["open_time"] && $user_time <= $row["close_time"];
            ?>
            <?php echo ($isOpen ? '<span class="restaurant-time-open">เปิดอยู่</span>' : '<span class="restaurant-time-close">ปิดแล้ว</span>' );?>
            <span> เวลาทำการ <?php echo date('H:i', strtotime($row["open_time"])) . "-". date('H:i', strtotime($row["close_time"]))?></span>
            
            
        
        </div>
        <div class="title-button-cover">
            <?php
            $resultshow = "";
            $queryseller = "SELECT * FROM restaurant WHERE user_id = $user_id";
            $resultseller = mysqli_query($conn, $queryseller);
            $rowseller = mysqli_fetch_array($resultseller);

            if ($active == 0) {
                $resultshow .= '
        <div class="title-button" style="width: 150px" onclick="location.href=\'./review.php?id=\'+' . $res_id . '">
            <p><i class="fa-solid fa-pen"></i> เขียนรีวิว </p>
        </div>';
            } else {
                if ($rowseller["restaurant_id"] == $row["restaurant_id"]) {
                    $resultshow .= '
            <div class="title-button" onclick="location.href=\'./editshop.php\'">
                <p id="editshop"><i class="fa-solid fa-pen"></i> แก้ไขข้อมูลร้านอาหาร </p> 
            </div><br><br>
            <div class="title-button" onclick="location.href=\'./addfood.php?id=\'+' . $res_id . '">
                <p id="add"><i class="fa-solid fa-pen"></i> เพิ่มรายการอาหาร </p>    
            </div>';
                }
            }

            echo $resultshow;
            ?>
        </div>
    </div>
    

    <div class="scrollmenu">


                
    
        <hr style="width:80%;text-align:left;margin-left:0;margin: auto;">
        <br>
        <?php
        // Get user current time

        // Query
        $query2 = "SELECT f.photofd, f.food_name, f.price, f.restaurant_id, f.food_id , r.restaurant_name, f.active FROM food f
                  JOIN restaurant r ON f.restaurant_id = r.restaurant_id
                  WHERE f.restaurant_id = '$res_id'
                  ORDER BY  f.active  DESC,
                  f.price;";

        // $query = "
        //             SELECT * FROM restaurant
        
        //             ";
        $result2 = mysqli_query($conn, $query2);
                    $output .= '<div class="container-sub2">';
                    while ($row2 = mysqli_fetch_array($result2)) {
                    if($row2['active']==1){
                            if ( $rowseller && $rowseller["restaurant_id"] == $row["restaurant_id"]) {
                    $output .= '
                        <div class="container-inside2">
                        <div class="watermark2">
                                <div class="watermark__inner2">
                                    <div class="watermark__body2">กดเพื่อแก้ไข</div>
                                </div>
                            </div>
                            <img class="img4" onclick="editfood(' . $row2["food_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row2["photofd"]) . '">
                                    <div class="restaurant-name">'
                        . '<b>' . $row2["food_name"] . '</b>'
                        . '</div>
                                    <div class="restaurant-info">
                                            <b><span class="restaurant-time-open"> $ </span></b>
                                            <span> ' . $row2["price"] . ' บาท </span>  <span class="dot"></span>
                                            '
                        . '</div>
                        </div>';
                            }else{
                    $output .= '
                        <div class="container-inside2">
                            <img class="img3" onclick="test(' . $row2["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row2["photofd"]) . '">
                                    <div class="restaurant-name">'
                        . '<b>' . $row2["food_name"] . '</b>'
                        . '</div>
                                    <div class="restaurant-info">
                                            <b><span class="restaurant-time-open"> $ </span></b>
                                            <span> ' . $row2["price"] . ' บาท </span>  <span class="dot"></span>
                                            '
                        . '</div>
                        </div>';
                            }
                    }else{
                             if ( $rowseller && $rowseller["restaurant_id"] == $row["restaurant_id"]) {
                    $output .= '

                            <div class="container-inside2">
                            <div class="watermark2">
                                <div class="watermark__inner2">
                                    <div class="watermark__body2">กดเพื่อแก้ไข</div>
                                </div>
                            </div>
                                <img class="img4" style="opacity: 0.3;" onclick="editfood(' . $row2["food_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row2["photofd"]) . '">
                                        <div class="restaurant-name">'
                        . '<b>' . $row2["food_name"] . '</b>'
                        . '</div>
                                        <div class="restaurant-info">
                                                <b><span class="restaurant-time-close"> $ </span></b>
                                                <span> ' . $row2["price"] . ' บาท </span>  <span class="dot1">   </span>
                                                '
                        . '</div>

                            </div>';

                             }else{
                    $output .= '

                            <div class="container-inside2">
                            <div class="watermark">
                                <div class="watermark__inner">
                                    <div class="watermark__body">หมด!</div>
                                </div>
                            </div>
                                <img class="img3" style="opacity: 0.3;" onclick="test(' . $row2["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row2["photofd"]) . '">
                                        <div class="restaurant-name">'
                        . '<b>' . $row2["food_name"] . '</b>'
                        . '</div>
                                        <div class="restaurant-info">
                                                <b><span class="restaurant-time-close"> $ </span></b>
                                                <span> ' . $row2["price"] . ' บาท </span>  <span class="dot1">   </span>
                                                '
                        . '</div>

                            </div>';
                             }
                            

                        
                    }
                }
                    $output .= '<div style="padding:1%"></div> </div>';
                    echo $output;
                    ?>


            </div>
    
    <!-- START OF FEED AND RES INFO -->

    <div class="feed-flexcover">
    <div class="feed-cover">
    <?php
    $output = "";
    // Get user current time
    date_default_timezone_set('Asia/Bangkok');
    $user_time = date("H:i:s");

    // Query
    $queryfeed = "SELECT r.restaurant_id, r.restaurant_name, r.open_time, r.close_time,
                    u.user_id, u.full_name, u.last_name, u.photo AS photouser 
                    , rv.title, rv.comment, rv.photo, rv.date, rv.star
                    FROM review rv
                    JOIN restaurant r ON rv.restaurant_id = r.restaurant_id
                    JOIN user u ON rv.user_id = u.user_id
                    WHERE rv.restaurant_id = '$res_id'
                    ORDER BY rv.date DESC
                    LIMIT 10;";

    // $query = "
    //             SELECT * FROM restaurant

    
    //             ";
    $resultfeed = mysqli_query($conn, $queryfeed);

    ?>
    <br>
    <div class="container-feed">
        <div style="width: 100%;padding: 3%;margin-bottom: -10px;text-align:center">
                <b>
                    <h style="font-size: 150%;font-weight: 1500;">รีวิวล่าสุด</h>
                </b>
        </div>
        <hr style="width:80%;text-align:left;margin-left:0;margin: auto;">
        <?php
        $output .= '<div class="container-sub">';
        while ($rowfeed = mysqli_fetch_array($resultfeed)) {
            $user_id = $rowfeed["user_id"];
            $querycount = "SELECT user_id,COUNT(user_id) AS review_count FROM review
                                
                                WHERE user_id = '$user_id'";
            $resultcount = mysqli_query($conn, $querycount);
            $rowcount = mysqli_fetch_array($resultcount);
            $output .= '<hr><div class="container-insidefeed">
                                    <div class ="review-name">
                                    <img class="img1" onclick="test(' . $rowfeed["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($rowfeed["photouser"]) . '">

                                        <b><span> ' . $rowfeed["full_name"] . ' ' . $rowfeed["last_name"] . ' (' . $rowcount["review_count"] . ' รีวิว)</span></b>
                                    </div>
                                        <div class="restaurant-info-flex" onclick="test(' . $rowfeed["restaurant_id"] . ')" style="margin-top: -1%">';

            // if the restaurant is open
        
            for ($i = 0; $i < $rowfeed["star"]; $i++) {
                $output .= '<img class="startag" src="img/yellowstarpng.png"></img>';
            }
            for ($i = 5; $i > $rowfeed["star"]; $i--) {
                $output .= '<img class="startag" src="img/whitestarpng.png"></img>';
            }


            $output .= '<p> ' . date('j M Y', strtotime($rowfeed["date"])) . '</p>
                                        <p class="label"> ร้าน ' . $rowfeed["restaurant_name"] . '</p>';

            if ($user_time >= $rowfeed["open_time"] && $user_time <= $rowfeed["close_time"]) {
                $output .= '<p class="restaurant-open"> <i class="fa-solid fa-check"></i> เปิดอยู่ </p>';
            } else { // restaurant is close
                $output .= '<p class="restaurant-close"> <i class="fa-solid fa-x"></i> ปิดแล้ว </p>';
            }


            $output .= '</div>
                                        <hr style="width: 90%;margin: auto;margin-top:2%">

                                        <div class="restaurant-infofeed">
                                            <p1><b>' . $rowfeed["title"] . '</b></p1>
                                            <p>' . $rowfeed["comment"] . '</p>
                                        </div>



                                    <img class="img2" onclick="test(' . $rowfeed["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($rowfeed["photo"]) . '">
                                    
                                    


                           </div>'
            ;

            if ($count == 1) {
                $output .= '
                        </div>
                        <div class="container-sub">
                            
                    ';
                //break;       //print only 6 restaurant
                $count = 1;

            } else {
                $count++;
            }
        }
        echo $output;
        ?>
    </div>
    </div>
    </div>

    <div class="feed-info-cover">
        <?php  
            $query = "SELECT * from restaurant r
                        JOIN user u ON u.user_id = r.user_id
                        WHERE r.restaurant_id = '$res_id'";
            $result = mysqli_query($conn, $query);
            if($row = mysqli_fetch_array($result)){

            }else{
                
            }

        ?>
        <div class="feed-info">
            <div class="feed-info-text">
                    <center><b>
                        <h style="font-size: 150%;font-weight: 1500;padding:20%">ข้อมูลร้านค้า</h><br>
                    </b></center><br>
                        <span><i class="fa-solid fa-location-dot"></i> <?php echo $row["no_home"]
                            . " แขวง ". $row["subdistrict"]
                            . " เขต ". $row["district"]
                            . " จังหวัด ". $row["province"]
                            . " ". $row["postal_code"];?></span><br><br>
                        <!-- <span>ถ. รามอินทรา</span>
                        <span>แขวงคันนายาว </span>
                        <span>เขตคันนายาว </span>
                        <span>กรุงเทพมหานคร </span>
                        <span>10230 </span> <br><br> -->

                        <span><i class="fa-solid fa-phone"></i> <?php echo $row["phone"]?> </span><br><br>

                        <span><i class="fa-solid fa-envelope"></i> <?php echo $row["email"] ?></span><br>

                        <hr style="border: 1px solid black">

            </div>
        </div>
    </div>



    </div> <!--  FLEX COVER-->








                            







        
 
            
                 
    </div>
    
    <script src = "src/navbar_js.js"></script>
    <script src = "src/mainbuyer_js.js"></script>
    <script src = "src/seller_js.js"></script>
    
</html>