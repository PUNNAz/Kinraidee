<?php
    session_start();
    global $user;
    global $username;
    $servername = "35.240.190.9";
    $dbusername = "test1";
    $dbpassword = "test1";
    $dbname = "Cs251_project";
    $username = $_SESSION['username'];
    $row =  "";
    $quest_id = $_SESSION['quest_id'];
    //Check if direct to this page
    if ($username == NULL) {
        header("Location: login.php");
    } 
    
    if($quest_id == NULL){
        $_SESSION['quest_id'] = 1;
        $quest_id = 1;
        header("Refresh:0");
    }

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }

    $conn->set_charset("utf8");
    $query = "
        SELECT * FROM user
        WHERE email = '$username'
        ";
    $result = mysqli_query($conn, $query);
    if( $quest_id == 5 ){
        echo "<script> window.location = './answer.php'; </script>";
    }else{
        //echo $_SESSION['kw'] ;
    }
   
?>

<!DOCTYPE html>

<head>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/question_css.css">
   

    
    <link rel="stylesheet" href="css/navbar_css.css">
    <!--ของเม้วเม้วปุนปุน-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    <title>Question</title>
    
       <!-- Boxicons CDN Link -->
       <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <!-- <link href="img/favicon.ico" rel="icon"> -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> -->
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    
    <!-- เม้วเม้วปุนปุนปวด เฮ้ดเด้อ-->
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
    <!-- ก้อนคำถาม -->
    <!-- <div class="overlayy">
        <div class="images">
            <div class="right">
               <a href="www.google.com">
                <img src="back.png" width="50" height="50" alt="HI"></a> 
            </div>
        </div>
    </div>
    <div class="overlayy">
        <div class="images">
          <div class="left">
            <a href="gonext.html"><img src="next.png" width="50" height="50" ></a> 
          </div>
        </div>
    </div> -->
    <section >
        <div style="margin-top:3%;margin-left:42%;border:0px;" class="boxbg">
            <div class="size">
                <p style="margin-top: 31px ">
                <?php 
                $query = "
                SELECT * FROM question
                WHERE quest_id = '$quest_id';
                ";
                 $result = mysqli_query($conn, $query);
                 $row = mysqli_fetch_array($result);
                 echo $row['questions'];
                
                ?></p>
            </div>
        </div>
    </section>
    <hr style="width:50%;text-align:left;margin-left:0;margin: auto;">
    <img src="img/bg_q2.png" style="position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    pointer-events: none;
    z-index: -500;">
    

    <!-- ก้อนคำถาม -->

    <div class="container1" >
        <div class="center" >
            <button class="btn1" >
                <svg width="300px" height="150px" viewBox="0 0 300 150" class="border" id="choice_1">
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="bg-line" />
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="hl-line" />
                </svg>
                <span><?php echo $row['choice_1'] ?></span>
            </button>
        </div>
    </div>

    <div class="container2" id="choice_2">
        <div class="center">
            <button class="btn2">
                <svg width="300px" height="150px" viewBox="0 0 300 150" class="border">
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="bg-line" />
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="hl-line" />
                </svg>
                <span><?php echo $row['choice_2'] ?></span>
            </button>
        </div>
    </div>

    <div class="container3"  id="choice_3">
        <div class="center">
            <button class="btn3" >
                <svg width="300px" height="150px" viewBox="0 0 300 150" class="border">
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="bg-line" />
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="hl-line" />
                </svg>
                <span><?php echo $row['choice_3'] ?></span>
            </button>
        </div>
    </div>

    <div class="container4" id="choice_4">
        <div class="center">
            <button class="btn4"> 
                <svg width="300px" height="150px" viewBox="0 0 300 150" class="border">
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="bg-line" />
                    <polyline points="300,1 300,150 1,150 1,1 300,1" class="hl-line" />
                </svg>
                <span><?php echo $row['choice_4'] ?></span>
            </button>
        </div>
        
    </div>
        <?php

        ?>
</body>
<script src="./src/question_js.js"></script>
<script src="./src/navbar_js.js"></script>

</html>