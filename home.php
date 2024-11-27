<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOP Homepage</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        /* General page styling */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        main {
            display: flex;
            flex-direction: column;
        }

        /* Section styling */
        .section {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            overflow: hidden;
            color: white;
        }

        .section h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .section p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        .section button {
            padding: 10px 25px;
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .section button:hover {
            background-color: rgba(255, 255, 255, 1);
            transform: scale(1.05);
        }

        /* Background image sections */
        .section-1 {
            background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20221114/pngtree-cross-on-mountain-vector-church-image_1462431.jpg');
            background-size: cover;
            background-position: center;
        }

        .section-2 {
            background-image: url('https://tse3.mm.bing.net/th?id=OIP.4v4D7X_Eu64BPk7vd-7OCQHaEK&pid=Api&P=0&h=180');
            background-size: cover;
            background-position: center;
        }

        .section-3 {
            background-image: url('https://scontent.fdvo2-2.fna.fbcdn.net/v/t39.30808-6/363362998_103588426169114_7891259541388375010_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=f727a1&_nc_ohc=IlIojBeo9msQ7kNvgFMa6bG&_nc_zt=23&_nc_ht=scontent.fdvo2-2.fna&_nc_gid=AoaZW6jmz9svTpvjeri_kjZ&oh=00_AYA3ss6S4hC3Ar4D3ovIVBNoHXbJIwQnbTU-o4okO7fXXQ&oe=6737EF66');
            background-size: cover;
            background-position: center;
        }

        /* Overlay to improve readability */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
        }

        .content {
            position: relative;
            z-index: 2;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section h2 {
                font-size: 2.5rem;
            }
            .section p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include the header -->

<main>
    <section class="section section-1">
        <div class="overlay"></div>
        <div class="content">
            <h2>Welcome to FOP</h2>
            <p>Discover a vibrant community dedicated to faith, hope, and love. Explore amazing church activities, inspiring programs, uplifting events, and meaningful services designed to bring us closer to God and to one another. Whether you're seeking spiritual growth, fellowship, or ways to serve, there's something here for everyone. Join us in this journey of faith and connection!</p>
            <button onclick="scrollToSection('.section-2')">Learn More</button>
        </div>
    </section>

    <section class="section section-2">
        <div class="overlay"></div>
        <div class="content">
            <h2>Our Programs</h2>
            <p>Explore the various programs we offer</p>
            <button onclick="window.location.href='book.php'">View Programs</button>
        </div>
    </section>

    <section class="section section-3">
        <div class="overlay"></div>
        <div class="content">
            <h2>Join Us</h2>
            <p>Become a part of our growing faith community</p>
            <button onclick="window.location.href='event.php'">Get Started</button>
        </div>
    </section>
</main>

<script>
    function scrollToSection(section) {
        document.querySelector(section).scrollIntoView({ behavior: 'smooth' });
    }
</script>

</body>
</html>

