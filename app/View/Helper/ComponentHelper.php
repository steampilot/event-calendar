<?php

App::uses('AppHelper', 'View/Helper');

/**
 * Data bound web controls
 */
class ComponentHelper extends AppHelper {

	var $helpers = array('Form');

	/**
	 * Generate select (dropdown) with data from model method
	 *
	 * @param array $arrParams
	 * @return string
	 */
	public function select($arrParams) {
		$strReturn = '';
		$attributes = array('class' => 'form-control');

		$fieldName = $arrParams['name'];

		if (!empty($arrParams['attr'])) {
			$attributes = $attributes + $arrParams['attr'];
		}

		$options = array();
		if (!empty($arrParams['data'])) {
			$options = $arrParams['data'];
		}

		if (!empty($arrParams['datasource'])) {
			if (isset($arrParams['params'])) {
				$options = $this->data($arrParams['datasource'], $arrParams['params']);
			} else {
				$options = $this->data($arrParams['datasource']);
			}
		}

		$strReturn = $this->Form->select($fieldName, $options, $attributes);
		return $strReturn;
	}

	public function title($strMethod, $strKey) {
		$strReturn = null;
		$arrRows = $this->data($strMethod);
		if (isset($arrRows[$strKey])) {
			$strReturn = $arrRows[$strKey];
		}
		return $strReturn;
	}

	/**
	 * Call a model method and return data
	 *
	 * @param string $strMethod
	 * @param array $arrParams
	 * @return mixed
	 */
	public function data($strMethod, $arrParams = null) {
		list($strModel, $strMethod) = explode('.', $strMethod);
		$model = ClassRegistry::init($strModel);
		if ($arrParams === null) {
			$data = $model->{$strMethod}();
		} else {
			$data = $model->{$strMethod}($arrParams);
		}
		return $data;
	}

}
