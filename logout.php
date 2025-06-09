<?php
session_start();
session_destroy();
header("Location: http://10.4.96.116/vocabfront/login.html");
exit;
?>