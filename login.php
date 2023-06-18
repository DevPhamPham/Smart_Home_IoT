<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css" integrity="sha512-9YHSK59/rjvhtDcY/b+4rdnl0V4LPDWdkKceBl8ZLF5TB6745ml1AfluEU6dFWqwDw9lPvnauxFgpKvJqp7jiQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/regular.min.css" integrity="sha512-WidMaWaNmZqjk3gDE6KBFCoDpBz9stTsTZZTeocfq/eDNkLfpakEd7qR0bPejvy/x0iT0dvzIq4IirnBtVer5A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css" integrity="sha512-yDUXOUWwbHH4ggxueDnC5vJv4tmfySpVdIcN1LksGZi8W8EVZv4uKGrQc0pVf66zS7LDhFJM7Zdeow1sw1/8Jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div style="height: 100vh" class="container my-5 h-100">
        <div style="height: 100vh" class="row h-100 my-4 d-flex justify-content-around align-items-center">
        <?php
// Kiểm tra xem người dùng đã gửi yêu cầu đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị tài khoản và mật khẩu từ biểu mẫu đăng nhập
    $username = $_POST["username"];
    $password = $_POST["password"];
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
    
    // Chuẩn bị câu truy vấn SQL để kiểm tra tài khoản và mật khẩu
    $sql = "SELECT * FROM user WHERE user = '$username' AND password = '$password'";
    $result = $connection->query($sql);
    
    if ($result && $result->num_rows > 0) {
        // Đăng nhập thành công, thực hiện các thao tác tiếp theo (ví dụ: chuyển hướng đến trang chính)
        $_SESSION["user"] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Đăng nhập thất bại, hiển thị thông báo lỗi
        $error = "Tài khoản hoặc mật khẩu không chính xác!";
    }
}
?>

<div class="header w-100 text-center  my-4 ">
    <h1>Vui lòng đăng nhập vào hệ thống Smart Home</h1>
    <span>
    <div class="image_vector text-center">
        <img width="42" height="39" src="./images/home.png" alt="logo">
    </div>
    </span>
</div>
<form class="p-5" style="width: 60%;border:1px solid #ccc;border-radius: 50px" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h3>Đăng nhập</h3>
    <div class="" style="color: green;font-size:150%">
        <?php
        if (isset($_SESSION["thongbaologin"])){
            echo $_SESSION["thongbaologin"];
            unset($_SESSION["thongbaologin"]);
        }
        ?>
    </div>
    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Tài khoản</label>
        <input type="text" id="form2Example1" class="form-control" name="username" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Mật khẩu</label>
        <input type="password" id="form2Example2" class="form-control" name="password" />
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Đăng nhập</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
        <p>or sign up with:</p>
        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-google"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-twitter"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-github"></i>
        </button>
    </div>
    
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php
    unset($error);
    ?>
    <?php  endif; ?>
</form>


        </div>
    </div>
</body>

</html>