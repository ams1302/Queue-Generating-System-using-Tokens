const admin = document.querySelector('.admin');
const patient = document.querySelector('.patient');

admin.style.display = 'none';
patient.style.display = 'block';

document.getElementById('login').addEventListener('click', (e) => {
    let curBtn = e.target.innerHTML;

    e.target.innerHTML = curBtn === 'Admin Login' ? 'Patient Login' : 'Admin Login';
    patient.style.display = curBtn === 'Admin Login' ? 'none' : 'block';
    admin.style.display = curBtn === 'Admin Login' ? 'block' : 'none';

});



// const password = document.getElementById('password');
// const confirmPassword = document.getElementById('confirmPassword');
// const signUpBtn = document.getElementById('sign-up');

// password.addEventListener('keyup', (e) => {
//     let passwordValue = e.target.value;
//     var upperCase = /[A-Z]/g;
//     var numbers = /[0-9]/g;

//     if (!passwordValue.match(upperCase) || !passwordValue.match(numbers) || passwordValue.length < 6) {
//         password.classList.add('is-invalid');
//         signUpBtn.disabled = true;
//     } else {
//         password.classList.remove('is-invalid');
//         signUpBtn.disabled = false;
//     }
// });

// confirmPassword.addEventListener('keyup', (e) => {
//     let confirmPasswordValue = e.target.value;

//     if (confirmPasswordValue !== password.value) {
//         confirmPassword.classList.add('is-invalid');
//         signUpBtn.disabled = true;
//     } else if (!password.classList.contains('is-invalid')) {
//         confirmPassword.classList.remove('is-invalid');
//         signUpBtn.disabled = false;
//     }
// });