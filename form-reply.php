<?php

require_once('backend/common/logger.php');

logger('form is working!');

logger($_POST);

$user = $_POST['name'];
$email = $_POST['email'];

echo json_encode($_POST);