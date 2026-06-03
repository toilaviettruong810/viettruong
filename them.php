<?php
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm sinh viên</title>
</head>
<body>

<h2>THÊM SINH VIÊN</h2>

<form method="post">

MSSV:
<input type="text" name="mssv"><br><br>

Họ tên:
<input type="text" name="hoten"><br><br>

Điểm PHP:
<input type="number" step="0.1" name="php"><br><br>

Điểm MySQL:
<input type="number" step="0.1" name="mysql"><br><br>

Điểm HTML/CSS:
<input type="number" step="0.1" name="htmlcss"><br><br>

<input type="submit" name="them" value="Thêm">

</form>

<?php

if(isset($_POST['them']))
{
    $mssv = trim($_POST['mssv']);
    $hoten = trim($_POST['hoten']);
    $php = $_POST['php'];
    $mysql = $_POST['mysql'];
    $htmlcss = $_POST['htmlcss'];

    if(
        empty($mssv) ||
        empty($hoten) ||
        $php==="" ||
        $mysql==="" ||
        $htmlcss==="")
    {
        echo "Không được để trống dữ liệu!";
    }
    elseif(
        $php<0 || $php>10 ||
        $mysql<0 || $mysql>10 ||
        $htmlcss<0 || $htmlcss>10
    )
    {
        echo "Điểm phải từ 0 đến 10!";
    }
    else
    {
        $sql = "INSERT INTO sinhvien
        VALUES('$mssv','$hoten','$php','$mysql','$htmlcss')";

        if($conn->query($sql))
        {
            echo "Thêm thành công!";
        }
        else
        {
            echo "MSSV đã tồn tại!";
        }
    }
}
?>

<br><br>

<a href="danhsach.php">Xem danh sách</a>

</body>
</html>