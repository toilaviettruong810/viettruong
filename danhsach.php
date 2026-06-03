<?php
include "config.php";

if(isset($_GET['xoa']))
{
    $mssv = $_GET['xoa'];

    $conn->query("DELETE FROM sinhvien WHERE mssv='$mssv'");

    // echo "da xoa ma so sinh vien ".$mssv;

    header("Location: danhsach.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
</head>
<body>

<h2>DANH SÁCH SINH VIÊN</h2>

<table border="1" cellpadding="10">

<tr>
<th>MSSV</th>
<th>Họ tên</th>
<th>ĐTB</th>
<th>Xếp loại</th>
<th>Học bổng</th>
<th>Điểm cao nhất</th>
<th>Điểm thấp nhất</th>
<th>TB các môn</th>
<th>Xóa</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM sinhvien");

$tongSV = 0;
$tongHocBong = 0;

$gioi = 0;
$kha = 0;
$tb = 0;
$yeu = 0;

while($row = $result->fetch_assoc())
{
    $tongSV++;

    $dtb = ($row['php']*2 + $row['mysql']*2 + $row['htmlcss'])/5;

    if($dtb >= 8)
    {
        $xeploai = "Giỏi";
        $gioi++;
    }
    elseif($dtb >= 6.5)
    {
        $xeploai = "Khá";
        $kha++;
    }
    elseif($dtb >= 5)
    {
        $xeploai = "Trung bình";
        $tb++;
    }
    else
    {
        $xeploai = "Yếu";
        $yeu++;
    }

    if(
        $dtb >= 8 &&
        $row['php'] >= 7 &&
        $row['mysql'] >= 7 &&
        $row['htmlcss'] >= 7
    )
    {
        $hocbong = "Đủ điều kiện";
        $tongHocBong++;
    }
    else
    {
        $hocbong = "Không đủ điều kiện";
    }

    $max = max($row['php'],$row['mysql'],$row['htmlcss']);
    $min = min($row['php'],$row['mysql'],$row['htmlcss']);
    $avg = ($row['php']+$row['mysql']+$row['htmlcss'])/3;

    echo "
    <tr>
    <td>{$row['mssv']}</td>
    <td>{$row['hoten']}</td>
    <td>".round($dtb,2)."</td>
    <td>$xeploai</td>
    <td>$hocbong</td>
    <td>$max</td>
    <td>$min</td>
    <td>".round($avg,2)."</td>
    <td>
        <a href='?xoa={$row['mssv']}'>Xóa</a>
    </td>
    </tr>
    ";
}

?>

</table>

<h3>THỐNG KÊ</h3>

<?php
echo "Tổng sinh viên: $tongSV <br>";
echo "Tổng sinh viên có học bổng: $tongHocBong <br>";
echo "Sinh viên giỏi: $gioi <br>";
echo "Sinh viên khá: $kha <br>";
echo "Sinh viên trung bình: $tb <br>";
echo "Sinh viên yếu: $yeu <br>";
?>

<br><br>

<a href="them.php">Thêm sinh viên</a>

</body>
</html>