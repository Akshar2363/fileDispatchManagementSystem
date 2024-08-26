<script>
  var theme = document.getElementById('theme');
  var toggleBtn = document.getElementById('themeButton');

  function toggleTheme() {
    if (theme.classList.contains('theme-dark')) {
      theme.classList.remove('theme-dark');
      theme.classList.add('theme-light');
      themeButton.innerHTML = '<i class="fa-solid fa-sun text-2xl text-black"></i>';
    } else if (theme.classList.contains('theme-light')) {
      theme.classList.remove('theme-light');
      theme.classList.add('theme-dark');
      themeButton.innerHTML = '<i class="fa-solid fa-moon text-2xl text-white"></i>';
    }
  }

  function toggleMenu() {
    var navbar = document.getElementById('navbarSmall');
    var menuBtn = document.getElementById('toggleBtn');
    var overlay = document.getElementById('overlay');

    navbar.classList.toggle('hidden');
    menuBtn.classList.toggle('btn-open');
    overlay.classList.toggle('hidden');
  }
</script>

<?php

if (isset($_SESSION['userID'])) {
?>

  <nav class="navbarBody flex flex-row items-center p-4 justify-between shadow-xl">
    <a href="index.php">
      <div class="logo flex flex-row items-center gap-3 text-3xl font-bold">
        <img src="assets/icons/fileShare.png" alt="" class="w-[48px]" class="logoIcon">
        <div class="block"><span class="logoPrefix">File</span><span class="logoSuffix">Share</span></div>
      </div>
    </a>
    <div class="navbarItems text-lg hidden lg:flex flex-row items-center gap-6">
      <a href="index.php" class="navbarItem">Home</a>
      <a href="about.php" class="navbarItem">About</a>
      <!-- <a href="profile.php" class="navbarItem">Profile</a> -->
      <!-- <a href="receivedFiles.php" class="navbarItem">Received Files</a> -->
      <!-- <a href="history.php" class="navbarItem">History</a> -->
      <a href="dashboard.php" class="navbarItem">Dashboard</a>
      <a href="logout.php" class="navbarItem">Logout</a>
    </div>
    <div class="actions flex flex-row items-center gap-6">
      <!-- <button><i class="fa-solid fa-bell text-2xl"></i></button> -->
      <!-- <button onclick="toggleTheme()" id='themeButton'><i class="fa-solid fa-moon text-2xl"></i></button> -->
    </div>
    <div class="profile hidden lg:flex flex-row items-center gap-3">
      <img src="assets/icons/profile.png" class="w-[48px]" alt="">
      <div class="profileDetails flex flex-col ">
        <p class="name text-lg"><?php echo $_SESSION['Name'] ?></p>
        <p class="userID"><?php echo $_SESSION['userID'] ?></p>
      </div>
    </div>

    <div id="toggleBtn" class="lg:hidden  flex flex-col gap-1" onclick='toggleMenu()'>
      <button class="bar1 w-[32px] bg-red-500 h-[4px] rounded-xl"></button>
      <button class="bar2 w-[32px] bg-red-500 h-[4px] rounded-xl"></button>
      <button class="bar3 w-[32px] bg-red-500 h-[4px] rounded-xl"></button>
    </div>


  </nav>
  <div id="overlay" class='hidden fixed top-0 left-0' onclick='toggleMenu()'></div>

  <div id="navbarSmall" class="hidden shadow-xl border-b absolute top-[80px] left-0 z-50 w-full flex flex-col items-center justify-center lg:hidden gap-2 p-2">
    <div class="smallNavTop flex flex-row w-full items-center justify-between px-4">
      <div class="profile lg:hidden flex flex-row items-center gap-3">
        <a href="index.php"><img src="assets/icons/profile.png" class="w-[48px]" alt=""></a>
        <div class="profileDetails flex flex-col ">
          <p class="name text-lg"><?php echo $_SESSION['Name'] ?></p>
          <p class="userID"><?php echo $_SESSION['userID'] ?></p>
        </div>
      </div>
    </div>
    <div class="flex flex-col sm:flex-row w-full">
      <div class="flex flex-col w-full items-center justify-center gap-2">
        <a href="index.php" class="navbarItem w-full text-center rounded-lg p-2">Home</a>
        <a href="about.php" class="navbarItem w-full text-center rounded-lg p-2">About</a>
        <!-- <a href="history.php" class="navbarItem w-full text-center rounded-lg p-2">History</a> -->
      </div>
      <div class="flex flex-col w-full items-center justify-center gap-2">
        <a href="dashboard.php" class="navbarItem w-full text-center rounded-lg p-2">Dashboard</a>
        <a href="logout.php" class="navbarItem w-full text-center rounded-lg p-2">Logout</a>
        <!-- <a href="history.php" class="navbarItem w-full text-center rounded-lg p-2">History</a> -->
      </div>

      <!-- <div class="flex flex-col w-full items-center justify-center gap-2">
        <a href="profile.php" class="navbarItem w-full text-center rounded-lg p-2">Profile</a>
        <a href="receivedFiles.php" class="navbarItem w-full text-center rounded-lg p-2">Received Files</a>

      </div> -->
    </div>
  </div>
<?php

} else {
?>

  <nav class="navbarBody flex flex-row items-center justify-between p-4 shadow-xl">
    <div class="logo flex flex-row items-center gap-3 text-3xl font-bold">
      <img src="assets/icons/fileShare.png" alt="" class="w-[48px]" class="logoIcon">
      <div><span class="logoPrefix">File</span><span class="logoSuffix">Share</span></div>
    </div>
    <div class="navbarItems hidden lg:flex flex-row items-center gap-6">
      <a href="index.php" class="navbarItem">Home</a>
      <a href="about.php" class="navbarItem">About</a>
      <a href="login.php" class="navbarItem">Login</a>
      <a href="signup.php" class="navbarItem">Sign Up</a>
    </div>
    <div class="actions flex flex-row items-center gap-6">
      <!-- <button><i class="fa-solid fa-bell text-2xl"></i></button> -->
      <!-- <button onclick="toggleTheme()" id='themeButton'><i class="fa-solid fa-moon text-2xl"></i></button> -->
    </div>
    <div id="toggleBtn" class="lg:hidden  flex flex-col gap-1" onclick='toggleMenu()'>
      <button class="bar1 w-[32px] bg-red-500 h-[4px] rounded-xl"></button>
      <button class="bar2 w-[32px] bg-red-500 h-[4px] rounded-xl"></button>
      <button class="bar3 w-[32px] bg-red-500 h-[4px] rounded-xl"></button>
    </div>
  </nav>
  <div id="overlay" class='hidden fixed top-0 left-0' onclick='toggleMenu()'></div>

  <div id="navbarSmall" class="hidden shadow-xl border-b absolute top-[80px] left-0 z-50 w-full flex flex-col items-center justify-center lg:hidden gap-2 p-2">
    <div class="flex flex-col sm:flex-row w-full">
      <div class="flex flex-col w-full items-center justify-center gap-2">
        <a href="index.php" class="navbarItem w-full text-center rounded-lg p-2">Home</a>
        <a href="about.php" class="navbarItem w-full text-center rounded-lg p-2">About</a>
      </div>
      <div class="flex flex-col w-full items-center justify-center gap-2">
        <a href="login.php" class="navbarItem w-full text-center rounded-lg p-2">Login</a>
        <a href="signup.php" class="navbarItem w-full text-center rounded-lg p-2">Sign Up</a>
      </div>
    </div>
  </div>
<?php
}
?>