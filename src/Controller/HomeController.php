<?php

namespace Asrac\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {
	//
//    public function indexAction(Application $app) {
//        $articles = $app['dao.article']->findAll();
//        return $app['twig']->render('index.html.twig', array('articles' => $articles));
//    }

	public function allArticles(Application $app) {
        $articles = $app['dao.article']->findAll();
        return $app['twig']->render('index.html.twig', array('articles' => $articles));
    }
}
