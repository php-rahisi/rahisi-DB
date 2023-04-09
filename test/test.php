<?php

use Rahisi\RahisiDb\DB;

require '../vendor/autoload.php';

var_dump(DB::table("accounts")->where(["id" => 1])->get());