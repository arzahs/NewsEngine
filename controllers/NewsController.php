<?php


class NewsController
{
    public function actionAll()
    {

        $art = NewsModel::findOneByColumn('title', 'New header1');
        $art->title = 'New header';
        $art->save();
       /* $art = new NewsModel();
        $art->title = 'Today in world';
        $art->text = 'ololdfvdsvsd';
        $art->insert();

        var_dump($art->id);
       /* $article = new NewsModel();
        $article->title = 'Привет!';
        $article->text = 'Привет world!';*/

        //var_dump( isset($article->title) );

        /*$article->insert();*/

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