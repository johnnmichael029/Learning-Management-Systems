<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../php/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/sweetalert.js"></script>
    <title>Login Form</title>
</head>

<body>
    <div class="container">
        <div class="left_panel">
            <div class="tcu_logo">
                <img src="../logo/tcu.png" alt="TCY_LOGO" width="100px">
            </div>
            <div class="tcu_title">
                <h1>TAGUIG CITY UNIVERSITY</h1>
                <h2>Learning Management System</h2>
            </div>
        </div>
        <div class="right_panel">
            <div class="right_panel_container">
                <form action="../php/loginformsubmission.php" method="POST">
                    <div class="login">
                        <h1>Login</h1>
                    </div>
                    <div class="email_pass">
                        <div class="login_form">
                            <div class="email">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" required>
                            </div>
                            <div class="password">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="login_btn">
                        <button type="submit">Login</button>
                    </div>
                    <div class="forgot_pass">
                        <h3>Forgot <span class="h3color">password?</span></h3>
                    </div>
                </form>
            </div>

            <div class="copyrights">
                <span>&copy; 2024 Systems Fair created by: B2023</span>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            <?php if (isset($_SESSION['message']) && isset($_SESSION['status'])) : ?>
                swal({
                    title: "<?php echo $_SESSION['message']; ?>",
                    icon: "<?php echo $_SESSION['status']; ?>",
                    button: "OK"
                });
                <?php
                unset($_SESSION['message'], $_SESSION['status']);
                ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>