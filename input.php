<?php
date_default_timezone_set('Asia/Tokyo');

$temp_raw = isset($_GET['temp']) ? $_GET['temp'] : null;
$is_success = isset($_GET['success']);
$display_temp = isset($_GET['t']) ? htmlspecialchars($_GET['t']) : '';

if ($temp_raw !== null && !$is_success) {
    $temp = $temp_raw / 10;

    if ($temp >= 30.0 && $temp <= 40.0) {
        $fh = fopen("__OUTPUTDIR__/temp.csv", "a");
        if ($fh) {
            fputcsv($fh, [date('Y-m-d H:i:s'), $temp]);
            fclose($fh);

            header("Location: input.php?success=1&t=" . $temp);
            exit;
        }
    } else {
        $error_msg = "体温（{$temp}℃）が範囲外です。入力し直してください。";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>送信結果</title>
<style>
  body { font-family: sans-serif; text-align: center; padding-top: 50px; font-size: 24pt; }
  .success { color: #2c3e50; }
  .error { color: #e74c3c; }
  .back-link { display: inline-block; margin-top: 30px; padding: 10px 20px; background: #eee; text-decoration: none; color: #333; border-radius: 5px; }
</style>
</head>
<body>
<?php if ($is_success): ?>
    <div class="success">
        <p>記録しました</p>
        <p style="font-size: 48pt; font-weight: bold;"><?php echo $display_temp; ?> ℃</p>
        <p style="font-size: 14pt;"><?php echo date('Y-m-d H:i:s'); ?></p>
    </div>
    <a href="index.html" class="back-link">戻る</a>

<?php elseif (isset($error_msg)): ?>
    <div class="error">
        <p><?php echo $error_msg; ?></p>
        <a href="index.html" class="back-link">入力画面へ戻る</a>
    </div>

<?php else: ?>
    <p>直接アクセスはできません。</p>
    <a href="index.html" class="back-link">戻る</a>
<?php endif; ?>
</body>
</html>
