<?php

include "db.php";

$error = "";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    if (!preg_match("/^[A-Za-z ]+$/", $name)) {
        $error = "Name should contain only letters.";

    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Phone number must contain 10 digits.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";

    } else {

        $sql = "INSERT INTO contacts (name, phone, email)
                VALUES ('$name', '$phone', '$email')";

        mysqli_query($conn, $sql);

        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Contact</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Add Contact</h1>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST">

        <label>Name</label>
        <input type="text"
               name="name"
               placeholder="Enter name"
               required>

        <label>Phone</label>
        <input type="text"
               name="phone"
               placeholder="Enter 10 digit phone"
               maxlength="10"
               required>

        <label>Email</label>
        <input type="email"
               name="email"
               placeholder="Enter email"
               required>

        <button type="submit" name="submit">
            Add Contact
        </button>

    </form>

    <a href="index.php" class="back">Back to Contacts</a>

</div>

</body>
</html>