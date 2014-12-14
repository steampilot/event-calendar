<?php

App::uses('AppModel', 'Model');

/**
 * Genre Model
 *
 * @property Event $Event
 */
class Genre extends AppModel {

	/**
	 * Saves the genre to the database
	 *
	 * @deprecated deprecated use saveRow of AppModel instead.
	 * @param $params
	 * @return array|mixed
	 */
	public function saveGenre($params) {
		return $this->saveRow($params);
	}

}
