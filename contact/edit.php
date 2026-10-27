<?php

include "db.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM contacts WHERE id=$id");

$row = mysqli_fetch_assoc($result);

$error = "";

if (isset($_POST['update'])) {

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

        $sql = "UPDATE contacts SET
                name='$name',
                phone='$phone',
                email='$email'
                WHERE id=$id";

        mysqli_query($conn, $sql);

        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Contact</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Edit Contact</h1>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST">

        <label>Name</label>

        <input type="text"
               name="name"
               value="<?php echo $row['name']; ?>"
               required>


        <label>Phone</label>

        <input type="text"
               name="phone"
               value="<?php echo $row['phone']; ?>"
               maxlength="10"
               required>


        <label>Email</label>

        <input type="email"
               name="email"
               value="<?php echo $row['email']; ?>"
               required>


        <button type="submit" name="update">
            Update Contact
        </button>

    </form>

    <a href="index.php" class="back">
        Back to Contacts
    </a>

</div>

</body>
</html>