<?php
/**
 * 生成数据库文档
 * @author leo
 */
include 'vendor/autoload.php';
include 'Generate.php';

$dbname = 'getyii';

$generate = new Generate('mysql:host=localhost', 'root', '');

$twigLoader = new Twig_Loader_String();
$twig = new Twig_Environment($twigLoader);

$html = $twig->render(file_get_contents('template.html.twig'), array(
    'dbname' => $dbname,
    'tables' => $generate->getDbInfo($dbname)
));

// print_r($generate->getDbInfo($dbname));

file_put_contents("Doc/{$dbname}.html", $html);