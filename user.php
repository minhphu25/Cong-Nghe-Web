<?php
include 'data.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTTH01</title>
</head>
<body>
    
<?php foreach ($flowers as $flower): ?>
    <div>
        <img src="images/<?= $flower['anh'] ?>" alt="" width="200">
        <h3><?= $flower['name'] ?></h3>
        <p><?= $flower['desc'] ?></p>
    </div>
<?php endforeach; ?>

 
</body>
</html>
        
       