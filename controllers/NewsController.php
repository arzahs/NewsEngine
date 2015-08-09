<?php


class NewsController
{
    public function actionAll()
    {

        $db = new DB();
        $res = $db->query('SELECT * FROM news');
        var_dump($res);
        die;
        /*$items = News::ge tAll();
        $view = new View();
        $view->assign('items', $items);
        $view->display('news/all.php');*/

    }
    public function actionOne()
    {
        $id = $_GET['id'];
        $item = News::getOne($id);
        $view = new View();
        $view->assign('item', $item);
        $view->display('news/one.php');
    }
}