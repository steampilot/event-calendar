<?php

App::uses('AppModel', 'Model');

/**
 * Price Category Model
 *
 */
class PriceCategory extends AppModel {

	public function savePriceCategory($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}

}
