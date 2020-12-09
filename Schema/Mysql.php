<?php

namespace Kanboard\Plugin\TaskCreatedDate\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec(
    "
        CREATE TABLE IF NOT EXISTS task_created_date_general_settings 
        (
            user_id INT(11) NOT NULL,
            enabled INT(1) DEFAULT 1,
            UNIQUE(user_id)
        ) ENGINE=InnoDB CHARSET=utf8
    ");	 
}
