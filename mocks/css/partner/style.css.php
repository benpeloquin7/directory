<?php
include_once '../css.class.php';

$oCSS = new CSS();
$oCSS->parse_file("retina.css");
//$keys = array('top', 'right', 'bottom', 'left', 'width', 'height', 'margin', 'margin-top', 'margin-right', 'margin-bottom', 'margin-left', 'padding', 'padding-top', 'padding-right', 'padding-bottom', 'padding-left', 'background-position', 'background');
$oCSS->parse_for_retina();
$result = $oCSS->build_css();


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header("Content-type: text/css", true);

echo ($result);
?>
