function test(id){          //ส่งค่า id restaurant ไปหน้าถัดไป
    window.location.href = "seller.php?id="+id;
    //<?php echo $_SESSION['"+id+"']; ?>";
}

function editfood(id) {          //ส่งค่า id restaurant ไปหน้าถัดไป
    window.location.href = "editfood.php?id=" + id;
    //<?php echo $_SESSION['"+id+"']; ?>";
}





// //const targetEl = document.querySelector('.container-inside');
// const changeEl = document.querySelectorAll('.container-inside');
// const targetEl = document.querySelectorAll(".container-inside").forEach(elem => elem.addEventListener("mouseover",
//  () => {
//     changeEl.classList.add('activey');
//   }));
// // targetEl.addEventListener('mouseover', () => {
// //     //changeEl.style.backgroundColor = 'red';
// //     changeEl.classList.add('activey');
// // });

// targetEl.addEventListener('mouseout', () => {
//     //changeEl.style.backgroundColor = '';
//     changeEl.classList.remove('activey');
// });


