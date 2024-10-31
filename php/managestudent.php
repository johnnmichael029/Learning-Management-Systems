<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
                                        <th>User ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>role</th>
                                        <th class="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connection.php';
                                    $sql = "SELECT * FROM users";
                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $userID = $row['userID'];
                                            $lastname = $row['lastname'];
                                            $firstname = $row['firstname'];
                                            $email = $row['email'];
                                            $password = $row['password'];
                                            $role = $row['role'];
                                            echo "<tr>
                                                    <td>{$row['userID']}</td>
                                                    <td>{$row['lastname']}</td>
                                                    <td>{$row['firstname']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>{$row['password']}</td>
                                                    <td>{$row['role']}</td>
                                                    <td>
                                                       <button class='btn btn-edit' onclick='editStudent($userID, \"$lastname\", \"$firstname\", \"$email\", \"$password\")'> <a class='btn btn-edit'>Edit</button></a>
                                                       <button class='btn btn-danger' onclick='confirmDelete($userID)'> <a class='btn btn-danger'>Delete</a> </button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- SweetAlert Edit Form JavaScript -->
    <script>
        // function editStudent(studentID, lastname, firstname, email, password) {
        //     Swal.fire({
        //         title: 'Edit Student',
        //         html: `
        //              <input type="text" id="edit-studentID" class="swal2-input" placeholder="Student ID" required>
        //             <input type="text" id="edit-lastname" class="swal2-input" placeholder="Last name" required>
        //              <input type="text" id="edit-firstname" class="swal2-input" placeholder="First name" required>
        //              <input type="email" id="edit-email" class="swal2-input" placeholder="Email" required>
        //              <input type="password" id="edit-password" class="swal2-input" placeholder="Password" required>
        //          `,
        //         showCancelButton: true,
        //         confirmButtonText: 'Save',
        //         preConfirm: () => {
        //             return {
        //                 studentID: document.getElementById('edit-studentID').value,
        //                 lastname: document.getElementById('edit-lastname').value,
        //                 firstname: document.getElementById('edit-firstname').value,
        //                 email: document.getElementById('edit-email').value,
        //                 password: document.getElementById('edit-password').value
        //             }
        //         }
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             const formData = result.value;
        //             $.ajax({

        //                 url: 'editstudent.php',
        //                 type: 'POST',
        //                 data: data,
        //                 success: function(response) {
        //                     Swal.fire('Updated!', 'Student record has been updated.', 'success')
        //                         .then(() => location.reload()); // Reload page after update
        //                 },
        //                 error: function() {
        //                     Swal.fire('Error', 'Failed to update student record.', 'error');
        //                 }
        //             });
        //         }
        //     });
        // }

        function confirmDelete(userID) {
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
                    window.location.href = `deletestudent.php?userID=${userID}`;
                }
            });
        }
    </script>
</body>

</html>