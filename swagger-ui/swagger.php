<?php
/**
 * Created by PhpStorm.
 * User: yasinyaqoobi
 * Date: 1/2/16
 * Time: 11:16 PM
 */
require("../vendor/autoload.php");
$swagger = \Swagger\scan('/Users/yasinyaqoobi/Sites/dictionary_api/annotations');
header('Content-Type: application/json');
echo $swagger;