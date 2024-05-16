<?php

ob_start();
?>
<!DOCTYPE html>
<html lang="<?php echo $json_data['locale'] ?>" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="assets/css/style.min.css?_v=20240507194916">
</head>
<?
$content = ob_get_contents();
ob_end_clean();

$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/page.html", "wb");
fwrite($fp, $content);
fclose($fp);