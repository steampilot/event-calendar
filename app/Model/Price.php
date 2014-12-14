<?php
App::uses('AppModel', 'Model');

/**
 * Price Model
 *
 * @property Event $Event
 * @property PriceGroup $PriceGroup
 */
class Price extends AppModel {

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

	public function savePrice($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}

	public function deleteById($id) {
		$return = array(
			'status' => 0
		);
		if (!$this->exists($id)) {
			throw new Exception(__('Not found'));
		}
		$this->id = $id;
		$row = array(
			'deleted' => 1
		);
		$data = $this->save($row, false);
		$return['status'] = 1;
		$return['data'] = $data;
		return $return;
	}

	public function searchGenres($arrPararms) {
		$return = null;
		return $return;
	}

	public function validateGenreUpdate($row) {
		$return = null;
		return $return;
	}

	public function validateGenreInsert($row) {
		$return = null;
		return $return;
	}

}
