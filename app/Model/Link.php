<?php
App::uses('EventInterfaceModel', 'Model');

/**
 * Link Model
 *
 * @property Link $Link
 */
class Link extends EventInterfaceModel {

	/**
	 * Saves the Link to the database
	 *
	 * @deprecated deprecated use saveRow of AppModel instead.
	 * @param $params
	 * @return array|mixed
	 */
	public function saveLink($params) {
		return $this->saveRow($params);
	}

}
