<?php

include "db.php";

$name = "InnoTech Admin";
$email = "admin@InnoTech.com";
$password = "admin123";
$department = "Management";
$phone = "9876543210";

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users
(name, email, password, role, department, phone)
VALUES (?, ?, ?, 'admin', ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    $name,
    $email,
    $hashedPassword,
    $department,
    $phone
);

if (mysqli_stmt_execute($stmt)) {
    echo "Admin created successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

?>