<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container-table">
        <h1>List of students</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>student ID</th>
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

                // create connection

                $con = new mysqli($servername, $username, $password, $database);

                // check connection
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                // read all row from database table
                $sql = "SELECT * FROM studenttb";
                $result = $con->query($sql);

                if (!$result) {
                    trigger_error('Invalid query: ' . $con->error);
                }

                // read data of each row of the table
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr> 
                            <td>" . $row['studentID'] . "</td>
                            <td>" . $row['lastname'] . "</td>
                            <td>" . $row['firstname'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['password'] . "</td                                             
                        ";
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>