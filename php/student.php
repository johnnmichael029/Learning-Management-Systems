<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Student Portal</title>
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
                <div class="con dashboard">
                    <img src="../icon/dashboard.png" alt="dashboard icon">
                    <a href="">Dashboard</a>
                </div>
                <div class="con manage-students">
                    <img src="../icon/student-subject.png" alt="Manage students icon">
                    <a href="managesubject.php">Subject</a>
                </div>
                <div class="con add-new-students">
                    <img src="../icon/student.png" alt="Add new students icon">
                    <a href="">Grade</a>
                </div>
                <div class="con settings">
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
                    <h1>Manage Subjects</h1>
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
                                        <th>Subject code</th>
                                        <th>Subject name</th>
                                        <th>Professor</th>
                                        <th>Time in</th>
                                        <th>Time out</th>
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
                                            echo "<tr>
                                                    <td>{$row['subjectCode']}</td>
                                                    <td>{$row['subjectName']}</td>
                                                    <td>{$row['professor']}</td>
                                                    <td>{$row['time']}</td>
                                                    <td>{$row['timeOut']}</td>   
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
                    <div class="right-body">
                        <h1>Add Subject</h1>

                        <form action="addsubject.php" method="POST">
                            <input type="text" name="subjectCode" placeholder="Enter subject code" required>
                            <input type="text" name="subjectName" placeholder="Enter subject name" required>
                            <input type="text" name="professor" placeholder="Enter professor" required>
                            <input type="time" name="time" required>
                            <input type="time" name="timeOut" required>
                            <button type="submit" name="submit" class="btn btn-primary">Add subject</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>