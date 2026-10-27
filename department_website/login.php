<?php

session_start();

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];


    if ($email == "" || $password == "") {

        $message = "Please enter email and password.";

    } else {

        $sql = "SELECT id, name, email, password
                FROM users
                WHERE email = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);


        if (mysqli_num_rows($result) == 1) {

            $user = mysqli_fetch_assoc($result);


            if (password_verify(
                $password,
                $user["password"]
            )) {

                $_SESSION["user_id"] =
                    $user["id"];

                $_SESSION["user_name"] =
                    $user["name"];

                $_SESSION["user_email"] =
                    $user["email"];


                header("Location: dashboard.php");

                exit();

            } else {

                $message = "Incorrect password.";

            }

        } else {

            $message = "Account not found.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - CS Department</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <div class="header-content">

        <div class="logo">
            🎓 CS <span>Department</span>
        </div>

        <div>
            <p>Student Login Portal</p>
        </div>

    </div>

</header>


<nav>

    <a href="index.php">Home</a>

    <a href="about.php">About Us</a>

    <a href="index.php#programs">Programs</a>

    <a href="register.php">Register</a>

    <a href="login.php">Login</a>

</nav>


<div class="form-container">

    <h2>🔐 Student Login</h2>


    <?php if ($message != "") { ?>

        <div class="error">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php } ?>


    <form method="POST">


        <div class="form-group">

            <label for="email">
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required>

        </div>


        <div class="form-group">

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required>

        </div>


        <button type="submit">
            Login 🔓
        </button>

    </form>


    <p style="text-align:center; margin-top:20px;">

        Don't have an account?

        <a href="register.php">
            Register here
        </a>

    </p>

</div>


<footer>

    <p>
        © 2026 <span>Computer Science Department</span>
        | All Rights Reserved
    </p>

</footer>

</body>

</html>