<?php

session_start();

include "db.php";

$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email =
        trim($_POST["email"]);

    $password =
        $_POST["password"];


    $sql =
        "SELECT *
         FROM users
         WHERE email = ?";


    $stmt =
        mysqli_prepare(
            $conn,
            $sql
        );


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );


    mysqli_stmt_execute($stmt);


    $result =
        mysqli_stmt_get_result($stmt);


    if (
        mysqli_num_rows($result) == 1
    ) {


        $user =
            mysqli_fetch_assoc($result);


        if (
            password_verify(
                $password,
                $user["password"]
            )
        ) {


            $_SESSION["user_id"] =
                $user["id"];


            $_SESSION["user_name"] =
                $user["name"];


            $_SESSION["user_email"] =
                $user["email"];


            $_SESSION["role"] =
                $user["role"];


            $_SESSION["department"] =
                $user["department"];


            /*
             * ROLE-BASED REDIRECTION
             */

            if (
                $user["role"] == "admin"
            ) {

                header(
                    "Location: admin_dashboard.php"
                );

                exit();

            }

            else {

                header(
                    "Location: employee_dashboard.php"
                );

                exit();

            }

        }

        else {

            $message =
                "Incorrect password.";

        }

    }

    else {

        $message =
            "Account not found.";

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - Innotech</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>


<header>

    <div class="header-content">

        <div class="logo">
            🚀 Inno<span>tech</span>
        </div>

        <p>
            Employee & Admin Portal
        </p>

    </div>

</header>


<nav>

    <a href="index.php">
        Home
    </a>

    <a href="about.php">
        About Us
    </a>

    <a href="register.php">
        Registration
    </a>

    <a href="login.php">
        Login
    </a>

</nav>


<div class="form-container">


    <h2>
        🔐 Secure Login
    </h2>


    <?php

    if ($message != "") {

        echo
        "<div class='error'>" .
        htmlspecialchars($message) .
        "</div>";

    }

    ?>


    <form method="POST">


        <div class="form-group">

            <label>
                Email Address
            </label>

            <input
                type="email"
                name="email"
                placeholder="Enter email"
                required
            >

        </div>


        <div class="form-group">

            <label>
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Enter password"
                required
            >

        </div>


        <button type="submit">

            Login 🔓

        </button>


    </form>


    <p style="text-align:center; margin-top:20px;">

        New employee?

        <a href="register.php">
            Create an account
        </a>

    </p>


</div>


<footer>

    <p>
        © 2026
        <span>InnoTech Solutions</span>
        | All Rights Reserved
    </p>

</footer>


</body>

</html>