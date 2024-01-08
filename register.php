<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register_css.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
	crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Register</title>
</head>

<body>
    <img src="img/logo1.png" class="bg">
    <section>
        <div class="container">
            <div class="title">Registration</div>,
            <form action="#" id="Editform" name="Editform" method="post" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" placeholder="Enter your Email" required id="email" name="email">
                        <p class="textID" id="text"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" placeholder="Enter your Password" required id="password" name="password">
                        <p class="textID" id="text1"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" placeholder="Enter your First Name" required id="fname" name="fname">
                        <p class="textID" id="text2"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" placeholder="Enter your Last Name" required id="lname" name="lname">
                        <p class="textID" id="text3"></p>
                    </div>

                    <div class="input-box">
                        <span class="details">Home No.</span>
                        <input type="text" placeholder="Enter your Home No." required id="hnum" name="hnum">
                        <p class="textID" id="text4"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Subdistrict</span>
                        <input type="text" placeholder="Enter your Subdistrict" required id="subdistrict"
                            name="subdistrict">
                        <p class="textID" id="text5"></p>
                    </div>

                    <div class="input-box">
                        <span class="details">District</span>
                        <input type="text" placeholder="Enter your District" required id="district" name="district">
                        <p class="textID" id="text6"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Province</span>
                        <input type="text" placeholder="Enter your Province" required id="province" name="province">
                        <p class="textID" id="text7"></p>
                    </div>
                    <div class="input-box">
                        <span class="details">Postal Code</span>
                        <input type="text" placeholder="Enter your Postal Code" required id="posnum" name="posnum">
                        <p class="textID" id="text8"></p>
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" placeholder="Enter your Phone Number" required id="phonenum" name="phonenum">
                        <p class="textID" id="text9"></p>
                    </div>
                </div>

                <div class="user-parts">
                    <span class="user-title">Buyer/Seller</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <input type="radio" name="user" id="user" value="0" required>
                            <span class="user">Buyer</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <input type="radio" name="user" id="user" value="1" required>
                            <span class="user">Seller</span>
                        </label>
                </div>
                <div id="HERE" ></div>
                    <div>
                        <strong>Select Image:</strong>
                        <input type="file" id="uploadfile" name="uploadfile">

                    </div>
                    <div>
                <div>
                    <br><br>
                    <input type="submit" class="btn" id="btn" value="Register" name="submit">
                </div>

                <?php 
            $servername = "35.240.190.9";
            $dbusername = "test";
            $dbpassword = "test";
            $dbname = "Cs251_project";
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);


            if(!$conn){
                die("Connection failed: " . mysqli_connect_error());
            }
            if (isset($_FILES['uploadfile']['error'])) {
                $uploadError = $_FILES['uploadfile']['error'];
                if ($uploadError !== UPLOAD_ERR_OK) {
                    echo "<script>Swal.fire({
                        width: 550,
                        padding: '2em',
                        position: 'center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'การอัพโหลดรูปมีปัญหา หรือ กรุณาอัพโหลดรูป',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK',
                        });
                    </script>";
                } 
                else {
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
                $is_seller = $_POST['user'] ;
                $addPhone = $_POST['phonenum'] ;
                $query = " SELECT * FROM user WHERE email='$email' ";
                $result = mysqli_query($conn,$query);
                if($row = mysqli_fetch_assoc($result)){
                echo "<script>Swal.fire({
                    width: 550,
                    padding: '2em',
                    position: 'center',
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'อีเมลถูกใช้ไปเรียบร้อยเเล้ว',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK',
                    });
                </script>";
                }
                else{
                 if($is_seller === "0"){
                    $stmt = mysqli_prepare($conn, "INSERT INTO user (email, password, full_name, last_name, no_home, subdistrict, district, province, postal_code, is_seller, phone , photo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,'$imgData')");
                  
                    // Bind the values to the prepared statement    
                    mysqli_stmt_bind_param($stmt, "ssssssssiis", $email, $password, $full_name, $last_name, $no_home, $subdistrict, $district, $province, $postal_code, $is_seller, $addPhone );
        
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
                            title: 'สมัครสมาชิกสำเร็จ',
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
                    }
                    else{
                        $stmt = mysqli_prepare($conn, "INSERT INTO user (email, password, full_name, last_name, no_home, subdistrict, district, province, postal_code, is_seller, phone , photo) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,'$imgData')");
                           
                        // Bind the values to the prepared statement    
                        mysqli_stmt_bind_param($stmt, "ssssssssiis", $email, $password, $full_name, $last_name, $no_home, $subdistrict, $district, $province, $postal_code, $is_seller, $addPhone );
                        // Execute the statement
                        mysqli_stmt_execute($stmt);
                        // $images = "INSERT INTO user (photo) VALUES ($imgData)";
                        // $upload = mysqli_query($conn, $images);
                        if(mysqli_stmt_errno($stmt)){
                         echo "Error inserting record: " . mysqli_stmt_error($stmt);
                         } else {
                                    $query1 = " SELECT * FROM user WHERE email='$email' ";
                                    $userid = mysqli_query($conn,$query1);
                                    $row1 = mysqli_fetch_array($userid) ;
                                    $id = $row1['user_id'];
                                    $stmt2 = mysqli_prepare($conn, "INSERT INTO restaurant (user_id,restaurant_name,open_time,close_time,photo ) 
                                    VALUES ('$id',NULL,NULL,NULL,NULL)");
                                    mysqli_stmt_execute($stmt2);

                                    if(mysqli_stmt_errno($stmt2)){
                                        echo "Error inserting record: " . mysqli_stmt_error($stmt2);
                                        } else{
                                            echo "<script>Swal.fire({
                                                width: 550,
                                                padding: '2em',
                                                position: 'center',
                                                icon: 'success',
                                                title: 'สมัครสมาชิกสำเร็จสำหรับผู้ขายสำเร็จ',
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
                                }    
                               
                               
                    }
                }
                
                }
            }
                        
                    
        
            
                ?>
            </form>
        </div>
        
    </section>
    <script src='src/validate_js.js'></script>

</script>
<!-- <script type="text/javascript">
    $(document).ready(function (e) {
    	$("#image-upload-form").on('submit',(function(e) {
    		e.preventDefault();
    		$.ajax({
            	url: "upload.php",
    			type: "POST",
    			data:  new FormData(this),
    			contentType: false,
        	    cache: false,
    			processData: false,
    			success: function(data)
    		    {
    				$("#targetLayer").html(data);
    		    },
    		  	error: function(data)
    	    	{
    		  	  console.log("error");
                  console.log(data);
    	    	}
    	   });
    	}));
    }); -->
</script>
</body>

</html>