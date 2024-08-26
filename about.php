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
    <link rel="icon" type="image/x-icon" href="assets/icons/fileShare.png">

</head>

<body id='theme' class="theme-dark flex min-h-screen flex-col">

    <!-- Navbar -->
    <header class="navbar w-full">
        <?php require "includes/navbar.php"; ?>
    </header>

    <!-- Main Content -->
    <main class="dashboardBody flex flex-col md:flex-row w-full">
        <section class="bodyContent body p-6 md:p-8 lg:p-10 flex flex-col gap-6 md:gap-8 text-lg overflow-y-auto">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">About <span class="logoPrefix">File</span><span class="logoSuffix">Share</span></h1>
            
            <article class="aboutSection flex flex-col gap-4">
                <h2 class="aboutSectionTitle font-bold text-xl">Welcome to FileShare</h2>
                <p class="aboutSectionBody">FileShare is redefining file management for businesses. We focus on streamlining document distribution, ensuring an efficient and secure workflow for all your critical files.</p>
            </article>

            <article class="aboutSection flex flex-col gap-4">
                <h2 class="aboutSectionTitle font-bold text-xl">Our Vision</h2>
                <p class="aboutSectionBody">We aim to transform routine file management into a strategic business advantage, empowering organizations to optimize processes, reduce costs, and enhance productivity through innovative technology.</p>
            </article>

            <article class="aboutSection flex flex-col gap-4">
                <h2 class="aboutSectionTitle font-bold text-xl">What Sets Us Apart</h2>
                <ul class="list-disc list-inside aboutSectionBody">
                    <li><strong>Tailored Solutions:</strong> We deliver customized file management systems tailored to your specific needs.</li>
                    <li><strong>Advanced Technology:</strong> Stay ahead with our cutting-edge solutions designed for the future.</li>
                    <li><strong>Security and Compliance:</strong> We prioritize the security and integrity of your data, ensuring compliance with industry standards.</li>
                </ul>
            </article>

            <article class="aboutSection flex flex-col gap-4">
                <h2 class="aboutSectionTitle font-bold text-xl">Join Us</h2>
                <p class="aboutSectionBody">Experience the power of efficient file management with FileShare. Contact us today to explore how we can transform your organization's processes.</p>
            </article>

            <footer class="contactInfo text-center mt-8">
                <p class="name font-bold text-lg">Anmol Kumar Sharma</p>
                <p class="italic designation">Final Year Student</p>
                <p class="italic dept">Department of Computer Science and Engineering</p>
                <p class="italic institute">NIT Sikkim</p>
            </footer>
        </section>
    </main>

</body>
</html>
