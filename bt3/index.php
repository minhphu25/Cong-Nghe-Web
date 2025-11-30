<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh Sách Sinh Viên - CSE485_202401</title>
<style>
   
</style>
</head>
<body>

<h1>DANH SÁCH SINH VIÊN - </h1>

<?php
$filename = "danhsach.csv";

if (!file_exists($filename)) {
    die("<p style='color:red; text-align:center; font-size:24px;'>Không tìm thấy file <b>$filename</b>!</p>");
}

// === PHẦN QUAN TRỌNG NHẤT – ĐÃ TEST 100% TRÊN XAMPP WINDOWS ===
$content = file_get_contents($filename);

// 1. Loại bỏ BOM nếu có
if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
    $content = substr($content, 3);
}

// 2. Chuyển từ Windows-1258 (Excel) → UTF-8 đúng cách (không dùng mb_convert)
$content = iconv('CP1258', 'UTF-8//IGNORE', $content);
// Nếu vẫn lỗi thì dùng dòng dưới (cực kỳ an toàn)
// $content = utf8_encode($content);

// 3. Tách CSV
$lines = str_getcsv($content, "\n");
$data = [];
foreach ($lines as $line) {
    $data[] = str_getcsv($line, ",");
}

$total = count($data) - 1;
echo "<div class='info'><strong>Tổng cộng: $total sinh viên</strong></div>";

echo "<table>
<tr>
    <th>STT</th>
    <th>MSSV</th>
    <th>Họ</th>
    <th>Tên</th>
    <th>Lớp</th>
    <th>Email</th>
    <th>Khóa học</th>
</tr>";

foreach ($data as $i => $row) {
    if ($i == 0) continue; // bỏ qua dòng tiêu đề
    $mssv    = $row[0] ?? '';
    $ho      = $row[2] ?? '';
    $ten     = $row[3] ?? '';
    $lop     = $row[4] ?? '';
    $email   = $row[5] ?? '';
    $khoahoc = $row[6] ?? '';

    echo "<tr>
        <td style='text-align:center; font-weight:bold;'>$i</td>
        <td><strong>$mssv</strong></td>
        <td>$ho</td>
        <td>$ten</td>
        <td style='text-align:center;'>$lop</td>
        <td>$email</td>
        <td style='color:#d32f2f; font-weight:bold; text-align:center;'>$khoahoc</td>
    </tr>";
}
echo "</table>";
?>

</body>
</html>