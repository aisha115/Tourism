let regBtn=document.querySelector('#register-btn');
let regForm=document.querySelector('.register-form-container');
let regClose=document.querySelector('#reg-close');


window.onscroll=()=>{
    regForm.classList.remove('active');
}

regBtn.addEventListener('click',()=>{
    regForm.classList.add('active');
    loginForm.classList.remove('active');
});

regClose.addEventListener('click',()=>{
    regForm.classList.remove('active');
});

