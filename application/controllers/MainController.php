<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller {

	public function indexAction() {
		$this->view->render('О музее');
	}

	public function postsAction() {
		$pagination = new Pagination($this->route, $this->model->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route),
		];
		$this->view->render('Новости', $vars);
	}

	public function eventsAction() {
		$pagination = new Pagination($this->route, $this->model->eventsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->eventsList($this->route),
		];
		$this->view->render('Мероприятия', $vars);
	}

	public function objectsAction() {
		$pagination = new Pagination($this->route, $this->model->objectsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->objectsList($this->route),
		];
		$this->view->render('Экспонаты', $vars);
	}

	public function objects1Action() {
		$pagination = new Pagination($this->route, $this->model->objects1Count());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->objects1List($this->route),
		];
		$this->view->render('Экспонаты', $vars);
	}

	public function objects2Action() {
		$pagination = new Pagination($this->route, $this->model->objects2Count());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->objects2List($this->route),
		];
		$this->view->render('Экспонаты', $vars);
	}

	public function objects3Action() {
		$pagination = new Pagination($this->route, $this->model->objects3Count());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->objects3List($this->route),
		];
		$this->view->render('Экспонаты', $vars);
	}

	public function objects4Action() {
		$pagination = new Pagination($this->route, $this->model->objects4Count());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->objects4List($this->route),
		];
		$this->view->render('Экспонаты', $vars);
	}

	public function contactAction() {
		if (!empty($_POST)) {
			if (!$this->model->contactValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			mail('kovtunovtn@gmail.com', 'Сайт музея. Обратная связь', 'Обратная связь от пользователя '.$_POST['name'].' ('.$_POST['email'].'): '.$_POST['text']);
			$this->view->message('success', 'Сообщение отправлено Администратору');
		}
		$this->view->render('Контакты');
	}

	public function visitAction() {
		if (!empty($_POST)) {
			if (!$this->model->visitValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			mail('kovtunovtn@gmail.com', 'Сайт музея. Запись в музей', 'Запись в музей от пользователя '.$_POST['name'].' ('.$_POST['email'].') на дату '.$_POST['date'].' со следующим комментарием: '.$_POST['text']);
			$this->view->message('success', 'Сообщение отправлено Администратору');
		}
		$this->view->render('Записаться');
	}

	public function postAction() {
		$adminModel = new Admin;
		if (!$adminModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->postData($this->route['id'])[0],
		];
		$this->view->render('Новость', $vars);
	}

	public function eventAction() {
		$adminModel = new Admin;
		if (!$adminModel->isEventExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->eventData($this->route['id'])[0],
		];
		$this->view->render('Мероприятие', $vars);
	}

	public function objectAction() {
		$adminModel = new Admin;
		if (!$adminModel->isObjectExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->objectData($this->route['id'])[0],
		];
		$this->view->render('Экспонат', $vars);
	}
}