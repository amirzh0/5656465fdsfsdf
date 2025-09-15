<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>آپلود فایل</title>
<style>
    body {
        font-family: Tahoma, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding-top: 50px;
    }
    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        width: 400px;
        text-align: center;
    }
    h2 {
        color: #333;
        margin-bottom: 20px;
    }
    input[type="file"] {
        margin-bottom: 15px;
    }
    input[type="submit"] {
        background: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background: #45a049;
    }
    img {
        max-width: 100%;
        margin-top: 15px;
        border-radius: 8px;
    }
    a {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #2196F3;
        font-weight: bold;
    }
    p.success { color: green; }
    p.error { color: red; }
</style>
</head>
<body>

<div class="container">
<h2>آپلود فایل</h2>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" required>
    <br>
    <input type="submit" value="آپلود">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {

    // امن کردن نام فایل
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $filename = preg_replace("/[^A-Za-z0-9_\-\.]/", '_', $filename); // جایگزینی کاراکترهای خطرناک
    $target_file = __DIR__ . "/" . $filename; // همون مسیر فایل PHP

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class='success'>✅ فایل با موفقیت آپلود شد: " . htmlspecialchars($filename) . "</p>";

        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $file_url = $filename;

        // نمایش فایل بر اساس نوع
        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<img src='$file_url' alt='آپلود شده'>";
        } else {
            echo "<p><a href='$file_url' target='_blank'>📄 مشاهده یا دانلود فایل</a></p>";
        }
    } else {
        echo "<p class='error'>❌ خطا در آپلود فایل.</p>";
    }
}
?>
</div>

</body>
</html>
