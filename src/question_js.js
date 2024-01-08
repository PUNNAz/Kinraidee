var kinraidee = document.getElementById('kinraidee');
var choice_1 = document.getElementById('choice_1');
var choice_2 = document.getElementById('choice_2');
var choice_3 = document.getElementById('choice_3');
var choice_4 = document.getElementById('choice_4');
    

kinraidee.addEventListener("click", function () {
    $.ajax({
        type: "POST",
        url: "./src/questionsession.php",
        data: "action=setQuest_id",

        success: function (msg) {
            window.location.href = "question.php";
        }
        ,
        error: function (msg) {
            alert('Error: cannot load page.');
        }
    });

});

choice_1.addEventListener("click", function () {
    $.ajax({
        type: "POST",
        url: "./src/questionsession.php",
        data: {action :'inc_value',
            choice : '1'
        },
        success: function (msg) {
            $('#responseContainer').html(msg);
            window.location.href = "question.php";

        }
        ,
        error: function (msg) {
            alert('Error: cannot load page.');
        }
    });

});
choice_2.addEventListener("click", function () {
    $.ajax({
        type: "POST",
        url: "./src/questionsession.php",
        data: {action :'inc_value',
            choice : '2'
        },
        success: function (msg) {
            window.location.href = "question.php";
        }
        ,
        error: function (msg) {
            alert('Error: cannot load page.');
        }
    });

});
choice_3.addEventListener("click", function () {
    $.ajax({
        type: "POST",
        url: "./src/questionsession.php",
        data: {action:'inc_value',
            choice : '3'
        },
        success: function (msg) {
            window.location.href = "question.php";
        }
        ,
        error: function (msg) {
            alert('Error: cannot load page.');
        }
    });

});

choice_4.addEventListener("click", function () {
    $.ajax({
        type: "POST",
        url: "./src/questionsession.php",
        data: {action:'inc_value',
            choice : '4'
        },

        success: function (msg) {
            window.location.href = "question.php";
        }
        ,
        error: function (msg) {
            alert('Error: cannot load page.');
        }
    });

});


