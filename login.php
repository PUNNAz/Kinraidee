<?php
session_start();
$loginsellerid = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section>
        <div class="food">
            <div class="set">
                <div><img src="img/rice1.png" width="100" height="100"></div>
                <div><img src="img/rice2.png" width="100" height="100"></div>
                <div><img src="img/rice3.png" width="100" height="100"></div>
                <div><img src="img/rice4.png" width="100" height="100"></div>
                <div><img src="img/rice5.png" width="100" height="100"></div>
                <div><img src="img/rice6.png" width="100" height="100"></div>
                <div><img src="img/rice7.png" width="100" height="100"></div>
                <div><img src="img/rice8.png" width="100" height="100"></div>
            </div>
        </div>
        <img src="img/BG.jpg" class="bg">
        <div class="logo">
            <img src="img/logo1.png" width="150" height="150">
        </div>
        <div class="login-form">
            <form id="login-form" name="login-form" action="" method="post">

                <div class="login" width="150" height="100">
                    <div class="inputBox" style="position: relative;">

                        <div class="form-group" style="margin-top: 10%;">
                            <input type="text" class="form-control" name="username" id="username"
                                required>
                            <label for="username" class="form-label" id="userlabel">Enter your email</label>
                        </div>
                        <div style="margin-top: 2%;">
                            <small id="text"></small>
                        </div>
                        
                        

                        <div class="form-group" style="margin-top: 4%;position: relative;display:inline-block;width: 100%;">
                            <input type="password" class="form-control" name="password" id="password" required>
                            <label for="password" class="form-label" id="passwordlabel">Enter your password</label>
                            <span style="position: absolute;" id="eye"><i class="fas fa-eye-slash"></i></span>
                        </div>

                        <div style="margin-top: 2%;">
                            <small id="text2"> </small>
                        </div>

                        
                        
                        <!-- <input type="password" name="password" id="password" placeholder="Password" style="margin-top: 4%;"
                            style="margin-top:3%" required>
                        <div class="info">
                            <small id="text2"></small>
                        </div> -->
                        <div class="inputBox">
                            <input class="submit"type="submit" value="Login" id="loginBtn" style="margin-top:6%">
                        </div>
                        <div class="group" style="margin: auto;width: 100%;text-align: right;padding: 5%;padding-right: 0%;">
                            <a href="changepassword.php">Forget Password?</a>
                        </div>
                        <div style="margin-top: 8%;text-align: center;">
                            <p style="border-top: 1px solid #c2c2c2;width: 100%;"></p>
                            <div style="margin-top: 4%;" class="chrome">
                                <a href="register.php" style="text-decoration: none;color:rgb(123, 123, 123);font-size: 90%;">register for an account</a>
                            </div>
                        </div>
                    </div>

                    <?php
                    $servername = "35.240.190.9";
                    $dbusername = "test1";
                    $dbpassword = "test1";
                    $dbname = "Cs251_project";

                    // Create connection
                    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    if (isset($_POST['username']) && isset($_POST['password'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password']; 
                        $query = "
                                SELECT * FROM user 
                                WHERE email='$username'
                                ";

                        $result = mysqli_query($conn, $query);
                        //$row = mysqli_fetch_array($result);
                        if ($row = mysqli_fetch_assoc($result)) {
                            if ($password == $row["password"]) {
                                $_SESSION["username"] = $username;
                                $_SESSION["count_user"] = 1;
                                $_SESSION["password"] = $password;
                                $_SESSION["user_id"] = $row["user_id"];
                                $user_id =$row["user_id"] ;
                                $queryid = "SELECT restaurant_id FROM restaurant 
                                            WHERE user_id =' $user_id'
                                ";
                                    $resultid = mysqli_query($conn, $queryid);
                                    if($rowid = mysqli_fetch_array($resultid)){
                                        $loginsellerid = $rowid['restaurant_id'];
                                    }else{
                                        $loginsellerid = 1;
                                    }
                                echo "<script>Swal.fire({
                            width: 550,
                            padding: '2em',
                            position: 'center',
                            icon: 'success',
                            title: 'เข้าสู่ระบบได้สำเร็จ',
                            html: 'ระบบจะพาท่านไปยังหน้าถัดไปในอีก <b></b> วินาที.',
                            showConfirmButton: false,
                            timer: 2000,

                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = (Swal.getTimerLeft()/1000).toFixed(0)
                            }, 100)
                            },
                            willClose: () => {
                            clearInterval(timerInterval)
                            }
                        }).then(function(){
                        if (" . $row['is_seller'] . " == 0) {
                                window.location = 'mainbuyer.php';
                            } else {
                                window.location = 'seller.php?id=". $loginsellerid ."';
                        }

                    });
                    </script>";

                            } else {
                                echo "<script>Swal.fire({
                            width: 550,
                            padding: '2em',
                            position: 'center',
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
                            showConfirmButton: false,
                            showDenyButton: true,
                            denyButtonText: 'OK',
                            });
                    </script>";
                            }
                        } else {
                            echo "<script>Swal.fire({
                            width: 550,
                            padding: '2em',
                            position: 'center',
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
                            showConfirmButton: false,
                            showDenyButton: true,
                            denyButtonText: 'OK',
                            });
                    </script>";
                        }
                        ;
                    }
                    ?>
            </form>
        </div>
    </section>


    <script src="src/login_js.js"></script>

</body>

</html>