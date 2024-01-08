

const form = document.querySelector('#login-form');
const pass_reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
const email_reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;

let username = form.elements.namedItem("username");
let password = form.elements.namedItem("password");

// let autofilledInput = document.querySelector('input:-webkit-autofill');

// if (autofilledInput) {
//     autofilledInput.addEventListener('input', function (event) {
//         console.log('Autofill detected!');
//         // You can perform any action here, such as displaying a message on the screen
//     });
// } else {
//     console.log('Autofill input not found');
// }

let text = document.getElementById("text");
let text2 = document.getElementById("text2");

let input1 = document.getElementById("username");
let input2 = document.getElementById("password");


username.addEventListener('onautocomplete', validate);
username.addEventListener('input', validate);
password.addEventListener('input', validate);

form.addEventListener('submit', function (e) {
    //e.preventDefault();


    let usernameValue = document.getElementById("username").value;
    let passwordValue = document.getElementById("password").value;

    if (usernameValue.match(email_reg) && passwordValue.length >=4){
        
    }else{
        e.preventDefault();
        Swal.fire({
            width: 550,
            padding: '2em',
            position: 'center',
            icon: 'warning',
            title: 'เกิดข้อผิดพลาด',
            text: 'กรุณาตรวจเช็คข้อมูลที่กรอกอีกครั้ง',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'OK',
        });
        return false;
    }

});

function isNumeric(value) {
    return /^-?\d+$/.test(value);
}

function validate(e) {
    let lebel1 = document.getElementById("userlabel");
    let lebel2 = document.getElementById("passwordlabel");

    if (e.target.name == "password") {
        //pass_reg.test(e.target.value)
        if (e.target.value.length >= 4) {
            text2.innerHTML = "";
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
            lebel2.classList.add('lebelvalid');
            lebel2.classList.remove('lebelinvalid');
            //e.target.setCustomValidity('');
        } else {
            text2.innerHTML = "<i class='fa-solid fa-circle-exclamation'></i> รหัสผ่านต้องไม่น้อยกว่า 4 ตัวอักษร";
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
            lebel2.classList.add('lebelinvalid');
            lebel2.classList.remove('lebelvalid');
            //e.target.setCustomValidity("รหัสผ่านต้องไม่น้อยกว่า 4 ตัวอักษร");
            return false;
        }
    }

    if (e.target.name == "username") {
        if (e.target.value.match(email_reg)){
            text.innerHTML = "";
            //e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
            lebel1.classList.add('lebelvalid');
            lebel1.classList.remove('lebelinvalid');
            
        }else{
            text.innerHTML = "<i class='fa-solid fa-circle-exclamation'></i> รูปแบบของ email ไม่ถูกต้อง";
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
            lebel1.classList.add('lebelinvalid');
            lebel1.classList.remove('lebelvalid');
            //e.target.setCustomValidity("อีเมลที่ต้องประกอบด้วยชุดตัวอักษร ตัวเลข หรืออักขระพิเศษ เครื่องหมาย @ และ .");
            return false;
        }
    }

    return true;
}


const Password = document.querySelector("#password");
let Checkbox = document.querySelector("#eye");


Checkbox.addEventListener('click', function () {
    const type = Password.getAttribute("type") === "password" ? "text" : "password"; 
    Checkbox.innerHTML = Checkbox.innerHTML == '<i class="fas fa-eye"></i>' ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
    Password.setAttribute("type", type);

});



