<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/managesubject.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Manage Subjects</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="../icon/user.png" alt="user icon">
                <h1>Welcome</h1>
                <p><span class="usercount" id="result-count"> <?php include 'countuser.php';
                                                                echo $totalUsers; ?></span></p>
            </div>
            <hr>
            <div class="sidebar-body">
                <div class="con con-dashboard">
                    <img src="../icon/dashboard.png" alt="dashboard icon">
                    <a href="student.php">Dashboard</a>
                </div>
                <div class="con manage-subject">
                    <img src="../icon/student-subject.png" alt="Manage students icon">
                    <a href="">Subject</a>
                </div>
                <div class="con grade">
                    <img src="../icon/student.png" alt="Add new students icon">
                    <a href="">Grade</a>
                </div>
                <div class="con profile">
                    <img src="../icon/student-profile.png" alt="Settings icon">
                    <a href="">Profile</a>
                </div>
                <div class="con settings">
                    <img src="../icon/setting.png" alt="Settings icon">
                    <a href="">settings</a>
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

                                <h1>List of Applied Subject</h1>
                                <input type="text" class="search-control" id="live-search" autocomplete="off" placeholder="Search...">
                            </div>

                            <div class="total-users">
                                <p>Total number of Subjects: <span class="usercount" id="result-count"> <?php include 'countsubject.php';
                                                                                                        echo $totalUsers; ?></span></p>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Subject ID</th>
                                        <th>Subject code</th>
                                        <th>Subject name</th>
                                        <th>Professor</th>
                                        <th>Time in</th>
                                        <th>Time out</th>
                                        <th class="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connection.php';

                                    // Read all rows from database table
                                    $sql = "SELECT * FROM applied_subjects";
                                    $result = $conn->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                        // Fetch data for each row
                                        while ($row = $result->fetch_assoc()) {
                                            $subjectID = $row['subjectID'];
                                            $subjectCode = $row['subjectCode'];
                                            $subjectName = $row['subjectName'];
                                            $professor = $row['professor'];
                                            $time = $row['time'];
                                            $timeOut = $row['timeOut'];

                                            echo "<tr>
                                                    <td>{$row['subjectID']}</td>
                                                    <td>{$row['subjectCode']}</td>
                                                    <td>{$row['subjectName']}</td>
                                                    <td>{$row['professor']}</td>
                                                    <td>{$row['time']}</td>
                                                    <td>{$row['timeOut']}</td>   
                                                    
                                                     <td>
                                                       <button class='btn btn-edit' onclick='editStudent($subjectCode, \"$subjectName\", \"$professor\", \"$time\", \"$timeOut\")'> <a class='btn btn-edit'>Edit</button></a>
                                                       <button class='btn btn-danger' onclick='confirmDelete($subjectID)'> <a class='btn btn-danger'>Delete</a> </button>
                                                    </td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No subjects found.</td></tr>";
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
    <script>
        function confirmDelete(subjectID) {
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
                    window.location.href = `deletesubject.php?subjectID=${subjectID}`;
                }
            });
        }
    </script>
</body>

</html>