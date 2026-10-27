<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard - CS Department</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <div class="header-content">

        <div class="logo">
            🎓 CS <span>Department</span>
        </div>

        <div>
            <p>Student Dashboard</p>
        </div>

    </div>

</header>


<nav>

    <a href="index.php">Home</a>

    <a href="about.php">About Us</a>

    <a href="dashboard.php">Dashboard</a>

    <a href="logout.php">Logout 🚪</a>

</nav>


<section class="section">

    <div class="section-title">

        <h2>
            Welcome, 
            <?php
            echo htmlspecialchars(
                $_SESSION["user_name"]
            );
            ?>! 👋
        </h2>

        <p>
            Welcome to your department dashboard.
        </p>

    </div>


    <div class="card-container">


        <div class="card">

            <div class="icon">👤</div>

            <h3>Profile</h3>

            <p>
                Name:
                <?php
                echo htmlspecialchars(
                    $_SESSION["user_name"]
                );
                ?>
            </p>

            <p>
                Email:
                <?php
                echo htmlspecialchars(
                    $_SESSION["user_email"]
                );
                ?>
            </p>

        </div>


        <div class="card">

            <div class="icon">📚</div>

            <h3>Academic Programs</h3>

            <p>
                Explore computer science,
                artificial intelligence and
                cyber security programs.
            </p>

        </div>


        <div class="card">

            <div class="icon">🚀</div>

            <h3>Student Success</h3>

            <p>
                Develop your technical skills
                and prepare for your future career.
            </p>

        </div>


    </div>

</section>


<section class="stats">

    <div class="stat">

        <h2>500+</h2>

        <p>Students</p>

    </div>


    <div class="stat">

        <h2>20+</h2>

        <p>Faculty</p>

    </div>


    <div class="stat">

        <h2>10+</h2>

        <p>Labs</p>

    </div>


    <div class="stat">

        <h2>15+</h2>

        <p>Years</p>

    </div>

</section>


<footer>

    <p>
        © 2026 <span>Computer Science Department</span>
        | All Rights Reserved
    </p>

</footer>

</body>

</html>