<?php
App::uses('EventInterfaceModel', 'Model');

/**
 * Price Model
 *
 * @property Price $Price
 * @property PriceCategory $PriceCategory
 */
class Price extends EventInterfaceModel {

	/**
	 * Saves the Price to the database
	 *
	 * @deprecated deprecated use saveRow of AppModel instead.
	 * @param $params
	 * @return array|mixed
	 */
	public function savePrice($params) {
		return $this->saveRow($params);
	}

}
