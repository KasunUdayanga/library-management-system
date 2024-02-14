var emailValidation, userIdValidation, usernameValidation, passwordValidation;

document.addEventListener('DOMContentLoaded', function () {

  const userIdInput = document.getElementById('userId');
  userIdInput.addEventListener('keyup', checkUserIdAvailability);


});


// Function to validate email format
function isValidEmail(email) {
  const emailRegex = /\S+@\S+\.\S+/;
  return emailRegex.test(email);
}



//Check Username availability
function checkUsernameAvailability() {
  const username = document.getElementById('username').value;

  fetch('assets/php/user.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `username=${username}`
  })
    .then(response => response.json())
    .then(data => {
      if (!data.available) {
        document.getElementById('usernameError').innerText = 'Username already exists';
        document.getElementById('username').classList.remove('is-valid');
        document.getElementById('username').classList.add('is-invalid');
        usernameValidation = 1;
      } else {
        document.getElementById('username').classList.remove('is-invalid');
        document.getElementById('username').classList.add('is-valid');
        usernameValidation = 0;

      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

//Check Email availability
function checkEmailAvailability() {
  const email = document.getElementById('email').value;

  fetch('assets/php/user.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `email=${email}`
  })
    .then(response => response.json())
    .then(data => {
      if (!data.available) {
        document.getElementById('emailError').innerText = 'Email already exists';
        document.getElementById('email').classList.remove('is-valid');
        document.getElementById('email').classList.add('is-invalid');
        emailValidation = 1;

      } else {
        if (!isValidEmail(email)) {
          document.getElementById('emailError').innerText = 'Please enter a valid Email.';
          document.getElementById('email').classList.remove('is-valid');
          document.getElementById('email').classList.add('is-invalid');
          emailValidation = 1;


        } else {
          document.getElementById('email').classList.remove('is-invalid');
          document.getElementById('email').classList.add('is-valid');
          emailValidation = 0;

        }
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

//Check UserID availability
function checkUserIdAvailability() {
  const userId = "U" + document.getElementById('userId').value;

  fetch('assets/php/user.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `userId=${userId}`
  })
    .then(response => response.json())
    .then(data => {
      if (!data.available) {
        document.getElementById('userIdError').innerText = 'User ID already exists';
        document.getElementById('userId').classList.remove('is-valid');
        document.getElementById('userId').classList.add('is-invalid');
        userIdValidation = 1;

      } else {

        if (!document.getElementById('userId').value == "") {

          document.getElementById('userId').classList.remove('is-invalid');
          document.getElementById('userId').classList.add('is-valid');
          userIdValidation = 0;
        } else {
          document.getElementById('userId').classList.remove('is-valid');
          document.getElementById('userId').classList.add('is-invalid');
          userIdValidation = 1;

        }


      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

//check password
function checkPassword() {
  const password = document.getElementById('password').value;

  if (password.length < 8) {
    document.getElementById('passwordError').innerText = 'Password must be at least 8 characters.';
    document.getElementById('password').classList.remove('is-valid');
    document.getElementById('password').classList.add('is-invalid');
    passwordValidation = 1;
  } else {
    document.getElementById('passwordError').innerText = '';
    document.getElementById('password').classList.remove('is-invalid');
    document.getElementById('password').classList.add('is-valid');
    passwordValidation = 0;

  }
  



}

