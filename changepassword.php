<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/changepassword_css.css">
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
        <div class="changepassword">
            <form id="changepassword" name="changepassword" method="post" >

                <div class="login" width="150" height="100">
                    <div class="inputBox" style="position: relative;">

                        <div class="container-changepassword" style="margin-top: 12%;">

                            <div class="container-changepassword-plus2">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" required>
                                    <label for="username" class="form-label" id="userlabel">Email</label>
                                </div>

                            </div>

                        </div>

                        <div class="container-changepassword">

                            <div class="container-changepassword-plus">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="fname" id="fname" required>
                                    <label for="fname" class="form-label" id="fnamelabel">First Name</label>
                                </div>

                            </div>

                            <div class="container-changepassword-plus">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="lname" id="lname" required>
                                    <label for="lname" class="form-label" id="lnamelabel">Last Name</label>
                                </div>

                            </div>

                        </div>

                        <div class="container-changepassword">

                            <div class="container-changepassword-plus2">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" id="phone" required>
                                    <label for="phone" class="form-label" id="phonelabel">Phone Number</label>
                                </div>

                            </div>

                        </div>

                        <div class="container-changepassword">

                            <div class="container-changepassword-plus">

                                <div class="form-group">
                                    <input type="password" class="form-control" name="newpass" id="newpass" required>
                                    <label for="newpass" class="form-label" id="newpasslabel">New Password</label>
                                    <!-- <span style="position: absolute;" id="neweye"><i class="fas fa-eye-slash"></i></span> -->
                                </div>

                            </div>

                            <div class="container-changepassword-plus">

                                <div class="form-group">
                                    <input type="password" class="form-control" name="confirmpass" id="confirmpass"
                                        required>
                                    <label for="confirmpass" class="form-label" id="confirmpasslabel">Confirm
                                        Password</label>
                                    <!-- <span style="position: absolute;" id="eye"><i class="fas fa-eye-slash"></i></span> -->
                                </div>

                            </div>

                        </div>

                        <div class="container-changepassword" style="margin-top: 7%;">

                            <div class="container-changepassword-plus2">

                                <div class="inputBox" style="width: 50%; margin: auto;">
                                    <input class="submit" type="submit" value="submit" id="submit" name="submit">
                                </div>

                            </div>

                        </div>

                        <!-- <input type="password" name="password" id="password" placeholder="Password" style="margin-top: 4%;"
                            style="margin-top:3%" required>
                        <div class="info">
                            <small id="text2"></small>
                        </div> -->



                        <!-- <div class="group" style="margin: auto;width: 100%;text-align: right;padding: 5%;padding-right: 0%;">
                            <a href="#">Forget Password?</a>
                        </div>
                        <div style="margin-top: 8%;text-align: center;">
                            <p style="border-top: 1px solid #c2c2c2;width: 100%;"></p>
                            <div style="margin-top: 4%;" class="chrome">
                                <a href="register.php" style="text-decoration: none;color:rgb(123, 123, 123);font-size: 90%;">register for an account</a>
                            </div>
                        </div> -->
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
                    if(isset($_POST['submit'])){
                        $email = $_POST['username'];
                        $full_name = $_POST['fname'];
                        $last_name = $_POST['lname'];
                        $phone = $_POST['phone'];
                        $new_pass = $_POST['newpass'];
                        $confirm_pass = $_POST['confirmpass'];   
                        $query = " SELECT * FROM user WHERE email='$email' ";
                        $result = mysqli_query($conn,$query);
                        if($row = mysqli_fetch_assoc($result)){
                            if($row['email']==$email && $row['full_name']==$full_name && $row['last_name']==$last_name && $row['phone']== $phone ){
                                if($new_pass==$confirm_pass){
                                    $stmt = mysqli_prepare($conn, "UPDATE user SET password=? WHERE email = '$email' ");
                                    mysqli_stmt_bind_param($stmt, "s", $confirm_pass);
                                    mysqli_stmt_execute($stmt);
            
                                    if(mysqli_stmt_errno($stmt)){
                                       echo "Error to updated: " . mysqli_stmt_error($stmt);
                                       } else {
                                        echo "<script>Swal.fire({
                                            width: 550,
                                            padding: '2em',
                                            position: 'center',
                                            icon: 'success',
                                            title: 'แก้ไขรหัสผ่านเรียบร้อย',
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
                                                window.location = 'login.php';
                                            });
                                            </script>";
                                       }   
                                }else{
                                    echo "<script>Swal.fire({
                                        width: 550,
                                        padding: '2em',
                                        position: 'center',
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'รหัสผ่านไม่ตรงกัน :[',
                                        showConfirmButton: false,
                                        showDenyButton: true,
                                        denyButtonText: 'OK',
                                        });
                                    </script>";
                                }
                               
                            }else{
                                echo "<script>Swal.fire({
                                    width: 550,
                                    padding: '2em',
                                    position: 'center',
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'มีบางอย่างในนี้ไม่ถูกต้อง อีเมล ชื่อ นามสกุล เบอร์โทร :)',
                                    showConfirmButton: false,
                                    showDenyButton: true,
                                    denyButtonText: 'OK',
                                    });
                                </script>";
                            }   
                        }else{
                            echo "<script>Swal.fire({
                                width: 550,
                                padding: '2em',
                                position: 'center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'มีบางอย่างในนี้ไม่ถูกต้อง อีเมล ชื่อ นามสกุล เบอร์โทร  :3',
                                showConfirmButton: false,
                                showDenyButton: true,
                                denyButtonText: 'OK',
                                });
                            </script>";
                        }   
                        
                    }
                    ?>
            </form>
        </div>
    </section>


    <script src="src/changepassword_js.js"></script>

</body>

</html>