<?php 
    $servername = "35.240.190.9";
    $username = "test1";
    $password = "test1";
    $dbname = "Cs251_project";
    //fetch.php
    $connect = mysqli_connect($servername, $username, $password, $dbname);
    $connect->set_charset("utf8");
    $output = '';
    $count = 1;
    

    // if (isset($_POST["query"])) {
        $keyword = explode(";",$_POST["query"]);
        
        // $search = mysqli_real_escape_string($connect, $keyword);
        // $query = "
        //           SELECT * FROM restaurant
        //           WHERE restaurant_id LIKE '%" . $search . "%'
        //           OR restaurant_name LIKE '%" . $search . "%'
        //           OR user_id LIKE '%" . $search . "%' 
        //     ";
        // ,
        //             ((  CASE WHEN 'type' LIKE '%" .$keyword[0] . "%' THEN 1 ELSE 0 END +
        //                 CASE WHEN 'type' LIKE '%" .$keyword[1] . "%' THEN 1 ELSE 0 END +
        //                 CASE WHEN 'type' LIKE '%" .$keyword[2] . "%' THEN 1 ELSE 0 END +
        //                 CASE WHEN 'type' LIKE '%" .$keyword[3] . "%' THEN 1 ELSE 0 END) / 4.0) * 100 AS match_percent
        // ORDER BY match_percent DESC
        $query = "SELECT *,
                    ((CASE WHEN food_type LIKE '%" . $keyword[0] . "%' THEN 1 ELSE 0 END +
                    CASE WHEN food_type LIKE '%" . $keyword[1] . "%' THEN 1 ELSE 0 END +
                    CASE WHEN food_type LIKE '%" . $keyword[2] . "%' THEN 1 ELSE 0 END +
                    CASE WHEN food_type LIKE '%" . $keyword[3] . "%' THEN 1 ELSE 0 END) / 4.0) * 100 AS match_percent
                FROM food
                JOIN restaurant ON food.restaurant_id = restaurant.restaurant_id
                WHERE food_type LIKE '%" . $keyword[0] . "%' OR
                        food_type LIKE '%" . $keyword[1] . "%' OR
                        food_type LIKE '%" . $keyword[2] . "%' OR
                        food_type LIKE '%" . $keyword[3] . "%'
                ORDER BY match_percent DESC
                LIMIT 10;";
      
      //Show shop
      $result = mysqli_query($connect, $query);
      if (mysqli_num_rows($result) > 0) {
        $output .= '
          
        <div class="container-sub style">
       ';
        //  <td>' . $row["close_time"] . '</td>
      //     <td><img src="data:image/jpeg;base64,' . base64_encode($row["photo"]) . '" style="width:30%;"></td>
        while ($row = mysqli_fetch_array($result)) {
          $output .= '
         <div class="container-inside">
           <img class="img2" onclick="test(' . $row["restaurant_id"] . ')" src="data:image/jpg;base64,' .
            base64_encode($row["photofd"]) . '">
           <div class="restaurant-name">' 
           . '<b>' . $row["food_name"] . '</b>' 
           . '</div>'
              . $row["restaurant_name"] . '<br>' . $row["price"] . ' บาท'. '
           </div>
        ';
          if ($count == 6) {
            $count = 1;
            $output .= '
                              </div>
                              <div class="container-sub">
                                  
                          ';
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

