<?php

namespace Asrac\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use cms\Domain\Article;
use cms\Form\Type\ArticleType;

class AdminController {

	public function indexAction(Application $app) {
        $articles = $app['dao.article']->findAll();
        return $app['twig']->render('admin.html.twig', array(
            'articles' => $articles));
    }

	public function addArticleAction(Request $request, Application $app) {
			$article = new Article();
			$articleForm = $app['form.factory']->create(new ArticleType(), $article);
			$articleForm->handleRequest($request);
			if ($request->isMethod('POST')) {
				if ($articleForm->isValid()) {
					$image = $request->files->get($articleForm->getName());
					/* Make sure that Upload Directory is properly configured and writable */
					$path = __DIR__.'/../../web/images/Articles/';
					$filename = $image['image']->getClientOriginalName();
					$image['image']->move($path,$filename);
					$article->setImage($filename);

					$message = 'File was successfully uploaded!';

				}
			}
			if ($articleForm->isSubmitted() && $articleForm->isValid()) {
				$app['dao.article']->save($article);
				$app['session']->getFlashBag()->add('success', 'The article was successfully created.');
			}
			return $app['twig']->render('article_form.html.twig', array(
				'title' => 'New article',
				'articleForm' => $articleForm->createView()));
	}

	public function editArticleAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $articleForm = $app['form.factory']->create(new ArticleType(), $article);
        $articleForm->handleRequest($request);
		if ($request->isMethod('POST')) {
			if ($articleForm->isValid()) {
				$files = $request->files->get($articleForm->getName());
				/* Make sure that Upload Directory is properly configured and writable */
				$path = __DIR__.'/../../web/images/Articles/';
				$filename = $files['image']->getClientOriginalName();
				$files['image']->move($path,$filename);
				$article->setImage($filename);
				$message = 'File was successfully uploaded!';
			}
    	}
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was succesfully updated.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'Edit article',
            'articleForm' => $articleForm->createView()));
   }
}
