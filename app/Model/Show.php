<?php
App::uses('AppModel', 'Model');

/**
 * Show Model
 *
 * @property Event $Event
 */
class Show extends AppModel {

	/**
	 * gets the prices by event id
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

	/**
	 * gets the price by id
	 *
	 * @param $id
	 * @return array
	 * @throws Exception
	 */
	public function getById($id) {
		if (!$this->existValue($id)) {
			throw new Exception(__('Not found'));
		}
		$conditions = array('AND' => array(
			array('id' => $id),
		));
		$row = $this->queryFindRow('all', array(
			'conditions' => $conditions,
		));
		if (empty($row)) {
			return array();
		}
		// Convert date format or boolean to yes and no if necessary
		return $row;
	}

}
