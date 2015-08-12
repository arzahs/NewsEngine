<?php

require_once __DIR__.'/autoload.php';

$path=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);
var_dump($pathParts);

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';

/*$ctrl = !empty($pathParts[1]) ? $pathParts[1] : 'News';
$act = !empty($pathParts[2]) ? $pathParts[2] : 'All';
*/
$controllerClassName = $ctrl.'Controller';

try{
    $controller = new $controllerClassName;
    $method = 'action' . $act;
    $controller->$method();

}catch(Exception $e){
    $view = new View();
    $view->error = $e->getMessage();
    $view->display('error.php');

}
?>

