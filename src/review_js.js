const form = document.getElementById('review-form');
function review(point){
    for (var i = 0; i < point; i++) {
        var count = i + 1;
        var text = "star" + count;
        document.getElementById(text).src = "./img/yellowstar.png";

    }
    for (var i = 5; i > point; i--) {
        var count = i;
        var text = "star" + count;
        document.getElementById(text).src = "./img/whitestar.png";
    }
    document.getElementById("point").value = point;
}



var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

form.addEventListener('submit', function (e) {
    let titleValue = document.getElementById("title").value;
    let commentValue = document.getElementById("comment").value;
    let pointValue = document.getElementById("point");
    let fileInput = document.getElementById("fileInput");


    if (titleValue.trim() === "") {
        e.preventDefault();
        Swal.fire({
            width: 550,
            padding: '2em',
            position: 'center',
            icon: 'warning',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอกหัวข้อการรีวิว',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'OK',
        });
        return false;
    }

    if (commentValue.trim() === "") {
        e.preventDefault();
        Swal.fire({
            width: 550,
            padding: '2em',
            position: 'center',
            icon: 'warning',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณากรอกรายละเอียดการรีวิว',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'OK',
        });
        return false;
    }

    if (pointValue.value === "0") {
        e.preventDefault();
        Swal.fire({
            width: 550,
            padding: '2em',
            position: 'center',
            icon: 'warning',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณาเลือกคะแนนการรีวิว',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'OK',
        });
        return false;
    }

    if (typeof fileInput.files[0] === "undefined") {
        e.preventDefault();
        Swal.fire({
            width: 550,
            padding: '2em',
            position: 'center',
            icon: 'warning',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณาเลือกรูปภาพ',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'OK',
        });
        return false;
    }

    // Proceed with form submission
});