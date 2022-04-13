<?php

use Originera\Wechat\General\Code2Session;
use Originera\Wechat\WeChar;

include "./vendor/autoload.php";

$weChar = new WeChar("appid","secret");

$code = new Code2Session();
$code->js_code = "";
$weChar->inject($code);

$weChar->fetch();