<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Registration</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f5f9;
        }

        .container {
            width: 700px;
            max-width: 95%;
            margin: 50px auto;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2563eb;
            margin-bottom: 30px;
        }

        .row {
            display: flex;
            gap: 20px;
        }

        .form-group {
            flex: 1;
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        @media (max-width: 600px) {
            .row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="form-box">

        <h2>Employee Details</h2>

        <form action="save_employee.php" method="POST">

            <div class="row">

                <div class="form-group">
                    <label>Employee ID</label>
                    <input
                        type="text"
                        name="employee_id"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Full Name</label>
                    <input
                        type="text"
                        name="full_name"
                        required
                    >
                </div>

            </div>

            <div class="row">

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input
                        type="text"
                        name="phone"
                    >
                </div>

            </div>

            <div class="row">

                <div class="form-group">
                    <label>Department</label>

                    <select name="department" required>
                        <option value="">Select Department</option>
                        <option value="HR">HR</option>
                        <option value="IT">IT</option>
                        <option value="Finance">Finance</option>
                        <option value="Sales">Sales</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Operations">Operations</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Designation</label>

                    <input
                        type="text"
                        name="designation"
                        required
                    >
                </div>

            </div>

            <div class="row">

                <div class="form-group">
                    <label>Joining Date</label>

                    <input
                        type="date"
                        name="joining_date"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Salary</label>

                    <input
                        type="number"
                        name="salary"
                        step="0.01"
                    >
                </div>

            </div>

            <div class="form-group">

                <label>Address</label>

                <input
                    type="text"
                    name="address"
                >

            </div>

            <button type="submit">
                Save Employee
            </button>

        </form>

    </div>

</div>

</body>
</html>
