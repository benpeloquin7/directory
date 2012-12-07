<?php
/*
 * Configure the application
 */

$abs = dirname(__FILE__);

$document_root = $_SERVER['DOCUMENT_ROOT'];

$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace($document_root, '', $abs);

$request_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $_SERVER['QUERY_STRING'];

echo 'document root: ' . $document_root;
echo '<br />';
echo 'url: ' . $url;
echo '<br />';
echo 'request_url: ' . $request_url;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $url . DS);

$email = '';

if(isset($_COOKIE['PartnerApp'])) {
    $cookie = $_COOKIE['PartnerApp'];
    $email = (isset($cookie['email'])) ? $cookie['email'] : '';
}

?>
