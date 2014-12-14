<?php

App::uses('AppModel', 'Model');

/**
 * Genre Model
 *
 * @property Event $Event
 */
class Genre extends AppModel {

	public function saveGenre($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}

}
