<?php
session_start();
include("db.php");
$username = $password = "";
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if (empty($username) || empty($password)) {
        $errors[] = "لطفاً یوزرنیم و پسورد را وارد کنید.";
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            header("Location: users.php");
            exit();
        } else {
            $errors[] = "یوزرنیم یا پسورد اشتباه است.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود</title>
</head>
<body>
    <h2>فرم ورود</h2>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $e) {
            echo "<p style='color:red;'>$e</p>";
        }
    }
    ?>

    <form method="post" action="login.php">
        <label>یوزرنیم:</label><br>
        <input type="text" name="username"><br><br>

        <label>رمز عبور:</label><br>
        <input type="password" name="password"><br><br>

        <input type="submit" value="ورود">
    </form>
    <p>حساب کاربری ندارید؟ <a href="register.php">ثبت‌نام کنید</a></p>
</body>
</html>
