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
$res_id = $_GET['id'];

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


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/navbar_css.css">
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


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/review_css.css" rel="stylesheet">
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
                        <a id="main"class="nav-item nav-link active" style="font-size: 120%;font-weight:  100 !important">หน้าหลัก</a>
                        <a id="random" class="nav-item nav-link" style="font-size: 120%;font-weight:  100 !important">สุ่ม!</a>
                    </div>



                    <a id="kinraidee" class="navbar-brand mx-5 d-none d-lg-block">
                        <div class="logo" style="margin-left: 10%;">
                            <img src="img/logo2.png" width="100" height="100">
                        </div>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a  id="shop" class="nav-item nav-link" style="font-size: 120%;font-weight:  100 !important">ร้านทั้งหมด</a>
                        <a  id="review" class="nav-item nav-link" style="font-size: 120%;font-weight:  100 !important">รีวิวล่าสุด</a>
                        <div class="containery">
                            <input type="text" id= "searchy" name="searchy" placeholder="ค้นหา..." class="input" />
                        
                            <a class="btny" id="btny" style="left: 20%;">
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
                                $image_base64 = base64_encode($row["photo"]);

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

   
    
    <br>
                    
    <div class="container-review"  >
        <div class="container-review-plus" style="margin-top: 2%;">
            <div class="inner-review" style="display: flex;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <img src="data:image/jpeg;base64,
                        <?php
                        $query = "
                                SELECT * FROM restaurant
                                WHERE restaurant_id = '$res_id'
                                ";
                        $result = mysqli_query($conn, $query);

                        if ($row = mysqli_fetch_array($result)) {
                            $image = base64_encode($row["photo"]);
                            echo $image;
                        }
                        ?>
                " style="width:160px;height:160px;"/>
                <div style="background-color: rgb(255, 255, 255);width: 100%;padding-left: 3%;margin-top: 2%;border-radius: 5px;
                ">
                          
                        <div class="inner-review" style="padding-left: 3%;margin-top: 2%;">
                            <h3 style="width: 360px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                <?php 
                                    echo $row["restaurant_name"];
                                ?></h3>
                                <img src="img/yellowstar.png" width="30px" height="30px" style="margin-top:-1%"> </img>
                            <p1><?php
                                $querycount =
                                    "SELECT COUNT(*) AS starcount FROM review WHERE restaurant_id = '$res_id'";
                                $result1 = mysqli_query($conn, $querycount);
                                $row1 = mysqli_fetch_assoc($result1);
                                $query =
                                    "SELECT SUM(star) AS star FROM review WHERE restaurant_id = '$res_id'";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                if ($row1['starcount'] == 0) {
                                    $row['star'] = 0;
                                    echo $row['star'] . " (ยังไม่มีการรีวิว)";
                                } else {
                                    $sum = $row['star'] / $row1['starcount'];
                                    $sum = round($sum, 1);
                                    echo $sum . " (". $row1['starcount'] ." รีวิว)";

                                }
                            ?></p1>
                            <br>
                            <p1>เวลาเปิด-ปิด: <?php
                                $query = "
                                    SELECT * FROM restaurant
                                    WHERE restaurant_id = '$res_id';
                                    ";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                echo $row["open_time"] . "-" . $row["close_time"];
                            ?></p1><br>
                        </div>
                        
                </div>
                
                
            </div>
               
            <div class="inner-review" style="text-align: center;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;" >
                <h5 style="margin-top: 4%;">ให้คะแนนร้านค้าร้านนี้</h5>
                <p style="margin-top:-50px;visibility: hidden">0</p>
                <div style="margin: auto;">
                    <div style="margin: auto; width: 100%;justify-content: center;align-items: center;text-align: center;
                    padding-bottom:6%;">
                        <img src="img/whitestar.png" width="15%" id="star1" onclick="review(1)">
                        <img src="img/whitestar.png" width="15%" id="star2" onclick="review(2)">
                        <img src="img/whitestar.png" width="15%" id="star3" onclick="review(3)">
                        <img src="img/whitestar.png" width="15%" id="star4" onclick="review(4)">
                        <img src="img/whitestar.png" width="15%" id="star5" onclick="review(5)">
                    </div>

                    

                    <div style="margin: auto; width: 100%;justify-content: center;align-items: center;text-align: center;">
                        
                    </div>

                    
                
                </div>
            </div>
            
    
             
        </div>
        <form id="review-form" method="POST" action="" enctype="multipart/form-data">
        <div class="container-review-plus" style="margin-top: 2%">
        
                    <div class="inner-review" style="margin-top: 1%;padding-bottom: 100px;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                            <h3 class="text" style="margin-bottom: 5%;padding-left: 7%;padding-top: 4%;"> รูปภาพ</h3>
                            
                            
                            <input id="fileInput" name="images" type="file" accept="image/*" onchange="loadFile(event)" style="padding-left: 10%;"/>
                            <div class="inputimg" style="padding-left: 10%;" required>
                                <img id="output" width="450px" height="450px"/>
                            </div>
                            
                    </div>
                    <div class="inner-review" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;margin-top: 1%;">
                    
                    
    <div class="inner-review" style="text-align: start;padding-left: 3%; text-align: start;">
        <h3 class="text" style="padding-top: 5%;">เขียนรีวิว</h3>
        <hr>
        <p class="text" style="padding-left: -10%;">หัวข้อการรีวิว</p>
        <textarea class="review-txtarea" id="title" name="title" rows="2" cols="63%"></textarea>
        <p class="text">รายละเอียดการรีวิว</p>
        <textarea class="review-txtarea" id="comment" name="comment" rows="4" cols="63%"></textarea>
        <input  type="hidden" id="point" name="point" value="0"></input>
        <div style="margin: auto;text-align: center;margin-top:1%">
            <input type="submit" class="submitbutton" value="ส่งรีวิว" style="width: 200px;"></input>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        date_default_timezone_set("Asia/Bangkok");
        if (isset($_POST['title']) && isset($_POST['comment'])) {
            $title = $_POST['title'];
            $comment = $_POST['comment'];
            $point = $_POST['point'];
            $id = $_SESSION['user_id'];
            //$res_id = $_SESSION['res_id'];
            $date = date("Y-m-d");
            $imgData = addslashes(file_get_contents($_FILES['images']['tmp_name']));
            $images = "INSERT INTO review (`user_id`, `restaurant_id`, `star`, `title`, `comment`, `date`, `photo`) VALUES ('$id', '$res_id','$point','$title','$comment','$date', '$imgData')";
            $upload = mysqli_query($conn, $images);
    
            
        }
         //echo "<script>alert('" . $imgData . "')</script>";
         //echo "<script>alert('" . $res_id . "')</script>";
         //echo "<script>alert('" . $point . "')</script>";
    
        echo "<script>Swal.fire({
                            width: 550,
                            padding: '2em',
                            position: 'center',
                            icon: 'success',
                            title: 'สำเร็จ',
                            html: 'อัพโหลดข้อมูลการรีวิวเสร็จสิ้น',
                            showConfirmButton: false,
                            timer: 2000
                    });
                    </script>";
    }
    ?>


</form>
            </div>
        </div>         
    </div>
    
    <script src = "src/navbar_js.js"></script>
    <script src = "src/review_js.js"></script>
</html>