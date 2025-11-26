<?php include "data.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Danh sách hoa</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #444; padding: 10px; }
        img { width: 60px; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>

<h2>Quản lý danh sách hoa</h2>

<table>
    <thead>
        <tr>
            <th>Ảnh</th>
            <th>Tên hoa</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($flowers as $index => $flower): ?>
        <tr>
            <td><img src="images/<?= $flower['anh'] ?>" alt="" width="200"></td>
            <td><?= $flower['name'] ?></td>
            <td><?= $flower['desc'] ?></td>
            <td>
                <a href="edit.php?id=<?= $index ?>">Sửa</a> |
                <a href="delete.php?id=<?= $index ?>">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
