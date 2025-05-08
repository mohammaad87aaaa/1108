<?php
session_start();
include("db.php");
$name = $username = $password = $phone = "";
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $phone = trim($_POST["phone"]);

    if (empty($name) || empty($username) || empty($password) || empty($phone)) {
        $errors[] = "لطفاً همه فیلدها را پر کنید.";
    } else {
        // ثبت در دیتابیس
        $sql = "INSERT INTO users (name, username, password, phone) VALUES ('$name', '$username', '$password', '$phone')";
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "خطا در ثبت اطلاعات: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
</head>
<body>
    <h2>فرم ثبت‌نام</h2>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $e) {
            echo "<p style='color:red;'>$e</p>";
        }
    }
    ?>

    <form method="post" action="register.php">
        <label>نام:</label><br>
        <input type="text" name="name"><br><br>
        <label>یوزرنیم:</label><br>
        <input type="text" name="username"><br><br>
        <label>رمز عبور:</label><br>
        <input type="password" name="password"><br><br>
        <label>شماره تماس:</label><br>
        <input type="text" name="phone"><br><br>
        <input type="submit" value="ثبت‌نام">
    </form>
    <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="login.php">ورود</a></p>
</body>
</html>
