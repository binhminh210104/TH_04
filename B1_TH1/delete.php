<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyhoa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM hoa WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không tìm thấy ID.";
}

$conn->close();
?>
