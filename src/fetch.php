<?php
date_default_timezone_set('Asia/Bangkok');
$user_time = date("H:i:s");
$servername = "35.240.190.9";
$username = "test1";
$password = "test1";
$dbname = "Cs251_project";
//fetch.php
$connect = mysqli_connect($servername, $username, $password, $dbname);
$connect->set_charset("utf8");
$output = '';
$count = 1;

//  ------------------------------------ > Dont remove this code, < -----------------------------------------------------------

// $query = "SELECT r.restaurant_id, r.restaurant_name, r.photo, r.open_time, r.close_time, 
//           SUM(rv.star) AS total_review_star, 
//           COUNT(rv.star) AS total_review_count,
//           CASE  WHEN r.open_time < '$user_time' AND r.close_time > '$user_time' THEN 1
//                 ELSE 0
//                 END AS is_open
//           FROM restaurant r
//           JOIN review rv ON r.restaurant_id = rv.restaurant_id
//           WHERE restaurant_name LIKE '%" . $search . "%'
//           GROUP BY r.restaurant_id, r.restaurant_name
//           ORDER BY is_open DESC,
//                    total_review_star DESC";




if (isset($_POST["query"])) {
  //$sort = $_POST["sort"];


  

  $search = mysqli_real_escape_string($connect, $_POST["query"]);
  $query = "SELECT r.restaurant_id, r.restaurant_name, r.photo, r.open_time, r.close_time, 
          SUM(rv.star) AS total_review_star, 
          COUNT(rv.star) AS total_review_count,
          CASE  WHEN r.open_time < '$user_time' AND r.close_time > '$user_time' THEN 1
                ELSE 0
                END AS is_open
          FROM restaurant r
          LEFT JOIN review rv ON r.restaurant_id = rv.restaurant_id
          LEFT JOIN food f ON f.restaurant_id = r.restaurant_id
          WHERE restaurant_name LIKE '%" . $search . "%'
          OR food_name LIKE '%" . $search . "%'
          GROUP BY r.restaurant_id, r.restaurant_name
          ORDER BY is_open DESC,
                   total_review_star DESC
          LIMIT 30";
  
  // $query = "
  //           SELECT * FROM restaurant , food
  //           WHERE restaurant_name LIKE '%" . $search . "%'
  //           OR food_name LIKE '%" . $search . "%'
  //     ";
} else {
  $query = "
  SELECT * FROM restaurant
  WHERE restaurant_id = 1;
 ";
}
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
  $output .= '
    
  <div class="container-sub style">
 ';
  //  <td>' . $row["close_time"] . '</td>
//     <td><img src="data:image/jpeg;base64,' . base64_encode($row["photo"]) . '" style="width:30%;"></td>
  while ($row = mysqli_fetch_array($result)) {
    $id = $row['restaurant_id'];
    $querycount =
    "SELECT 
    (SELECT COUNT(*) FROM food WHERE restaurant_id = '$id') AS allfoodcount,
    (SELECT COUNT(*) FROM food WHERE restaurant_id = '$id' AND food_name LIKE '%$search%') AS foodcount";
      ;
    $resultcount = mysqli_query($connect,$querycount);
    //$trueReviewCount ="0";

    if(mysqli_num_rows($resultcount) > 0){
      $rowcount = mysqli_fetch_array($resultcount);
      if($rowcount["foodcount"] >0){
        $trueReviewCount = $row["total_review_count"]/$rowcount["foodcount"];
      }else{
        $trueReviewCount = $row["total_review_count"] /$rowcount["allfoodcount"];
      }
    }
    
    $output .= '
                            
                            
      <div class="container-inside" style="cursor: pointer;">
        <img class="img2" onclick="test(' . $row["restaurant_id"] . ')" src="data:image/jpg;base64,' . base64_encode($row["photo"]) . '">
          <div class="restaurant-name">'
      . '<b>' . $row["restaurant_name"] . '</b>'
   . '</div>
      <div class="restaurant-info">
        <img src="img/yellowstarpng.png" width="20px" height="20px" style="margin-top:-5%"> </img>
        <span>' . ($row["total_review_count"] != 0 ? number_format($row["total_review_star"] / $row["total_review_count"], 1) : 0) . ' </span>
        <span>(' . $trueReviewCount . ' รีวิว) </span><br>';


    
    if ($user_time >= $row["open_time"] && $user_time <= $row["close_time"]) {
      $output .= '<p1 class="restaurant-time-open">เปิดอยู่</p1>
        <span> ถึง ' . date('H:i', strtotime($row["close_time"])) . '</span>
        </div>
    </div>';
    } else {
      $output .= '<p1 class="restaurant-time-close">ปิดแล้ว</p1>
        <span> เปิด ' . date('H:i', strtotime($row["open_time"])) . '</span>
        </div>
    </div>';
    }
    if ($count == 5) {
      $count = 1;
      $output .= '
        </div>
        <div class="container-sub">';
      //print only 6 restaurant
      //$count = 1;

    } else {
      $count++;
    }
  }
  echo $output;
} else {
  $output .= '<center><p2> ไม่พบเมนูอาหาร :( </p2></center>';
  echo $output;
}

?>