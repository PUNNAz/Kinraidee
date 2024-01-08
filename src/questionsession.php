<?php
session_start();
$servername = "35.240.190.9";
    $dbusername = "test1";
    $dbpassword = "test1";
    $dbname = "Cs251_project";
    $quest_id = $_SESSION['quest_id'];
    $kw = "";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }
    $conn->set_charset("utf8");
if($_POST['action'] == 'setQuest_id'){
    $_SESSION['quest_id']=1;
    $_SESSION['kw']="";
}

if($_POST['action']=='inc_value'){
    if(isset($_POST['choice'])){
        $query = "
        SELECT * FROM question
        WHERE quest_id = '$quest_id'
        ";
         $result = mysqli_query($conn, $query);
         $row = mysqli_fetch_array($result);
         
         //$kw = $row['choice_'.$_POST["choice"].''];
         $kw = $row['choice_' . $_POST['choice'] . ''];
         $query1 = "
        SELECT * FROM keyword
        WHERE  keywords =  '$kw' 
        ";
         $result1 = mysqli_query($conn, $query1);
         $row2 = mysqli_fetch_array($result1);
         //echo "<script>alert(".$row2["translate"].")</script>";
          //echo "<script>alert(keyword: " . $_SESSION['kw'] . ")/>";
         $_SESSION['kw'] .= ";".$row2['translate'];
    }
    $_SESSION['quest_id']++;
}
?>