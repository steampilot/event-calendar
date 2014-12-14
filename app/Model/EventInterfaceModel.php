<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 14.12.2014
 * Time: 20:31
 */


App::uses('AppModel', 'Model');

class EventInterfaceModel extends AppModel{

	/**
	 * gets the liks by event id
	 * @param $numEventId
	 * @return array
	 * @throws Exception
	 */
	public function getByEventId($numEventId) {
		$return = array();
		$conditions = array(
			'deleted' => 0,
			'event_id' => $numEventId
		);
		$rows = $this->queryFind('all', array(
			'fields' => array('id'),
			'conditions' => $conditions,
			//'order' => array('title')
		));
		if (!empty($rows)) {
			foreach ($rows as $row) {
				$return[] = $this->getById($row['id']);
			}
		}
		return $return;
	}

}
