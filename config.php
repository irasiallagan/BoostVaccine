


<?php
$root = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
define('BASE_URL', $root);

// Misalnya, mengarahkan TEMPLATE_URL ke folder includes di dalam views (di luar public jika diperlukan)
define('TEMPLATE_URL', $root . '../views/includes/');
