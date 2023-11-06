<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="assets/css/login.css" rel="stylesheet">
    <script src="assets/js/tailwind.js"></script>

</head>
<body>
    <div class='login min-h-[100vh] flex bg-[#27699c58] items-center justify-center '>

        <div class="login-card  md:min-h-[50vh] w-[90%] lg:w-[60%] flex flex-col md:flex-row rounded-xl my-2 shadow-2xl">

            <div class="left md:w-[50%] p-8 gap-1 md:gap-2 flex flex-col justify-between ">
                <!-- <img src="" alt="" class='w-[50px] ' /> -->
                <div>

                    <div class='text-xl md:text-2xl'><strong class='text-[#2e3e6a] text-xl md:text-2xl lg:text-4xl'>File</strong><strong class='text-[#0daca3]  text-xl md:text-2xl lg:text-4xl'>Share</strong></div>
                    <div class='text-md md:text-xl text-white'>Share Files With Ease...</div>
                </div>
                <!-- <div class="text-sm md:text-md  text-white text-justify"><span class="text-cyan-300">Connect with the world</span> . <span class="text-rose-300">Share your thoughts</span> . <span class="text-yellow-300">Inspire people...</span></div> -->
                <!-- <div class="text-sm md:text-md  text-white text-justify">Resume your inspiring journey...</div> -->
                <div>
                    <div class='text-white'>Don't have an account?</div>
                    <a class='' href="signup.php"><button class='w-[100px] py-1 md:py-2 border bg-[#0daca3] text-[#2e3e6a] rounded-md  hover:bg-[#2e3e6a] hover:text-white'>Register</button></a>
                </div>
            </div>

            <div class="right md:w-[50%] p-8 gap-2 md:gap-3 bg-white justify-around ">
                <div class='text-[#2e3e6a] text-3xl py-4 '>Login</div>
                <form action="endpoints/loginSubmit.php" method="POST" class='flex flex-col gap-2 md:gap-3 '>
                    <input class="p-2 my-1 w-full text-black border-b-2" type="text" name="username" id="username" placeholder='Username' />
                    <input class="p-2 my-1 w-full text-black border-b-2" type="password" name="password" id="password" placeholder='Password' />
                    <div class="remember flex flex-row items-center justify-start">
                        <input type="checkbox" value="lsRememberMe" id="rememberMe" class='w-4 h-4' /><label htmlFor="rememberMe" class='text-[#2e3e6a]'>&nbsp;Remember me</label>
                    </div>
                    <button type="submit" name="submit" class='w-[100px] py-1 md:py-2 border bg-[#2e3e6a] text-[#0daca3] rounded-lg  hover:bg-[#0daca3] hover:text-white'>Login</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>