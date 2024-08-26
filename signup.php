<?php
include_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | To Do List</title>
  <link href="assets/css/signup.css" rel="stylesheet">
  <link rel="shortcut icon" href="icons/head.png" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="assets/js/tailwind.js"></script>
</head>

<body>

  <div>
    <div class="signup min-h-[100vh] flex bg-[#27699c58] items-center justify-center ">
      <div class="signup-card md:min-h-[50vh] w-[90%] lg:w-[60%] flex flex-col-reverse md:flex-row rounded-xl my-2 shadow-2xl">
        <div class="left w-full lg:w-[50%] p-8 bg-white flex flex-col justify-start ">
          <div class='text-[#2e3e6a] text-3xl py-4'>Sign Up</div>
          <form action="endpoints/signupSubmit.php" method="POST" class='flex flex-col w-full' onsubmit="return validatePasswords()">
            <div class="flex sm:flex-row flex-col w-full">
              <input class="p-2 my-1 w-full sm:w-[50%] sm:mr-2 text-black border-b-2" type="text" name="fname" id="fname" placeholder='First Name' />
              <input class="p-2 my-1 w-full sm:w-[50%] sm:mr-l text-black border-b-2" type="text" name="lname" id="lname" placeholder='Last Name' />
            </div>
            <input class="p-2 my-1 text-black border-b-2" type="email" name="email" id="email" placeholder='Email' />
            <div class='flex sm:flex-row flex-col w-full'>
              <input class="p-2 my-1 w-full sm:w-[50%] sm:mr-2 text-black border-b-2" type="password" name="password" id="password" placeholder='Password' />
              <input class="p-2 my-1 w-full sm:w-[50%] sm:mr-l text-black border-b-2" type="password" name="confirm_password" id="confirm_password" placeholder='Confirm Password' />
            </div>
            <input class="p-2 my-1 text-black border-b-2" type="number" name="contact" id="contact" placeholder='Contact' />
            <button name="submit" type="submit" class='my-2 w-[100px] py-1 md:py-2 border border-black bg-[#0daca3] text-[#2e3e6a] rounded-lg hover:bg-[#2e3e6a] hover:text-white'>Sign Up</button>
          </form>
        </div>
        <div class="right w-full lg:w-[50%] p-8 gap-1 md:gap-2 flex flex-col justify-between">
          <div>
            <a href="index.php" class='text-xl md:text-2xl'><strong class='text-[#2e3e6a] text-xl md:text-2xl lg:text-4xl'>File</strong><strong class='text-[#0daca3] text-xl md:text-2xl lg:text-4xl'>Share</strong></a>
            <div class='text-md md:text-xl text-white'>Share Files with Ease ... </div>
          </div>
          <div>
            <div class='text-white text-lg'>Already have an account?</div>
            <a href="login.php"><button type="submit" class='w-[100px] py-1 md:py-2 border bg-[#2e3e6a] text-[#0daca3] rounded-lg hover:bg-[#0daca3] hover:text-white'>Login</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function validatePasswords() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;
      if (password !== confirmPassword) {
        alert("Passwords do not match. Please try again.");
        return false;
      }
      return true;
    }
  </script>

</body>

</html>
