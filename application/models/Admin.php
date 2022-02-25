<?php

namespace application\models;

use application\core\Model;
use Imagick;

class Admin extends Model {

	public $error;

	public function loginValidate($post) {
		$config = require 'application/config/admin.php';
		if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
			$this->error = 'Логин или пароль указан неверно';
			return false;
		}
		return true;
	}

	public function postValidate($post, $type) {
		$nameLen = iconv_strlen($post['name']);
		$descriptionLen = iconv_strlen($post['description']);
		$textLen = iconv_strlen($post['text']);
		$dateLen = iconv_strlen($post['date']);
		if ($nameLen == 0) {
			$this->error = 'Не заполнено название';
			return false;
		} elseif ($descriptionLen == 0) {
			$this->error = 'Не заполнено описание';
			return false;
		} elseif ($textLen == 0) {
			$this->error = 'Не заполнен текст';
			return false;
		} elseif ($dateLen == 0) {
			$this->error = 'Не заполнена дата';
			return false;
		}
		if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
			$this->error = 'Не выбрано изображение';
			return false;
		}
		return true;
	}

	public function postAdd($post) {
		$params = [
			'date' => $post['date'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('INSERT INTO posts (date,name,description,text) VALUES (:date,:name, :description, :text)', $params);
		return $this->db->lastInsertId();
	}

	public function postEdit($post, $id) {
		$params = [
			'id' => $id,
			'date' => $post['date'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('UPDATE posts SET date = :date, name = :name, description = :description, text = :text WHERE id = :id', $params);
	}

	public function postUploadImage($path, $id) {
		$img = new Imagick($path);
		$img->cropThumbnailImage(1080, 600);
		$img->setImageCompressionQuality(80);
		$img->writeImage('public/materials/posts/'.$id.'.jpg');
	}

	public function isPostExists($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
	}

	public function postDelete($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM posts WHERE id = :id', $params);
		unlink('public/materials/posts/'.$id.'.jpg');
	}

	public function postData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
	}

	public function objectValidate($post, $type) {
		$nameLen = iconv_strlen($post['name']);
		$descriptionLen = iconv_strlen($post['description']);
		$textLen = iconv_strlen($post['text']);
		$dateLen = iconv_strlen($post['date']);
		$typeLen = iconv_strlen($post['type']);
		if ($nameLen == 0) {
			$this->error = 'Не заполнено название';
			return false;
		} elseif ($descriptionLen == 0) {
			$this->error = 'Не заполнено описание';
			return false;
		} elseif ($textLen == 0) {
			$this->error = 'Не заполнен текст';
			return false;
		} elseif ($dateLen == 0) {
			$this->error = 'Не заполнена дата';
			return false;
		} elseif ($typeLen == 0) {
			$this->error = 'Не выбран тип экспоната';
			return false;
		}
		if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
			$this->error = 'Не выбрано изображение';
			return false;
		}
		return true;
	}

	public function objectAdd($post) {
		$params = [
			'date' => $post['date'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
			'type' => $post['type'],
		];
		$this->db->query('INSERT INTO objects (date,name,description,text,type) VALUES (:date,:name, :description, :text, :type)', $params);
		return $this->db->lastInsertId();
	}

	public function objectEdit($post, $id) {
		$params = [
			'id' => $id,
			'date' => $post['date'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
			'type' => $post['type'],
		];
		$this->db->query('UPDATE objects SET date = :date, name = :name, description = :description, text = :text, type = :type WHERE id = :id', $params);
	}

	public function objectUploadImage($path, $id) {
		$img = new Imagick($path);
		$img->cropThumbnailImage(1080, 600);
		$img->setImageCompressionQuality(80);
		$img->writeImage('public/materials/objects/'.$id.'.jpg');
	}

	public function isObjectExists($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM objects WHERE id = :id', $params);
	}

	public function objectDelete($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM objects WHERE id = :id', $params);
		unlink('public/materials/objects/'.$id.'.jpg');
	}

	public function objectData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM objects WHERE id = :id', $params);
	}

	public function eventValidate($post, $type) {
		$nameLen = iconv_strlen($post['name']);
		$descriptionLen = iconv_strlen($post['description']);
		$textLen = iconv_strlen($post['text']);
		$dateLen = iconv_strlen($post['date']);
		if ($nameLen == 0) {
			$this->error = 'Не заполнено название';
			return false;
		} elseif ($descriptionLen == 0) {
			$this->error = 'Не заполнено описание';
			return false;
		} elseif ($textLen == 0) {
			$this->error = 'Не заполнен текст';
			return false;
		} elseif ($dateLen == 0) {
			$this->error = 'Не заполнена дата';
			return false;
		}
		if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
			$this->error = 'Не выбрано изображение';
			return false;
		}
		return true;
	}

	public function eventAdd($post) {
		$params = [
			'date' => $post['date'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('INSERT INTO events (date,name,description,text) VALUES (:date,:name, :description, :text)', $params);
		return $this->db->lastInsertId();
	}

	public function eventEdit($post, $id) {
		$params = [
			'id' => $id,
			'date' => $post['date'],
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('UPDATE events SET date = :date, name = :name, description = :description, text = :text WHERE id = :id', $params);
	}

	public function eventUploadImage($path, $id) {
		$img = new Imagick($path);
		$img->cropThumbnailImage(1080, 600);
		$img->setImageCompressionQuality(80);
		$img->writeImage('public/materials/events/'.$id.'.jpg');
	}

	public function isEventExists($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM events WHERE id = :id', $params);
	}

	public function eventDelete($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM events WHERE id = :id', $params);
		unlink('public/materials/events/'.$id.'.jpg');
	}

	public function eventData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM events WHERE id = :id', $params);
	}
}