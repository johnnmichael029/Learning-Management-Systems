<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mngstudent.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h1>Manage students</h1>
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
                                        <th class="action">Action</th>
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
                                                    <td>{$row['studentID']}</td>
                                                    <td>{$row['lastname']}</td>
                                                    <td>{$row['firstname']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>{$row['password']}</td>
                                                    <td>
                                                    <a href='editstudent.php?id={$row['studentID']}' class='btn btn-edit'><button type='button' class='btn btn-edit'>Edit</button></a>                                              
                                                    <a class='btn btn-danger'><button type='button' class='btn btn-danger' onclick='confirmDelete({$row["studentID"]})'>Delete</button>
</a>
                                                    
                                                    </td>
                                                    
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

                </div>
            </div>
        </div>
    </div>




    <script>
        function confirmDelete(studentID) {
            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `deletestudent.php?studentID=${studentID}`;
                }
            });
        }
    </script>


</body>

</html>