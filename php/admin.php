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
                            <div class="container-header">

                                <h1>List of Students</h1>
                                <input type="text" class="search-control" id="live-search" autocomplete="off" placeholder="Search...">
                            </div>

                            <div class="total-users">
                                <p>Total number of Students: <span class="usercount" id="result-count"> <?php include 'countuser.php';
                                                                                                        echo $totalUsers; ?></span></p>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connection.php';

                                    // Read all rows from database table
                                    $sql = "SELECT * FROM users";
                                    $result = $conn->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                        // Fetch data for each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['userID']}</td>
                                                    <td>{$row['lastname']}</td>
                                                    <td>{$row['firstname']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>{$row['password']}</td>
                                                    <td>{$row['role']}</td>
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

                            <input type="email" name="email" placeholder="Enter student email" required>
                            <input type="password" name="password" placeholder="Password" required>


                            <button type="submit" name="submit" class="btn btn-primary">Add Student</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#live-search").on("keyup", function() {
                var input = $(this).val().trim();

                if (input !== "") {
                    // Perform search when input is not empty
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: {
                            input: input
                        },
                        dataType: "json",
                        success: function(response) {
                            $(".table tbody").html(response.html).show();
                            $('#result-count').text(response.count); //update the total count
                        }
                    });
                } else {
                    // When input is empty, fetch and display original data
                    $.ajax({
                        url: "fetch_all_data.php", // Separate PHP file to fetch all records
                        method: "POST",
                        dataType: "json",
                        success: function(response) {
                            $(".table tbody").html(response.html).show();
                            $('#result-count').text(response.count);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>