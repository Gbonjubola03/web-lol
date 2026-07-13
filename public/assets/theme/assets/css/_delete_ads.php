<?php
include("../../init.php");
include("../../include/secure_login.php");

if ($m_authors == 'off') {
    die('<script>Swal.fire("' . $text90 . '", "' . $textadmin464 . '", "warning")</script>');
}

if (empty($_POST['csrf_token']) or hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']) == FALSE) {
    die('<script>Swal.fire("' . $text90 . '", "' . $textadmin487 . '", "warning")</script>');
}

$del = $mysqli->escape_string($_POST['id']);
$conditions = [['id', '=', $del], ['user_id', '=', $UserId]];
$image_ad  = $website->sqlSelectTables('ad_user', ['image'], $conditions, 'array');

$website->sqlDelete('ad_user', ['id', $del], ['user_id', $UserId]);
unlink("../../uploads/ads/" . $image_ad['image']);
die('<script>Swal.fire("' . $text93 . '", "' . $text95 . '", "success")</script>');