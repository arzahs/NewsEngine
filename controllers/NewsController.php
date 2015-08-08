<?php


class NewsController
{
    public function actionAll()
    {
        $items = News::getAll();
        $view = new View();
        $view->assign('items', $items);
        $view->display('news/all.php');

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