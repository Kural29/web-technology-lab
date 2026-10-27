<?php

session_start();

include "db.php";


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}


if ($_SESSION["role"] != "employee") {

    header("Location: login.php");

    exit();

}


/*
 * Get all admin details
 */

$sql =
    "SELECT
        name,
        email,
        department,
        phone
     FROM users
     WHERE role = 'admin'";


$result =
    mysqli_query(
        $conn,
        $sql
    );

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Employee Dashboard</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>


<header>

    <div class="header-content">

        <div class="logo">
            🚀 Tech<span>Nova</span>
        </div>

        <p>
            Employee Portal
        </p>

    </div>

</header>


<nav>

    <a href="employee_dashboard.php">
        Dashboard
    </a>

    <a href="about.php">
        About Company
    </a>

    <a
        href="logout.php"
        onclick="return confirmLogout();"
    >
        Logout 🚪
    </a>

</nav>


<section class="dashboard-header">

    <h1>
        Welcome,
        <?php
        echo htmlspecialchars(
            $_SESSION["user_name"]
        );
        ?>
        👋
    </h1>

    <p>
        Employee Dashboard
    </p>

</section>


<section class="section">


    <div class="section-title">

        <h2>
            🛡️ Administrator Details
        </h2>

        <p>
            Authorized administrator contacts
        </p>

    </div>


    <div class="table-container">

        <table class="user-table">


            <tr>

                <th>
                    Name
                </th>

                <th>
                    Email
                </th>

                <th>
                    Department
                </th>

                <th>
                    Phone
                </th>

            </tr>


            <?php

            while (
                $admin =
                mysqli_fetch_assoc($result)
            ) {

            ?>


            <tr>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $admin["name"]
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $admin["email"]
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $admin["department"]
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $admin["phone"]
                    );
                    ?>
                </td>

            </tr>


            <?php

            }

            ?>


        </table>

    </div>


</section>


<footer>

    <p>
        © 2026
        <span>InnoTech Solutions</span>
        | Employee Portal
    </p>

</footer>


<script src="script.js"></script>

</body>

</html>