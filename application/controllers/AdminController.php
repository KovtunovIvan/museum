<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Main;

class AdminController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

	public function loginAction() {
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/posts');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->location('admin/posts');
		}
		$this->view->render('Вход');
	}

	public function logoutAction() {
		unset($_SESSION['admin']);
		$this->view->redirect('admin/login');
	}

	public function addPostAction() {
		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'add')) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->postAdd($_POST);
			if (!$id) {
				$this->view->message('error', 'Ошибка обработки запроса');
			}
			$this->model->postUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('success', 'Новость добавлена');
		}
		$this->view->render('Добавить новость');
	}

	public function editPostAction() {
		if (!$this->model->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'edit')) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->postEdit($_POST, $this->route['id']);
			if ($_FILES['img']['tmp_name']) {
				$this->model->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			$this->view->message('success', 'Сохранено');
		}
		$vars = [
			'data' => $this->model->postData($this->route['id'])[0],
		];
		$this->view->render('Редактировать новость', $vars);
	}

	public function deletePostAction() {
		if (!$this->model->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->postDelete($this->route['id']);
		$this->view->redirect('admin/posts');
	}

	public function postsAction() {
		$mainModel = new Main;
		$pagination = new Pagination($this->route, $mainModel->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $mainModel->postsList($this->route),
		];
		$this->view->render('Новости', $vars);
	}

	public function addObjectAction() {
		if (!empty($_POST)) {
			if (!$this->model->objectValidate($_POST, 'add')) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->objectAdd($_POST);
			if (!$id) {
				$this->view->message('error', 'Ошибка обработки запроса');
			}
			$this->model->objectUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('success', 'Экспонат добавлен');
		}
		$this->view->render('Добавить экспонат');
	}

	public function editObjectAction() {
		if (!$this->model->isObjectExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->objectValidate($_POST, 'edit')) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->objectEdit($_POST, $this->route['id']);
			if ($_FILES['img']['tmp_name']) {
				$this->model->objectUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			$this->view->message('success', 'Сохранено');
		}
		$vars = [
			'data' => $this->model->objectData($this->route['id'])[0],
		];
		$this->view->render('Редактировать экспонат', $vars);
	}

	public function deleteObjectAction() {
		if (!$this->model->isObjectExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->objectDelete($this->route['id']);
		$this->view->redirect('admin/objects');
	}

	public function objectsAction() {
		$mainModel = new Main;
		$pagination = new Pagination($this->route, $mainModel->objectsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $mainModel->objectsList($this->route),
		];
		$this->view->render('Экспонаты', $vars);
	}

	public function addEventAction() {
		if (!empty($_POST)) {
			if (!$this->model->eventValidate($_POST, 'add')) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->eventAdd($_POST);
			if (!$id) {
				$this->view->message('error', 'Ошибка обработки запроса');
			}
			$this->model->eventUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('success', 'Мероприятие добавлено');
		}
		$this->view->render('Добавить мероприятие');
	}

	public function editEventAction() {
		if (!$this->model->isEventExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->eventValidate($_POST, 'edit')) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->eventEdit($_POST, $this->route['id']);
			if ($_FILES['img']['tmp_name']) {
				$this->model->eventUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			$this->view->message('success', 'Сохранено');
		}
		$vars = [
			'data' => $this->model->eventData($this->route['id'])[0],
		];
		$this->view->render('Редактировать мероприятие', $vars);
	}

	public function deleteEventAction() {
		if (!$this->model->isEventExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->eventDelete($this->route['id']);
		$this->view->redirect('admin/events');
	}

	public function eventsAction() {
		$mainModel = new Main;
		$pagination = new Pagination($this->route, $mainModel->eventsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $mainModel->eventsList($this->route),
		];
		$this->view->render('Мероприятия', $vars);
	}
}