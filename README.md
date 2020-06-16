# cl_general installation

download zip

## Setup PHP scripts
- create /var/www/html/cl_general folder
- extract all files to  /var/www/html/cl_general
- run command:
```
chmod -R www-data:www-data /var/www/html/cl_general
```

#### create /var/gmcs_config/staff.conf with following content
```
<?php
$GLOBALS['main_user']='mysql user';
$GLOBALS['main_pass']='mysql password';

$GLOBALS['email_user']='mysql email database user';
$GLOBALS['email_pass']='mysql email database pass';
$GLOBALS['email_db_server']='email database ip';
?>
```
- run command:
```
chmod -R www-data:www-data /var/gmcs_config
```

## create database

- /var/www/html/cl_general folder have many SQL
- create database cl_general
- import cl_general_blank.sql
- import other sql files one by one if you have some readymade data

# Run Program
- create one user in user table of database (use entrypt() for password)
- browse: 127.0.0.1/cl_general
- login using user id and password
- explore

feel free to contact:9664555812 (India, WhatApp), biochemistrygmcs@gmail.com
