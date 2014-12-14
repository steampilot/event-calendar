<?php
App::uses('EventInterfaceModel', 'Model');


/**
 * Show Model
 *
 * @property Event $Event
 */
class Show extends EventInterfaceModel {

	/**
	 * Saves the Show of a given Event to the database
	 *
	 * @deprecated deprecated use saveRow of AppModel instead.
	 * @param $params
	 * @return array|mixed
	 */
	public function saveShow($params) {
		return $this->saveRow($params);
	}

}
