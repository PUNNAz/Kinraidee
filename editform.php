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
 

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }

if ($username == NULL) {
    header("Location: login.php");
}

    $conn->set_charset("utf8");
    $query = "
        SELECT * FROM user
        WHERE email = '$username'
        ";
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
    <link rel="stylesheet" href="css/editform_css.css">
    <link rel="stylesheet" href="css/navbar_css.css">
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
                        <a id="shop" class="nav-item nav-link" style="font-size: 120%;">ร้านทั้งหมด</a>
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
                                if (!$row = mysqli_fetch_array($result)) {
                                    $querytemp = "SELECT user_id from user
                                                     WHERE email = '$username'";
                                    $resulttemp = mysqli_query($conn, $querytemp);
                                    $rowtemp = mysqli_fetch_array($resulttemp);
                                    $uid = $rowtemp["user_id"];
                                } else {
                                    $uid = $row['user_id'];
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
                                        if ($row['is_seller'] == 1) {
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
                                    $query = "SELECT * FROM restaurant WHERE user_id = '$uid'";
                                    $result = mysqli_query($conn, $query);

                                    if ($rownav = mysqli_fetch_array($result)) {
                                        if ($isSeller == 1) {
                                            echo '<li><span class="material-icons icons-size">shop</span>';
                                            echo '<a href="editshop.php?id=' . $rownav['restaurant_id'] . '">Edit Shop</a></li>';
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

    <section>
        <div class="container-edit">
            <div class="title">แก้ไขข้อมูลส่วนตัว</div>
            <form action="#" id="Editform" name="Editform" method="post" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" required id="email" name="email" value="<?php echo $username?>">
                        <p class="textID" id="text"></p>

                    </div>
                    
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="text" required id="password" name="password" value="<?php echo $row['password']?>">
                        <p class="textID" id="text1"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" required id="fname" name="fname" value="<?php echo $row['full_name']?>">
                        <p class="textID" id="text2"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" required id="lname" name="lname" value="<?php echo $row['last_name']?>">
                        <p class="textID" id="text3"></p>
                    </div>

                    <br>

                    <div class="input-box">
                        <span class="details">Home No.</span>
                        <input type="text" required id="hnum" name="hnum" value="<?php echo $row['no_home']?>">
                        <p class="textID" id="text4"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Subdistrict</span>
                        <input type="text" required id="subdistrict" name="subdistrict" value="<?php echo $row['subdistrict']?>">
                        <p class="textID" id="text5"></p>
                    </div>

                    <div class="input-box">
                        <span class="details">District</span>
                        <input type="text" required id="district" name="district" value="<?php echo $row['district']?>">
                        <p class="textID" id="text6"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Province</span>
                        <input type="text" required id="province" name="province" value="<?php echo $row['province']?>">
                        <p class="textID" id="text7"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Postal Code</span>
                        <input type="text" required id="posnum" name="posnum" value="<?php echo $row['postal_code']?>">
                        <p class="textID" id="text8"></p>
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" required id="phonenum" name="phonenum" value="<?php echo $row['phone']?>">
                        <p class="textID" id="text9"></p>
                    </div>
                </div>

                <div id="HERE" ></div>
                    <div>
                        <strong>Select Image:</strong>
                        <input type="file" id="uploadfile" name="uploadfile">
                       

                    </div>

                <br><br>
                <div>
                    <input type="submit" class="btn" value="ยืนยันการแก้ไข">
                </div>
                <?php
                    ob_start();
                ?>
                <?php
                if (isset($_FILES['uploadfile']['error'])) {
                    $uploadError = $_FILES['uploadfile']['error'];
                    if ($uploadError !== UPLOAD_ERR_OK) {
                        $email = $_POST['email'] ;
                        $password = $_POST['password'] ;
                        $full_name = $_POST['fname'] ;
                        $last_name = $_POST['lname'] ;
                        $no_home = $_POST['hnum'] ;
                        $subdistrict = $_POST['subdistrict'] ;
                        $district = $_POST['district'] ;
                        $province = $_POST['province'] ;
                        $postal_code = $_POST['posnum'] ;
                        $addPhone = $_POST['phonenum'] ;
                        // $addphoto = $row['photo'];
                        $stmt = mysqli_prepare($conn, "UPDATE user SET email=?, password=?, full_name=?, last_name=?, no_home=?, subdistrict=?, district=?, province=?, postal_code=?, phone=?  WHERE email = '$username'");


                        // Bind the values to the prepared statement    
                        mysqli_stmt_bind_param($stmt, "ssssssssis", $email, $password, $full_name, $last_name, $no_home, $subdistrict, $district, $province, $postal_code, $addPhone);
                        // mysqli_stmt_bind_param($stmt, ":photo", $addphoto);
                         // Execute the statement
                         mysqli_stmt_execute($stmt);

                         if(mysqli_stmt_errno($stmt)){
                            echo "Error inserting record: " . mysqli_stmt_error($stmt);
                            } else {
                                echo "<script>Swal.fire({
                                    width: 550,
                                    padding: '2em',
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Profile are save',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Yes',
                                    confirmButtonColor : '#AACB73',
                                    showDenyButton: true,
                                    denyButtonText: 'cancle',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                          Swal.fire('Saved!', '', 'success').then((result) => {
                                            window.location = './mainbuyer.php'; }); 
                                        } else if (result.isDenied) {
                                          Swal.fire('Changes are not saved', '', 'info')
                                        }
                                      });
                
                                    
                                    </script>";
                            }
                    } else {
                        $imgData = addslashes(file_get_contents($_FILES['uploadfile']['tmp_name']));
                        $email = $_POST['email'] ;
                        $password = $_POST['password'] ;
                        $full_name = $_POST['fname'] ;
                        $last_name = $_POST['lname'] ;
                        $no_home = $_POST['hnum'] ;
                        $subdistrict = $_POST['subdistrict'] ;
                        $district = $_POST['district'] ;
                        $province = $_POST['province'] ;
                        $postal_code = $_POST['posnum'] ;
                        $addPhone = $_POST['phonenum'] ;
                        $stmt = mysqli_prepare($conn, "UPDATE user SET email=?, password=?, full_name=?, last_name=?, no_home=?, subdistrict=?, district=?, province=?, postal_code=?, phone=? ,photo='$imgData' WHERE email = '$username'");


                        // Bind the values to the prepared statement    
                        mysqli_stmt_bind_param($stmt, "ssssssssis", $email, $password, $full_name, $last_name, $no_home, $subdistrict, $district, $province, $postal_code, $addPhone);
                        // mysqli_stmt_bind_param($stmt, ":photo", $imgData);
                         // Execute the statement
                         mysqli_stmt_execute($stmt);

                         if(mysqli_stmt_errno($stmt)){
                            echo "Error to updated: " . mysqli_stmt_error($stmt);
                            } else {
                                echo "<script>Swal.fire({
                                    width: 550,
                                    padding: '2em',
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Profile are save',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Yes',
                                    confirmButtonColor : '#AACB73',
                                    showDenyButton: true,
                                    denyButtonText: 'cancle',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                          Swal.fire('Saved!', '', 'success').then((result) => {
                                            window.location = './mainbuyer.php'; }); 
                                        } else if (result.isDenied) {
                                          Swal.fire('Changes are not saved', '', 'info')
                                        }
                                      });
                
                                    
                                    </script>";
                            }   
                    }
                }
               
                
        ?>
        
            </form>
            
        </div>
      

    </section>
    <script src="src/navbar_js.js"></script>
    <script src="src/validate_js.js"></script>     
</body>

</html>
