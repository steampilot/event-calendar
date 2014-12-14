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

	/**
	 * Saves the event to the database
	 *
	 * @param $params
	 * @return array|mixed
	 * @deprecated deprecated use saveRow of AppModel instead.
	 */
	public function saveEvent($params) {
		return $this->saveRow($params);
	}
}
