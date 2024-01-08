<?php 
    session_start();
     $servername = "35.240.190.9";
     $dbusername = "test1";
     $dbpassword = "test1";
     $dbname = "Cs251_project";
     $output = "";
     $outputRand ="";
     $count = 1;
     $username = $_SESSION['username'];
     
 
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>KinRaiDee</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="css/navbar_css.css">
    <link rel="stylesheet" href="css/feed_css.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300&display=swap" rel="stylesheet">


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
                        <a id="main"class="nav-item nav-link active" style="font-size: 120%;">หน้าหลัก</a>
                        <a id="random" class="nav-item nav-link" style="font-size: 120%;">สุ่ม!</a>
                    </div>



                    <a id="kinraidee" class="navbar-brand mx-5 d-none d-lg-block">
                        <div class="logo" style="margin-left: 10%;">
                            <img src="img/logo2.png" width="100" height="100">
                        </div>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a  id="shop" class="nav-item nav-link" style="font-size: 120%;">ร้านทั้งหมด</a>
                        <a  id="review" class="nav-item nav-link" style="font-size: 120%;">รีวิวล่าสุด</a>
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
                                $row = mysqli_fetch_array($result);               //fetch result to variable $row
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

    <?php
        // Get user current time
        date_default_timezone_set('Asia/Bangkok');
        $user_time = date("H:i:s");
        
        // Query
        $query = "SELECT r.restaurant_id, r.restaurant_name, r.open_time, r.close_time,
                    u.user_id, u.full_name, u.last_name, u.photo AS photouser 
                    , rv.title, rv.comment, rv.photo, rv.date, rv.star
                    FROM review rv
                    JOIN restaurant r ON rv.restaurant_id = r.restaurant_id
                    JOIN user u ON rv.user_id = u.user_id
                    ORDER BY rv.date DESC
                    LIMIT 10;";

        // $query = "
        //             SELECT * FROM restaurant
                    
        //             ";
        $result = mysqli_query($conn, $query);
    
        ?>
    <br>
    <div class="container-feed">
        <div style="width: 30%;padding: 3%;margin-bottom: -10px;">
            <center><b><h style="font-size: 150%;font-weight: 1500;">รีวิวล่าสุด</h></b><center>
        </div>
        <hr style="width:80%;text-align:left;margin-left:0;margin: auto;">
        <?php
            $output .= '<div class="container-sub">';
            while ($row = mysqli_fetch_array($result)) {
                $user_id = $row["user_id"];
                $querycount = "SELECT user_id,COUNT(user_id) AS review_count FROM review
                                
                                WHERE user_id = '$user_id'";
                $resultcount = mysqli_query($conn, $querycount);
                $rowcount = mysqli_fetch_array($resultcount);
                $output .= '<hr><div class="container-inside">
                                    <div class ="review-name">
                                    <img class="img1" onclick="test(' . $row["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row["photouser"]) . '">

                                        <b><span> '.$row["full_name"] . ' ' . $row["last_name"] .' ('.$rowcount["review_count"].' รีวิว)</span></b>
                                    </div>
                                        <div class="restaurant-info-flex" onclick="test('.$row["restaurant_id"].')" style="margin-top: -1%">';
                
                                        // if the restaurant is open
                
                for ($i = 0; $i < $row["star"]; $i++) {
                    $output .= '</p><img class="startag" src="img/yellowstarpng.png"></img>';
                }
                for ($i = 5; $i > $row["star"]; $i--) {
                $output .= '</p><img class="startag" src="img/whitestarpng.png"></img>';
                }


                $output .= '<p> '. date('j M Y', strtotime($row["date"])).'</p>
                                        <p class="label"> ร้าน ' . $row["restaurant_name"] . '</p>';

                if ($user_time >= $row["open_time"] && $user_time <= $row["close_time"]) {
                    $output .= '<p class="restaurant-open"> <i class="fa-solid fa-check"></i> เปิดอยู่ </p>';
                } else { // restaurant is close
                    $output .= '<p class="restaurant-close"> <i class="fa-solid fa-x"></i> ปิดแล้ว </p>';
                }
                                 
                
                $output .= '</div>
                                        <hr style="width: 90%;margin: auto;margin-top:2%">

                                        <div class="restaurant-info">
                                            <p1><b>'.$row["title"].'</b></p1>
                                            <p>' . $row["comment"] . '</p>
                                        </div>



                                    <img class="img2" onclick="test(' . $row["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row["photo"]) . '">
                                    
                                    


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
        </br>
            

</body>
    <script src="src/mainbuyer_js.js"> </script>
    <script src="src/navbar_js.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</html>