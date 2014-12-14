<?php
App::uses('EventInterfaceModel', 'Model');

/**
 * Price Model
 *
 * @property Event $Event
 * @property PriceGroup $PriceGroup
 */
class Price extends EventInterfaceModel {


	public function savePrice($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}

}
