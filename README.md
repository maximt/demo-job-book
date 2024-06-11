# Demo project

Web

    copy ./job-book to /web-root/job-book
    set DocumentRoot /web-root/job-book/web

Database

    config/db.php

    'dsn' => 'mysql:host=localhost;dbname=test', // local
    ...or
    'dsn' => 'mysql:host=db;dbname=test', // docker

Data dump

    mysql -u test -p test < dump.sql // local
    ...or
    mysql -P 33060 -u test -p test < dump.sql // docker

Optional: Run docker (web + mysql)

    docker compose up



Default account

    Login: admin
    Password: admin

