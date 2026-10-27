<?php

session_start();

include "db.php";


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}


if ($_SESSION["role"] != "admin") {

    header("Location: login.php");

    exit();

}


/*
 * Get all employees
 */

$sql =
    "SELECT
        id,
        name,
        email,
        department,
        phone,
        created_at
     FROM users
     WHERE role = 'employee'
     ORDER BY id DESC";


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

    <title>Admin Dashboard</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>


<header>

    <div class="header-content">

        <div class="logo">
            🚀 Inno<span>Tech</span>
        </div>

        <p>
            Administration Portal
        </p>

    </div>

</header>


<nav>

    <a href="admin_dashboard.php">
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

        Welcome Admin,
        <?php
        echo htmlspecialchars(
            $_SESSION["user_name"]
        );
        ?>
        🛡️

    </h1>

    <p>
        Employee Management Dashboard
    </p>

</section>


<section class="section">


    <div class="section-title">

        <h2>
            👨‍💼 All Employee Details
        </h2>

        <p>
            Employee information registered in InnoTech
        </p>

    </div>


    <div class="table-container">


        <table class="user-table">


            <tr>

                <th>
                    ID
                </th>

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

                <th>
                    Registered Date
                </th>

            </tr>


            <?php

            while (
                $employee =
                mysqli_fetch_assoc($result)
            ) {

            ?>


            <tr>

                <td>

                    <?php
                    echo htmlspecialchars(
                        $employee["id"]
                    );
                    ?>

                </td>


                <td>

                    <?php
                    echo htmlspecialchars(
                        $employee["name"]
                    );
                    ?>

                </td>


                <td>

                    <?php
                    echo htmlspecialchars(
                        $employee["email"]
                    );
                    ?>

                </td>


                <td>

                    <?php
                    echo htmlspecialchars(
                        $employee["department"]
                    );
                    ?>

                </td>


                <td>

                    <?php
                    echo htmlspecialchars(
                        $employee["phone"]
                    );
                    ?>

                </td>


                <td>

                    <?php
                    echo htmlspecialchars(
                        $employee["created_at"]
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
        | Admin Portal

    </p>

</footer>


<script src="script.js"></script>

</body>

</html>