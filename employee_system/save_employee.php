<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_id = $_POST["employee_id"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $department = $_POST["department"];
    $designation = $_POST["designation"];
    $joining_date = $_POST["joining_date"];
    $salary = $_POST["salary"];
    $address = $_POST["address"];

    $sql = "INSERT INTO employees
            (employee_id, full_name, email, phone, department,
             designation, joining_date, salary, address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssds",
        $employee_id,
        $full_name,
        $email,
        $phone,
        $department,
        $designation,
        $joining_date,
        $salary,
        $address
    );

    if ($stmt->execute()) {

        echo "<h2>Employee saved successfully!</h2>";
        echo "<a href='index.php'>Add another employee</a>";

    } else {

        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>