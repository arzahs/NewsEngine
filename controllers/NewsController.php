<?php


class NewsController
{
    public function actionAll()
    {

        $article = new NewsModel();
        $article->title = 'Привет!';
        $article->text = 'Привет world!';
        $article->insert();
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