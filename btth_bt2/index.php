<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Bài Thi Trắc Nghiệm </title>
<style>
   h1 { 
            text-align:center;
             
            }
        
        .options label { 
            display:block;
         }
       
        input[type="radio"] { 
            transform: scale(1.3);  
        }
        
</style>
</head>
<body>

<h1>BÀI THI TRẮC NGHIỆM </h1>

<?php
$filename = "Quiz.txt";

if (!file_exists($filename)) {
    die("<p style='color:red;text-align:center;font-size:22px;'>Không tìm thấy file <b>Quiz.txt</b>! Hãy đặt cùng thư mục với file PHP này.</p>");
}

$content = file_get_contents($filename);
$blocks = preg_split('/(?=ANSWER:)/m', $content);

$questions = [];
foreach ($blocks as $block) {
    $block = trim($block);
    if (empty($block)) continue;

    if (!preg_match('/ANSWER:\s*([ABCD])/i', $block, $m)) continue;
    $correct = strtoupper($m[1]);

    $lines = array_filter(array_map('trim', explode("\n", $block)));
    $question = "";
    $options = [];

    foreach ($lines as $line) {
        $line = trim($line);
        if (str_starts_with(strtoupper($line), 'ANSWER:')) continue;
        if (preg_match('/^[ABCD][\.\)]\s*/i', $line)) {
            $options[] = $line;
        } elseif (empty($options) && $line !== "") {
            $question .= $line . " ";
        }
    }

    if ($question !== "" && count($options) >= 3) {
        $questions[] = [
            'text'    => trim($question),
            'options' => $options,
            'correct' => $correct
        ];
    }
}

$total = count($questions);
$diem = 0;
$ketqua = [];

if ($_POST) {
    foreach ($questions as $i => $q) {
        $chon = $_POST["q$i"] ?? "";
        if ($chon === $q['correct']) {
            $diem++;
            $ketqua[$i] = "dung";
        } else {
            $ketqua[$i] = "sai";
        }
    }
}
?>



<form method="post">
<?php foreach($questions as $i => $q): ?>
    <div class="cau">
        <b>Câu <?= $i+1 ?>:</b> <?= htmlspecialchars($q['text']) ?><br><br>
        <div class="options">
            <?php foreach($q['options'] as $opt):
                $value = strtoupper($opt[0]);
            ?>
                <label>
                    <input type="radio" name="q<?= $i ?>" value="<?= $value ?>">
                    <?= htmlspecialchars($opt) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <?php if (isset($ketqua[$i])): ?>
            <div style="margin-top:15px; font-size:18px; font-weight:bold;">
                <?php if ($ketqua[$i] == "dung"): ?>
                    <span class="dung">Đáp Án<?= $q['correct'] ?></span>
                <?php else: ?>
                    <span class="sai">Đáp Án<?= $q['correct'] ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<center>
    <button type="submit">NỘP BÀI & XEM KẾT QUẢ</button>
</center>
</form>

<?php if ($_POST): ?>
<div class="ketqua">
    <h2>KẾT QUẢ CỦA BẠN</h2>
    <p>Đúng <b style="font-size:48px; color:green;"><?= $diem ?>/<?= $total ?></b> câu</p>
    <p style="font-size:60px; color:#2e7d32; margin:20px 0;">
        ĐIỂM: <b><?= number_format($diem / $total * 10, 1) ?>/10</b>
    </p>
</div>
<?php endif; ?>

</body>
</html>