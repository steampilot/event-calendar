<?php
App::uses('AppModel', 'Model');

/**
 * Event Model
 *
 * @property Genre $Genre
 * @property Link $Link
 * @property Price $Price
 * @property Show $Show
 */
class Event extends AppModel {


	public function saveEvent($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}
}
