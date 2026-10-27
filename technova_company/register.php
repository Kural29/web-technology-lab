<?php

include "db.php";

$message = "";
$messageType = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name =
        trim($_POST["name"]);

    $email =
        trim($_POST["email"]);

    $password =
        $_POST["password"];

    $department =
        trim($_POST["department"]);

    $phone =
        trim($_POST["phone"]);


    if (
        $name == "" ||
        $email == "" ||
        $password == "" ||
        $department == "" ||
        $phone == ""
    ) {

        $message =
            "Please fill all fields.";

        $messageType =
            "error";

    }

    elseif (strlen($password) < 6) {

        $message =
            "Password must contain at least 6 characters.";

        $messageType =
            "error";

    }

    else {


        $check =
            "SELECT id FROM users WHERE email = ?";


        $stmt =
            mysqli_prepare(
                $conn,
                $check
            );


        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );


        mysqli_stmt_execute($stmt);


        mysqli_stmt_store_result($stmt);


        if (
            mysqli_stmt_num_rows($stmt) > 0
        ) {

            $message =
                "Email is already registered.";

            $messageType =
                "error";

        }

        else {


            $hashedPassword =
                password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );


            $sql =
                "INSERT INTO users
                (name, email, password, role, department, phone)
                VALUES (?, ?, ?, 'employee', ?, ?)";


            $stmt =
                mysqli_prepare(
                    $conn,
                    $sql
                );


            mysqli_stmt_bind_param(
                $stmt,
                "sssss",
                $name,
                $email,
                $hashedPassword,
                $department,
                $phone
            );


            if (
                mysqli_stmt_execute($stmt)
            ) {

                $message =
                    "Registration successful! You can now login.";

                $messageType =
                    "success";

            }

            else {

                $message =
                    "Registration failed.";

                $messageType =
                    "error";

            }

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

    <title>Employee Registration</title>

    <link rel="stylesheet"
          href="style.css">

    <script src="script.js"></script>

</head>

<body>


<header>

    <div class="header-content">

        <div class="logo">
            🚀 Inno<span>Tech</span>
        </div>

        <p>
            Join Our Team
        </p>

    </div>

</header>


<nav>

    <a href="index.php">Home</a>

    <a href="about.php">About Us</a>

    <a href="register.php">Registration</a>

    <a href="login.php">Login</a>

</nav>


<div class="form-container">


    <h2>
        👨‍💼 Employee Registration
    </h2>


    <?php

    if ($message != "") {

        echo
        "<div class='$messageType'>" .
        htmlspecialchars($message) .
        "</div>";

    }

    ?>


    <form
        method="POST"
        onsubmit="return validateRegistration();"
    >


        <div class="form-group">

            <label>
                Full Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name"
                required
            >

        </div>


        <div class="form-group">

            <label>
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="employee@example.com"
                required
            >

        </div>


        <div class="form-group">

            <label>
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Minimum 6 characters"
                required
            >

        </div>


        <div class="form-group">

            <label>
                Department
            </label>

            <select name="department" required>

                <option value="">
                    Select Department
                </option>

                <option value="IT">
                    IT
                </option>

                <option value="HR">
                    Human Resources
                </option>

                <option value="Finance">
                    Finance
                </option>

                <option value="Marketing">
                    Marketing
                </option>

                <option value="Sales">
                    Sales
                </option>

            </select>

        </div>


        <div class="form-group">

            <label>
                Phone
            </label>

            <input
                type="text"
                id="phone"
                name="phone"
                placeholder="Enter phone number"
                required
            >

        </div>


        <button type="submit">

            Create Employee Account 🚀

        </button>


    </form>


    <p style="text-align:center; margin-top:20px;">

        Already registered?

        <a href="login.php">
            Login here
        </a>

    </p>


</div>


<footer>

    <p>
        © 2026
        <span>Innotech Solutions</span>
        | All Rights Reserved
    </p>

</footer>


</body>

</html>