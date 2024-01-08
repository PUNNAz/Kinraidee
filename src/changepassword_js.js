const form = document.querySelector('#changepassword');

const pass_reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
const email_reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
const firstname_reg = /^[a-zA-Zก-๏\s]{1,255}$/;
const lname_reg = /^[a-zA-Zก-๏\s]{1,255}$/;
const phone_reg = /^[0-9]{10,}$/;

let email = form.elements.namedItem("username");
let fname = form.elements.namedItem("fname");
let lname = form.elements.namedItem("lname");
let phone = form.elements.namedItem("phone");
let newpass = form.elements.namedItem("newpass");
let confirmpass = form.elements.namedItem("confirmpass");

// let autofilledInput = document.querySelector('input:-webkit-autofill');

// if (autofilledInput) {
//     autofilledInput.addEventListener('input', function (event) {
//         console.log('Autofill detected!');
//         // You can perform any action here, such as displaying a message on the screen
//     });
// } else {
//     console.log('Autofill input not found');
// }

let userlabel = document.getElementById("userlabel");
let fnamelabel = document.getElementById("fnamelabel");
let lnamelabel = document.getElementById("lnamelabel")
let phonelabel = document.getElementById("phonelabel")
let newpasslabel = document.getElementById("newpasslabel")
let confirmpasslabel = document.getElementById("confirmpasslabel")

email.addEventListener('onautocomplete', validate);
email.addEventListener('input', validate);
fname.addEventListener('input', validate);
lname.addEventListener('input', validate);
phone.addEventListener('input', validate);
newpass.addEventListener('input', validate);
confirmpass.addEventListener('input', validate);

form.addEventListener('submit', function (e) {
    //e.preventDefault();
    usernameValue = document.getElementById("username").value;
    fnameValue = document.getElementById("fname").value;
    lnameValue = document.getElementById("lname").value;
    phoneValue = document.getElementById("phone").value;
    newPasswordValue = document.getElementById("newpass").value;
    confirmPasswordValue = document.getElementById("confirmpass").value;


    if (usernameValue == "" || fnameValue == '' || lnameValue == '' || phoneValue == '' || newPasswordValue == '' || confirmPasswordValue == '') {
        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
        return false;
    };

    //text2.innerHTML = "รหัสผ่านผิดพลาด!";

    //alert('เข้าสู่ระบบสำเร็จ');
    window.location.href = "/real/test1.php";
    //  return true;
});

function isNumeric(value) {
    return /^-?\d+$/.test(value);
}

function validate(e) {

    if (e.target.name == "username") {
        if (e.target.value.match(email_reg)) {
            userlabel.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            userlabel.innerHTML = "Example@Example.com";
            e.target.setCustomValidity("Example@Example.com");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "fname") {
        if (e.target.value.match(firstname_reg)) {
            fnamelabel.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            fnamelabel.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "lname") {
        if (e.target.value.match(lname_reg)) {
            lnamelabel.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            lnamelabel.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "phone") {
        if (e.target.value.match(phone_reg)) {
            phonelabel.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            phonelabel.innerHTML = "ต้องมีตัวเลข 10 ตัว";
            e.target.setCustomValidity("ต้องมีตัวเลข 10 ตัว");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "newpass") {
        pass_reg.test(e.target.value)
        if (e.target.value.match(pass_reg)) {
            newpasslabel.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            newpasslabel.innerHTML = "รูปแบบของรหัสผ่านไม่ถูกต้อง";
            e.target.setCustomValidity("รูปแบบของรหัสผ่านไม่ถูกต้อง");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "confirmpass") {
        pass_reg.test(e.target.value)
        if (e.target.value.match(pass_reg)) {
            confirmpasslabel.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            confirmpasslabel.innerHTML = "รูปแบบของรหัสผ่านไม่ถูกต้อง";
            e.target.setCustomValidity("รูปแบบของรหัสผ่านไม่ถูกต้อง");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

}

const Password = document.querySelector("#newpass");
let Checkbox = document.querySelector("#neweye");


// Checkbox.addEventListener('click', function () {
//     const type = Password.getAttribute("type") === "newpass" ? "text" : "newpass";
//     Checkbox.innerHTML = Checkbox.innerHTML == '<i class="fas fa-eye"></i>' ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
//     Password.setAttribute("type", type);

// });