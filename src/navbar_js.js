var kinraidee = document.getElementById('kinraidee');
var searchbar = document.getElementById('searchy');
var main = document.getElementById('main');
var shop = document.getElementById('shop');
var review = document.getElementById('review');
var search_btn = document.getElementById('btny');
var random = document.getElementById('random');

searchbar.addEventListener("keypress", logKey);

search_btn.addEventListener("click", function(){
  localStorage.setItem("searchitem", document.getElementById('searchy').value);
  window.location.href = "./search.php";
});

function logKey(e) {      // ส่งค่าไปหน้า search.php เวลากดค้นหา
    if(e.key === 'Enter'){
      localStorage.setItem("searchitem", document.getElementById('searchy').value);
      window.location.href = "./search.php";
    };
}



function resetForm() {    //redirect ไปหน้า logout, ลบ session ออก
  $.ajax({
    type: "POST",
    url: "./src/abort.php",
    data: "action=unsetsession",
    success: function (msg) {
      window.location.href = "login.php";
    }
    ,
    error: function (msg) {
      alert('Error: cannot load page.');
    }
  });
}

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

main.addEventListener("click", function () {
  window.location.href = "./mainbuyer.php"
});

shop.addEventListener("click", function () {
  window.location.href = "./search.php"
});

review.addEventListener("click", function () {
  window.location.href = "./feed.php"
});

random.addEventListener("click", function () {
  window.location.href = "./random.php"
});

