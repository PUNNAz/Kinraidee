document.getElementById("searchy").value = localStorage.getItem("searchitem");
localStorage.removeItem("searchitem");

var delayTimer;

function load_data(query, sort) {
    $.ajax({
        url: "./src/fetch.php",
        method: "POST",
        data: {
            query: query,
            sort: sort
        },
        success: function (data) {
            $('#result').html(data);
        }
    });
}

function search(){
    ele = document.getElementById('searchcount');
    var search = document.getElementById("searchy").value;
    var sort = "restaurant_id";
    if (search != '') {
        load_data(search, sort);
        ele.innerHTML = "กำลังแสดงผลการค้นหาของ( " + document.getElementById("searchy").value + " )";
    } else {
        load_data('', sort);
        ele.innerHTML = "ร้านค้าทั้งหมด";
    }

    $('#searchy').keyup(function () {
        var search = document.getElementById("searchy").value;
        if (search != '') {
            document.getElementById('searchcount').innerHTML = "กำลังแสดงผลการค้นหาของ( " + $(this).val() + " )";

        } else {
            document.getElementById('searchcount').innerHTML = "ร้านค้าทั้งหมด";

        }
    });

    $('#searchy').keyup(function () {
        var search = document.getElementById("searchy").value;

        clearTimeout(delayTimer);
        var search = $(this).val();
        var sort = "restaurant_id";

        delayTimer = setTimeout(function () {
            if (search != '') {

                    load_data(search, sort);
                    document.getElementById('searchcount').innerHTML = "กำลังแสดงผลการค้นหาของ( " + $(this).val() + " )";

            } else {

                    load_data('', sort);
                    document.getElementById('searchcount').innerHTML = "ร้านค้าทั้งหมด";

            }
        }, 500);


        
    });
}
$(document).ready(search);



