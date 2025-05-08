<?php
session_start();
include("db.php");
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>لیست کاربران</title>
</head>
<body>
    <h2>لیست کاربران ثبت‌نام‌شده</h2>
    <table border="1">
        <thead>
            <tr>
                <th>نام</th>
                <th>یوزرنیم</th>
                <th>پسورد</th>
                <th>شماره تماس</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['password'] . "</td>
                        <td>" . $row['phone'] . "</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <p><a href="logout.php">خروج</a></p>
</body>
</html>
