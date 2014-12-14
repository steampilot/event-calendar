<?php

App::uses('AppModel', 'Model');

/**
 * Price Category Model
 *
 */
class PriceCategory extends AppModel {

	/**
	 * Saves the PriceCategory to the database
	 *
	 * @deprecated deprecated use saveRow of AppModel instead.
	 * @param $params
	 * @return array|mixed
	 */
	public function savePriceCategory($params) {
		return $this->saveRow($params);
	}

}
