<?php
App::import('Sanitize');
class ArticlesController extends AppController {

	var $name = 'Articles';
	
	function index($filter = 'editions') {
		$this->set('title_for_layout', 'Home');
		$articles = array();
		switch ($filter) {
			case 'editions':
				$editions = $this->Article->Edition->find('all', array('limit' => 10, 'order' => array('Edition.name DESC'), 'recursive' => 0));
				foreach ($editions as $key => $edition)
					$articles[$key] = $this->Article->find('all', array('limit' => 4, 'conditions' => array('edition_id' => $edition['Edition']['id'])));
				break;
			case 'tags':
				$tags = $this->Article->Tag->find('all', array('recursive' => 1));//print_r($tags);
				$tag_ids =array();
				foreach ($tags as $key => $tag)
					$tag_ids[] = $tag['Tag']['id'];
				$articles = $this->Article->Tag->find('all', array('conditions' => array('Tag.id' => $tag_ids)));
				break;
		}

		if (isset($this->params['requested'])) {
			return $articles;
		}
		else {
			$this->set('articles', $articles);
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Het artikel bestaat niet', true));
			$this->redirect(array('action' => 'index'));
		}
		$article = $this->Article->read(null, $id);
		if (isset($this->params['requested'])) {
			return $article;
		}
		else {
			$this->set('title_for_layout', $article['Article']['title']);
			$this->set('article', $article);
		}
	}
	
	function admin_index($company = null){
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Het artikel bestaat niet', true));
			$this->redirect(array('action' => 'index'));
		}
		$article = $this->Article->read(null, $id);
		$this->set('title_for_layout', $article['Article']['title']);
		$this->set('article', $article);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->data['Article']['title'] = $this->data['Article']['title'];
			$this->data['Article']['summary'] = $this->data['Article']['summary'];
			if($this->Article->save($this->data)) {
				$failedPhotos = Array();
				$succeededPhotos = Array();
				if ($this->data['Image'][0]['file']['name'] != null) {
					$image_paths = $this->Image->upload_image_and_thumbnail($this->data, "file", 960, 70, "images", true);print_r($image_paths);
					foreach ($this->data['Image'] as $key => $photo) {
						$this->Article->Photo->create();
						$photo['article_id'] = $this->Article->id;
						$photo['name'] = $image_paths[$key];
						$photo['order_key'] = $key + 1;
						if ($this->Article->Photo->save($photo))
							array_push($succeededPhotos, $image_paths[$key]);
						else
							array_push($failedPhotos, $image_paths[$key]);
					}
				}
				if (empty($failedPhotos)) {
					$this->Session->setFlash(__('Het artikel en de volgende foto(s) zijn opgeslagen.', true).' '.__('Foto\'s', true).': '.implode(', ', $succeededPhotos).'.');
					$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'edit', $this->Article->id));
				}
				else {
					$this->Article->delete($this->Article->id);
					$this->Session->setFlash(__('De volgende foto(s) konden niet worden opgeslagen:', true).' '.implode(', ', $failedPhotos).'.');
				}
			}
			else {
				$this->Session->setFlash(__('Het artikel kon niet worden opgeslagen, probeer het opnieuw', true));
			}
		}
		$users = $this->Article->User->find('list');
		$editions = $this->Article->Edition->find('list');
		$authors = $this->Article->Author->find('list');
		$tags = $this->Article->Tag->find('list');
		$books = $this->Article->Book->find('list');
		$this->set(compact('users', 'editions', 'authors', 'tags', 'books'));
	}

	function admin_edit($id) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Het artikel bestaat niet', true));
			$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Article']['title'] = $this->data['Article']['title'];
			$this->data['Article']['summary'] = $this->data['Article']['summary'];
			if ($this->Article->save($this->data)) {
				$failedPhotos = Array();
				$succeededPhotos = Array();
				if (isset($this->data['Photo'])) {
					foreach ($this->data['Photo'] as $existingPhoto) {
						if ($existingPhoto['delete'] == 1) {
							$this->Image->delete_image($existingPhoto['name'], 'images');
							$this->Article->Photo->delete($existingPhoto['id']);
							$sortPhotos = $this->Article->Photo->find('all', array('conditions' => array('Photo.article_id' => $id), 'order' => array('Photo.order_key' => 'ASC')));
							foreach($sortPhotos as $key => $sortPhoto) {
								$sortPhoto['Photo']['order_key'] = $key + 1;
								$this->Article->Photo->save($sortPhoto);
							}
						}
					}
				}
				$photos = $this->Article->Photo->find('all', array('conditions' => array('Photo.article_id' => $id)));
				$photoStartOrder = count($photos);
				if ($this->data['Image'][0]['file']['name'] != null) {
					$image_paths = $this->Image->upload_image_and_thumbnail($this->data, "file", 191, 70, "images", true);
					foreach ($this->data['Image'] as $key => $photo) {
						$this->Article->Photo->create();
						$photo['article_id'] = $this->Article->id;
						$photo['name'] = $image_paths[$key];
						$photo['order_key'] = $key + 1 + $photoStartOrder;
						if ($this->Article->Photo->save($photo))
							array_push($succeededPhotos, $image_paths[$key]);
						else
							array_push($failedPhotos, $image_paths[$key]);
					}
				}
				if (empty($failedPhotos)) {
					$this->Session->setFlash(__('Het artikel en de volgende foto(s) zijn opgeslagen:', true).' '.__('Foto\'s', true).': '.implode(', ', $succeededPhotos).'.');
					$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'edit', $id));
				}
				else {
					$this->Session->setFlash(__('De volgende foto(s) konden niet worden opgeslagen:', true).' '.implode(', ', $failedPhotos).'.');
				}
			}
			else {
				$this->Session->setFlash(__('Het artikel kon niet worden opgeslagen, probeer het opnieuw', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Article->read(null, $id);
		}
		$users = $this->Article->User->find('list');
		$editions = $this->Article->Edition->find('list');
		$authors = $this->Article->Author->find('list');
		$tags = $this->Article->Tag->find('list');
		$books = $this->Article->Book->find('list');
		$this->set(compact('users', 'editions', 'authors', 'tags', 'books'));
		if (isset($this->data['Photo']))
			$this->set('count', count($this->data['Photo']));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Het artikel bestaat niet', true));
			$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'index'));
		}
		if ($id) {
			if ($this->Article->delete($id)) {
				$this->Session->setFlash(__('Het artikel is verwijderd', true));
				$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Het artikel is niet verwijderd', true));
		$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'index'));
	}

	function admin_on_up($id, $order, $redirect_id) {
		if (($id) && ($order)) {
			$photos = array();
			$photos[0]['id'] = $id;
			$photos[0]['order_key'] = ($order - 1);
			$otherphoto = $this->Article->Photo->find('all', array('conditions' => array('Photo.article_id' => $redirect_id, 'Photo.order_key' => ($order - 1))));
			$photos[1]['id'] = $otherphoto[0]['Photo']['id'];
			$photos[1]['order_key'] = $otherphoto[0]['Photo']['order_key'] + 1;
			foreach ($photos as $photo) {
				$this->Article->Photo->save($photo);
			}
			$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'edit', $redirect_id));
		}
	}
	
	function admin_on_down($id, $order, $redirect_id) {
		if (($id) && ($order)) {
			$photos = array();
			$photos[0]['id'] = $id;
			$photos[0]['order_key'] = ($order + 1);
			$otherphoto = $this->Article->Photo->find('all', array('conditions' => array('Photo.article_id' => $redirect_id, 'Photo.order_key' => ($order + 1))));
			$photos[1]['id'] = $otherphoto[0]['Photo']['id'];
			$photos[1]['order_key'] = $otherphoto[0]['Photo']['order_key'] - 1;
			foreach ($photos as $photo) {
				$this->Article->Photo->save($photo);
			}
			$this->redirect(array('admin' => true, 'controller' => 'articles', 'action' => 'edit', $redirect_id));
		}
	}
	
}
?>
