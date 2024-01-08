function findFood(answer){
        $.ajax({
            url: "./src/fetch_answer.php",
            method: "POST",
            data: {
                query: answer,
            },
            success: function (data) {
                $('#result').html(data);
            }
        });
    };