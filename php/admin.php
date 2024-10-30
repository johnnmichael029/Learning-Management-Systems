<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin Panel</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="../icon/user.png" alt="user icon">
                <h1>Administrator</h1>
            </div>
            <hr>
            <div class="sidebar-body">
                <div class="con dashboard">
                    <img src="../icon/dashboard.png" alt="dashboard icon">
                    <a href="admin.php">Dashboard</a>
                </div>
                <div class="con manage-students">
                    <img src="../icon/manager.png" alt="Manage students icon">
                    <a href="managestudent.php">Manage students</a>
                </div>
                <div class="con add-new-students">
                    <img src="../icon/Add new.png" alt="Add new students icon">
                    <a href="admin.php">Add new students</a>
                </div>
                <div class="con settings">
                    <img src="../icon/setting.png" alt="Settings icon">
                    <a href="admin.php">Settings</a>
                </div>
                <div class="con logout">
                    <img src="../icon/logout.png" alt="Logout icon">
                    <a href="../html/LoginForm.php">Logout</a>
                </div>

            </div>
        </div>
        <div class="container-body">
            <div class="container1">
                <div class="header">
                    <h1>Dashboard</h1>
                </div>
                <div class="content-body">
                    <div class="left-body">
                        <div class="container-table">
                            <h1>List of Students</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "studentDB";

                                    // Create connection
                                    $con = new mysqli($servername, $username, $password, $database);

                                    // Check connection
                                    if ($con->connect_error) {
                                        die("Connection failed: " . $con->connect_error);
                                    }

                                    // Read all rows from database table
                                    $sql = "SELECT * FROM users";
                                    $result = $con->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        // Fetch data for each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['studentID']}</td>
                                                    <td>{$row['lastname']}</td>
                                                    <td>{$row['firstname']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>{$row['password']}</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No students found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="right-body">
                        <h1>Add New Student</h1>

                        <form action="add.php" method="POST">

                            <input type="text" name="lastname" placeholder="Enter student last name" required>
                            <input type="text" name="firstname" placeholder="Enter student first name" required>
                            <input type="text" name="studentID" id="numberInput" placeholder="Enter student ID" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <input type="email" name="email" placeholder="Enter student email" required>
                            <input type="password" name="password" placeholder="Password" required>


                            <button type="submit" name="submit" class="btn">Add Student</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


</body>

</html>