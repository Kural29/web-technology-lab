<?php

include "db.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name == "" || $email == "" || $password == "") {

        $message = "Please fill all fields.";
        $messageType = "error";

    } elseif (strlen($password) < 6) {

        $message = "Password must contain at least 6 characters.";
        $messageType = "error";

    } else {

        $check = "SELECT id FROM users WHERE email = ?";

        $stmt = mysqli_prepare($conn, $check);

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {

            $message = "This email is already registered.";
            $messageType = "error";

        } else {

            $hashedPassword =
                password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users
                    (name, email, password)
                    VALUES (?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $name,
                $email,
                $hashedPassword
            );

            if (mysqli_stmt_execute($stmt)) {

                $message = "Registration successful! You can now login.";
                $messageType = "message";

            } else {

                $message = "Registration failed.";
                $messageType = "error";
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

    <title>Register - CS Department</title>

    <link rel="stylesheet" href="style.css">

    <script src="script.js"></script>

</head>

<body>

<header>

    <div class="header-content">

        <div class="logo">
            🎓 CS <span>Department</span>
        </div>

        <div>
            <p>Join Our Department</p>
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

    <h2>📝 Student Registration</h2>


    <?php if ($message != "") { ?>

        <div class="<?php echo $messageType; ?>">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php } ?>


    <form method="POST"
          onsubmit="return validateForm();">


        <div class="form-group">

            <label for="name">
                Full Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name"
                required>

        </div>


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
                placeholder="Minimum 6 characters"
                required>

        </div>


        <button type="submit">
            Create Account 🚀
        </button>

    </form>


    <p style="text-align:center; margin-top:20px;">

        Already have an account?

        <a href="login.php">
            Login here
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