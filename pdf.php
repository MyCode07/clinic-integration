<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

ob_start();
require 'pdf-test.html';
$html = ob_get_contents();
ob_clean();
$mpdf->WriteHTML($html);
$mpdf->Output();