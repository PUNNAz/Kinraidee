const form = document.querySelector('#Editform');
const pass_reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
const email_reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
const firstname_reg = /^[a-zA-Zก-๏\s]{1,255}$/;
const lname_reg = /^[a-zA-Zก-๏\s]{1,255}$/;
const hnum_reg = /^[a-zA-Zก-๏\s0-9/]{1,255}$/;
const s_reg = /^[a-zA-Zก-๏\s0-9]{1,255}$/;
const d_reg = /^[a-zA-Zก-๏\s0-9]{1,255}$/;
const p_reg = /^[a-zA-Zก-๏\s0-9]{1,255}$/;
const pos_reg = /^[0-9]{5,}$/;
const phone_reg = /^[0-9]{10,}$/;



let email = form.elements.namedItem("email");
let password = form.elements.namedItem("password");
let fname = form.elements.namedItem("fname");
let lname = form.elements.namedItem("lname");
let hnum = form.elements.namedItem("hnum");
let sub = form.elements.namedItem("subdistrict");
let dis = form.elements.namedItem("district");
let pro = form.elements.namedItem("province");
let pos = form.elements.namedItem("posnum");
let phone = form.elements.namedItem("phonenum");



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
let text1 = document.getElementById("text1");
let text2 = document.getElementById("text2")
let text3 = document.getElementById("text3")
let text4 = document.getElementById("text4")
let text5 = document.getElementById("text5")
let text6 = document.getElementById("text6")
let text7 = document.getElementById("text7")
let text8 = document.getElementById("text8")
let text9 = document.getElementById("text9")





email.addEventListener('onautocomplete', validate);
email.addEventListener('input', validate);
password.addEventListener('input', validate);
fname.addEventListener('input', validate);
lname.addEventListener('input', validate);
hnum.addEventListener('input', validate);
sub.addEventListener('input', validate);
dis.addEventListener('input', validate);
pro.addEventListener('input', validate);
pos.addEventListener('input', validate);
phone.addEventListener('input', validate);




form.addEventListener('submit', function (e) {
    //e.preventDefault();
    usernameValue = document.getElementById("email").value;
    passwordValue = document.getElementById("password").value;
    fnameValue = document.getElementById("fname").value;
    lnameValue = document.getElementById("lname").value;
    hnumValue = document.getElementById("hnum").value;
    subValue = document.getElementById("subdistrict").value;
    disValue = document.getElementById("district").value;
    proValue = document.getElementById("province").value;
    posValue = document.getElementById("posnum").value;
    phoneValue = document.getElementById("phonenum").value;

    if (usernameValue == "" || passwordValue == "" || fnameValue == '' || lnameValue == '' || hnumValue == '' || subValue == '' || disValue == '' || proValue == '' || posValue == '' || phoneValue == '') {
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
    if (e.target.name == "password") {
        //pass_reg.test(e.target.value)
        if (e.target.value.match(pass_reg)) {
            text1.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text1.innerHTML = "มีตัวอักษร[a-z], [A-Z] ต้องมากกว่า 6 ตัว";
            e.target.setCustomValidity("มีตัวอักษร[a-z], [A-Z] ต้องมากกว่า 6 ตัว");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "email") {
        if (e.target.value.match(email_reg)) {
            text.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text.innerHTML = "Example@Example.com";
            e.target.setCustomValidity("Example@Example.com");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "fname") {
        if (e.target.value.match(firstname_reg)) {
            text2.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text2.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "lname") {
        if (e.target.value.match(lname_reg)) {
            text3.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text3.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "hnum") {
        if (e.target.value.match(hnum_reg)) {
            text4.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text4.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "subdistrict") {
        if (e.target.value.match(s_reg)) {
            text5.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text5.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "district") {
        if (e.target.value.match(d_reg)) {
            text6.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text6.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "province") {
        if (e.target.value.match(p_reg)) {
            text7.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text7.innerHTML = "ต้องมีการกรอกข้อมูล";
            e.target.setCustomValidity("ต้องมีการกรอกข้อมูล");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "posnum") {
        if (e.target.value.match(pos_reg)) {
            text8.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text8.innerHTML = "ต้องมีตัวเลข 5 ตัว";
            e.target.setCustomValidity("ต้องมีตัวเลข 5 ตัว");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }

    if (e.target.name == "phonenum") {
        if (e.target.value.match(phone_reg)) {
            text9.innerHTML = "";
            e.target.setCustomValidity('');
            e.target.classList.add('valid');
            e.target.classList.remove('invalid');
        } else {
            text9.innerHTML = "ต้องมีตัวเลข 10 ตัว";
            e.target.setCustomValidity("ต้องมีตัวเลข 10 ตัว");
            e.target.classList.add('invalid');
            e.target.classList.remove('valid');
        }
    }
}