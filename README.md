# rahisi-DB
rahisiDb library is used to simplify interaction with database

Requirements
============

PHP versions and extensions
---------------------------

- `PHP 8.1.6` is supported as of `rahisiDb v1.1.1`

Usage
=====

The simplest usage (since version 1.0.0) of the library would be as follows:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Rahisi\RahisiDb\DB;

// selecting
DB::table("accounts")->where(["id" => 1])->get() //this will select * from accounts where id = 1

// inserting
DB::table("accounts")->insert(["id" => 1]) //this will INSERT INTO accounts set ("id") value (1)

// Updating
DB::table("accounts")->Update(["name" => "josh"])->where(['id'=>1])->save() //this will UPDATE accounts SET `name`="josh" where id=1

```