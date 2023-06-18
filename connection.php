<?php
// Thay đổi các giá trị này phù hợp với thông tin của bạn
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'SmartHome';

// Kết nối đến cơ sở dữ liệu
$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Kết nối thất bại: " . $connection->connect_error);
}

// Kiểm tra xem bảng "user" đã tồn tại hay chưa
$sql = "SHOW TABLES LIKE 'user'";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    // echo "<h1>Đang kiểm tra.....</h1>";
} else {
    // Mã SQL để tạo bảng "user" với hai trường "user" và "password"
    $sql = "CREATE TABLE user (
        user VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    // Thực thi câu lệnh SQL để tạo bảng "user"
    if ($connection->query($sql) === TRUE) {
        echo "Bảng 'user' đã được tạo thành công";
    } else {
        echo "Lỗi trong quá trình tạo bảng: " . $connection->error;
    }
}

// Đóng kết nối
$connection->close();
?>
