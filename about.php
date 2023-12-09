<?php
include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dispatch | About</title>
    <script src="assets/js/tailwind.js"></script>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c97f0fb9ac.js" crossorigin="anonymous"></script>
</head>

<body id='theme' class="theme-dark flex min-h-[100vh] flex-col">

    <div class="navbar w-full">
        <?php
        require "includes/navbar.php"
        ?>
    </div>

    <div class="dashboardBody flex flex-row w-full">
        
        <div class="bodyContent body p-4 flex flex-col gap-4 text-lg overflow-scroll">
            <div class="font-bold text-3xl">About <span class="logoPrefix">File</span><span class="logoSuffix">Share</span></div>
            <div class="aboutSection flex flex-col gap-3">
                <div class="aboutSectionTitle  font-bold">Welcome to FileShare - Reimagine Your Approach to File Management !</div>
                <div class="aboutSectionBody">At FileShare, we understand the paramount importance of streamlined file dispatch management in today's fast-paced business landscape. Our commitment is to revolutionize the way organizations handle and distribute critical documents, ensuring a seamless and efficient workflow.</div>
            </div>
            <div class="aboutSection flex flex-col gap-3">
                <div class="aboutSectionTitle  font-bold">Our Vision</div>
                <div class="aboutSectionBody">We envision a world where file dispatch management is not just a routine task but a strategic advantage for businesses. By leveraging cutting-edge technology and innovative solutions, we empower organizations to optimize their processes, reduce operational costs, and enhance overall productivity.</div>
            </div>
            <!-- <div class="aboutSection flex flex-col gap-3">
                <div class="aboutSectionTitle  font-bold">About the Developer</div>
                <div class="aboutSectionBody">FileShare is a website created by Anmol Sharma</div>
            </div> -->
            <div class="aboutSection flex flex-col gap-3">
                <div class="aboutSectionTitle  font-bold">What Sets Us Apart</div>
                <div class="aboutSectionBody">
                    <ul class="flex flex-col gap-3">
                        <li><span class="font-semibold">Tailored Solutions:</span> We don't believe in one-size-fits-all solutions. Our team works closely with each client to understand their specific requirements and challenges, delivering customized file dispatch management systems that address their unique needs.</li>
                        <li><span class="font-semibold">Advanced Technology: </span>Stay ahead of the curve with our state-of-the-art technology. We integrate the latest advancements in file management to provide you with a robust and future-proof solution.</li>
                        <li><span class="font-semibold">Security and Compliance:</span> We prioritize the security of your sensitive data. Our systems are designed with robust security features to ensure the confidentiality and integrity of your files, while also complying with industry regulations.</li>
                    </ul>
                </div>
            </div>
            <div class="aboutSection flex flex-col gap-3">
                <div class="aboutSectionTitle  font-bold">Join Us on the Journey</div>
                <div class="aboutSectionBody">Discover the power of efficient file dispatch management with FileShare. Join us on this journey towards operational excellence, where every file is handled with precision and care. Contact us today to explore how our solutions can transform your organization's file dispatch processes.</div>
            </div>

            <div class="contactInfo">
                <div class="name font-bold ">Anmol Kumar Sharma</div>
                <div class="italic designation">3rd Year Student</div>
                <div class="italic dept">Department of Computer Science and Engineering</div>
                <div class="italic institute">NIT Sikkim</div>
            </div>



        </div>
    </div>

</body>
</html>
