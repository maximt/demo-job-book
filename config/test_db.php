<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
// $db['dsn'] = 'mysql:host=localhost;dbname=yii2basic_test'; // local
$db['dsn'] = 'mysql:host=db;dbname=test_test'; // docker

return $db;
