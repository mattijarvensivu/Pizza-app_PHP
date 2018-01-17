<?php
// db-init.php
$db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname=H4102;charset=utf8',
              'H4102', 'wIM4uHzo3kJiAQPfimDTPuuyaA1oFwdy');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>