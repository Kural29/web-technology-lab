<?php

include "db.php";

$result = mysqli_query($conn, "SELECT * FROM contacts");

?>

<!DOCTYPE html>
<html>

<head>

    <title>Contact Management</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Contact Management</h1>

    <a href="add.php">
        <button>Add Contact</button>
    </a>

    <hr>

    <?php

    while ($row = mysqli_fetch_assoc($result)) {

    ?>

        <p>
            <b>Name:</b>
            <?php echo $row['name']; ?>
            <br>

            <b>Phone:</b>
            <?php echo $row['phone']; ?>
            <br>

            <b>Email:</b>
            <?php echo $row['email']; ?>
            <br><br>

            <a href="edit.php?id=<?php echo $row['id']; ?>">
                Edit
            </a>

            |

            <a href="delete.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Are you sure you want to delete?')">
                Delete
            </a>
        </p>

        <hr>

    <?php

    }

    ?>

</div>

</body>
</html>