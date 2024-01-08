<?php
    session_start();
    global $user;
    global $username;
    $servername = "35.240.190.9";
    $dbusername = "test1";
    $dbpassword = "test1";
    $dbname = "Cs251_project";
    $username = $_SESSION['username'];
    $food_id = $_GET["id"];
    $index = '';
    $row =  "";
 

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }

if ($username == NULL) {
    header("Location: login.php");
}

    $conn->set_charset("utf8");
    $query = 
        "SELECT * FROM user 
        INNER JOIN food ON food.food_id = '$food_id'
        WHERE user.email = '$username'";
    $result = mysqli_query($conn, $query);
    
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
    <link rel="css/editmenu_css.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/editmenu_css.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <a class="nav-item nav-link active" id="main" style="font-size: 120%;">หน้าหลัก</a>
                        <a class="nav-item nav-link" id="random" style="font-size: 120%;">สุ่ม!</a>
                    </div>



                    <a class="navbar-brand mx-5 d-none d-lg-block">
                        <div class="logo" style="margin-left: 10%;">
                            <img src="img/logo2.png" id="kinraidee" width="100" height="100">
                        </div>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a id="shop" class="nav-item nav-link" style="font-size: 120%;">ร้านยอดฮิต</a>
                        <a id="review" class="nav-item nav-link" style="font-size: 120%;">รีวิวล่าสุด</a>
                        <div class="containery">
                            <input type="text" name="searchy" id="searchy" placeholder="ค้นหา..." class="input" />
                        
                            <a href="#" class="btny" id="btny" style="left: 20%;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>
                    

                    <div class="action">


                        <div class="profile" onclick="menuToggle();">
                            <div class="logo" style="margin-left: 10%;">
                            <?php
                                if(!$row = mysqli_fetch_array($result)){
                                    $querytemp = "SELECT user_id from user
                                                     WHERE email = '$username'";
                                    $resulttemp = mysqli_query($conn,$querytemp);
                                    $rowtemp = mysqli_fetch_array($resulttemp);
                                    $uid = $rowtemp["user_id"];
                                }else{
                                    $uid = $row['user_id'] ;
                                }
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
                            
                            </d>
                            <ul style="margin-top: 5%;">
                        
                                <li>
                                    <span class="material-icons icons-size">mode</span>
                                    <a href="editform.php">Edit Account</a>
                                </li> 
	                                <?php
		                                $uid = $row['user_id'];
		                                $isSeller = $row['is_seller'];
		                                $queryseller = "SELECT * FROM restaurant WHERE user_id = '$uid'";
		                                $resultseller = mysqli_query($conn, $query);
                                        
		                                if ($rowseller = mysqli_fetch_array($resultseller)) {
			                                if ($isSeller == 1) {
				                                echo '<li><span class="material-icons icons-size">shop</span>';
				                                echo '<a href="editshop.php?id=' . $rowseller['restaurant_id'] . '">Edit Shop</a></li>';
			                                }
		                                }
	                                ?>
                                <li style="margin-bottom: -20%;">
                                    <span class="material-icons icons-size">logout</span>
                                    <a href="login.php">Log out</a>
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

    <div class ="container-header "style="top: 20px; left: 5%;">
        <div class="box-head">
            <div class="size-head">
                <p style="margin-top: 18px">แก้ไขข้อมูลรายการอาหาร</p>
            </div>
        </div>
    </div>

    <form action="#" id="Editfoor" name="Editfood" method="post" enctype="multipart/form-data">
    <div class ='container-ResPhoto'>
    <div class="logo" >
            
            <?php
                $image_base64 = base64_encode($row["photofd"]);

                echo '<img src="data:image/jpeg;base64,' . $image_base64 . '" style="width="300" height="300"></img>';
            ?>
        </div>
    </div>
    <div class="position-text">
        <span>Name</span>
        <input type="text" class="form-control p-4 " name="foodname" id="foodname" placeholder="ชื่ออาหาร" required="required" data-validation-required-message="Please enter your name" value="<?php echo $row['food_name']?>">
        <span>Price</span>
        <input type="text" class="form-control p-4 " name="price" id="price" placeholder="ราคาของอาหาร" required="required" data-validation-required-message="Please enter your name" value="<?php echo $row['price']?>">
        <span>Type(หากมีหลายประเภทให้ใช้ ;)</span>
        <input type="text" class="form-control p-4 " name="type" id="type" placeholder="ประเภทอาหาร" required="required" data-validation-required-message="Please enter your name" value="<?php echo $row['food_type']?>">
        <span>Nationality</span>
        <input type="text" class="form-control p-4 " name="nationality" id="nationality" placeholder="สัญชาติของอาหาร" required="required" data-validation-required-message="Please enter your name" value="<?php echo $row['nationality']?>">
        <span>Image</span>
        <input type="file" class="form-control p-4" placeholder="Image" id="uploadfile" name="uploadfile">  
        
         <div class="onOff"> 
            <span>status</span><br>
            <input type="radio" id="off" name="onoff" value="0" required>
            <lable class="user">not for sell</lable><br>
            <input type="radio" id="on" name="onoff" value="1" required>
            <lable class="user">sell</lable>
        </div>        

    </div>
    <div class="position-btn">
        <button type="submit" class="container-button" >ยืนยัน!</button>
    </div>
    <!-- <div class="position-btn2">
        <button type="button" class="container-button" onclick="location.href='addfood'">กดเพื่อเพิ่มรายการอาหาร</button>
    </div> -->
    
    <?php

    $query = "SELECT * FROM food f
     JOIN restaurant r ON r.restaurant_id = f.restaurant_id 
    WHERE r.user_id = '$uid' AND f.food_id = '$food_id'
    ";
   $result1 = mysqli_query($conn, $query);


    $query1 = "SELECT * FROM restaurant
    WHERE user_id = '$uid'
    ";
      $result2 = mysqli_query($conn, $query1);

    if($row3 = mysqli_fetch_array($result2)){   // seller , any seller
        $index = $row3['restaurant_id'] ;
        if(!$row2 = mysqli_fetch_array($result1)){ // เจ้าของร้านตัวจริง
        echo "<script>Swal.fire({
            title: 'ผิดพลาด',
             text: 'สามารถเข้าหน้านี้ได้เฉพาะเจ้าของร้านอาหารเท่านั้น',
            icon: 'warning',
           confirmButtonText: 'ฉันเข้าใจแล้ว'
             }).then((result) => {
        
            window.location.href = 'seller.php?id=$index  ';
        
        });
            </script>";
   }
    }else{ //buyer 
        echo "<script>Swal.fire({
            title: 'ผิดพลาด',
             text: 'สามารถเข้าหน้านี้ได้เฉพาะเจ้าของร้านอาหารเท่านั้น',
            icon: 'warning',
           confirmButtonText: 'ฉันเข้าใจแล้ว'
             }).then((result) => {
        
            window.location.href = 'mainbuyer.php';
        
        });
            </script>";
    }
 

   $rid = $row2['restaurant_id'];
    ob_start();
    if (isset($_FILES['uploadfile']['error'])) {
        $uploadError = $_FILES['uploadfile']['error'];
        if ($uploadError !== UPLOAD_ERR_OK) {
            $foodname = $_POST['foodname'];
            $price = $_POST['price'];
            $nationality = $_POST['nationality'];
            $type = $_POST['type'];
            $onOff = $_POST['onoff'];

            
            // $addphoto = $row['photo'];
            $stmt = mysqli_prepare($conn, "UPDATE food SET food_name=?, price=?, nationality = ?, food_type=?, active=?   WHERE food.food_id = '$food_id'");


            // Bind the values to the prepared statement    
            mysqli_stmt_bind_param($stmt, "sissi", $foodname, $price, $nationality, $type, $onOff);
            
            // Execute the statement
            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_errno($stmt)){
                echo "Error inserting record: " . mysqli_stmt_error($stmt);
            } else {
                echo "<script>
                                            Swal.fire({
                                                width: 550,
                                                padding: '2em',
                                                position: 'center',
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'Food has been saved',
                                                showConfirmButton: true,
                                                confirmButtonText: 'Yes',
                                                confirmButtonColor: '#AACB73',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire('Saved!', '', 'success').then((result) => {
                                                        window.location = './seller.php?id=" . $index . "';
                                                    });
                                                }
                                            });
                                        </script>";
                            }
        } else {
                    $imgData = addslashes(file_get_contents($_FILES['uploadfile']['tmp_name']));
                    $foodname = $_POST['foodname'];
                    $price = $_POST['price'];
                    $nationality = $_POST['nationality'];
                    $type = $_POST['type'];
                    $onOff = $_POST['onoff'];

            
                    // $addphoto = $row['photo'];
                    $stmt = mysqli_prepare($conn, "UPDATE food SET food_name=?, price=?, nationality = ? ,photofd = '$imgData', food_type=?, active=? WHERE food.food_id = '$food_id'");


                    // Bind the values to the prepared statement    
                    mysqli_stmt_bind_param($stmt, "sissi", $foodname, $price, $nationality, $type, $onOff);
                         // Execute the statement
                         mysqli_stmt_execute($stmt);

                         if(mysqli_stmt_errno($stmt)){
                            echo "Error to updated: " . mysqli_stmt_error($stmt);
                            } else {
                echo "<script>
                                            Swal.fire({
                                                width: 550,
                                                padding: '2em',
                                                position: 'center',
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'Food has been saved',
                                                showConfirmButton: true,
                                                confirmButtonText: 'Yes',
                                                confirmButtonColor: '#AACB73',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire('Saved!', '', 'success').then((result) => {
                                                        window.location = './seller.php?id=" . $index . "';
                                                    });
                                                }
                                            });
                                        </script>";
                            }   
                    }
                }
               
                
        ?>



    </form>
</body>

        <script src="src/navbar_js.js"></script>

</html>