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

function registerUser() {

  if (emailValidation == 0 && userIdValidation == 0 && userIdValidation == 0 && passwordValidation == 0) {

    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const username = document.getElementById('username').value;
    const userId = 'U' + document.getElementById('userId').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const formData = {
      userId: userId,
      email: email,
      firstName: firstName,
      lastName: lastName,
      username: username,
      password: password
    };
  
  // Convert the JavaScript object to JSON
  const jsonData = JSON.stringify(formData);

  
    // Send form data to PHP backend using Fetch API
    fetch('assets/php/user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
    },
      //body: `userId=${userId}, email=${email}, firstName=${firstName}, lastName=${lastName}, username=${username}, password=${password}`
      body: jsonData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network Error!');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          // Insertion successful
          alert('Registration successful!');
          const form = document.getElementById('registrationForm');
          form.reset(); 
          document.getElementById('email').classList.remove('is-valid');
          document.getElementById('username').classList.remove('is-valid');
          document.getElementById('userId').classList.remove('is-valid');
          document.getElementById('password').classList.remove('is-valid');
          

        } else {
          // Insertion failed, display the error message
          alert('Registration failed: ' + data.error);
        }
      })
      .catch(error => {
        alert('There was a problem with the fetch operation: ' + error);
      });


  }

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

//Login
function userLogin() {
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;

  
    fetch('assets/php/user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `login_username=${username}&password=${password}`
    })
      .then(response => response.json())
      .then(data => {

        if (!data.status) {

            document.getElementById('errorMessage').innerText = data.error;
        } else {

            window.location.href = "index.php";


  
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
  

