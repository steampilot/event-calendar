<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Model', 'Model');
App::uses('User', 'Model');
App::uses('CakeTime', 'Utility');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public $useDbConfig = G_DB_CONFIG;
	public $cacheQueries = false;
	protected $arrCache = null;
	protected $arrCacheCodelist = null;
	public $User = null;

	/**
	 * Constructor. Binds the model's database table to the object.
	 *
	 * @param bool|int|string|array $id Set this ID for this model on startup,
	 * can also be an array of options, see above.
	 * @param string $table Name of database table to use.
	 * @param string $ds DataSource connection name.
	 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->User = $this->model('User');
	}

	/**
	 * Will be used for table price_groups and genres
	 * TODOO
	 * @param null $id
	 * @return bool
	 */
	public function exists($id = null) {
		if ($id === null) {
			$id = $this->getID();
		}
		if ($this->Behaviors->attached('AppSoftDelete')) {
			return $this->existsAndNotDeleted($id);
		} else {
			return parent::exists($id);
		}
	}

	public function delete($id = null, $cascade = true) {
		if ($id === null) {
			$id = $this->getID();
		}
		$result = parent::delete($id, $cascade);
		if ($result === false && $this->Behaviors->enabled('AppSoftDelete')) {
			$boolReturn = (bool)$this->field('deleted', array('deleted' => 1));
			return $boolReturn;
		}
		return $result;
	}

	/**
	 * afterFind behavior: afterFind
	 *
	 * @param array $results results
	 * @param bool $primary primary
	 * @return array
	 */
	public function afterFind($results, $primary = false) {
		if (empty($results)) {
			return $results;
		}

		foreach ($results as $i => $arrRowset) {
			foreach ($arrRowset as $k => $arrRow) {

				if (isset($arrRow['created'])) {
					$arrRow['created_date'] = $this->formatDate($arrRow['created']);
					$arrRow['created_time'] = $this->formatDate($arrRow['created'], 'H:i:s');
					$arrRow['created_datetime'] = $this->formatDate($arrRow['created'], 'd.m.Y H:i:s');
				}
				if (isset($arrRow['modified'])) {
					$arrRow['modified_date'] = $this->formatDate($arrRow['modified']);
					$arrRow['modified_time'] = $this->formatDate($arrRow['modified'], 'H:i:s');
					$arrRow['modified_datetime'] = $this->formatDate($arrRow['modified'], 'd.m.Y H:i:s');
				}
				if (isset($arrRow['deleted'])) {
					$arrRow['deleted_date'] = $this->formatDate($arrRow['deleted']);
					$arrRow['deleted_time'] = $this->formatDate($arrRow['deleted'], 'H:i:s');
					$arrRow['deleted_datetime'] = $this->formatDate($arrRow['deleted'], 'd.m.Y H:i:s');
				}

				$results[$i][$k] = $arrRow;
			}
		}
		return $results;
	}

	/**
	 * Behavior. Save the ID of the currently logged in user
	 * to almost every INSERT/UPDATE action.
	 *
	 * @param array $options options
	 * @return boolean
	 */
	public function beforeSave($options = array()) {
		parent::beforeSave($options);

		App::uses('CakeSession', 'Model/Datasource');
		$numUserId = CakeSession::read('Auth.User.id');

		// deleted
		if (!empty($this->data[$this->alias]['deleted'])) {
			$this->data[$this->alias]['deleted_by'] = $numUserId;
			unset($this->data[$this->alias]['modified']);
		} else {
			if (isset($this->_schema['created_by'])) {
				if (empty($this->id)) {
					// insert
					$this->data[$this->alias]['created_by'] = $numUserId;
				} else {
					// update
					$this->data[$this->alias]['modified_by'] = $numUserId;
				}
			}
		}
		return true;
	}

	/**
	 * Log the message to logfile
	 *
	 * @param string $strMsg message
	 * @param string $strType type default is 'log'
	 * @return void
	 */
	public function logFile($strMsg, $strType = 'log') {
		$strLogfile = LOGS . date('Y-m-d') . '_' . $strType . '.txt';
		$strMsg = date('Y-m-d H:i:s') . ' ' . $strMsg . "\n";
		file_put_contents($strLogfile, $strMsg, FILE_APPEND);
	}

	/**
	 * Queries the datasource and returns a result set array.
	 *
	 * @param string $type type
	 * @param array $query query
	 * @return array resultset
	 */
	public function queryFind($type = 'first', $query = array()) {
		$result = parent::find($type, $query);
		$return = $this->toArray($result);
		return $return;
	}

	/**
	 * Queries the datasource and returns the first row
	 *
	 * @param string $type type
	 * @param array $query query
	 * @return array resultset
	 */
	public function queryFindRow($type = 'first', $query = array()) {
		$arrReturn = null;
		$result = parent::find($type, $query);
		if (!empty($result)) {
			$arrReturn = $this->toArray($result)[0];
		}
		return $arrReturn;
	}

	/**
	 * Returns a resultset for a given SQL statement.
	 *
	 * @param string $sql sql query
	 * @return array resultset
	 */
	public function queryAll($sql) {
		$result = parent::query($sql);
		$return = $this->toArray($result);
		return $return;
	}

	/**
	 * Convert model result to normalised array
	 *
	 * @param array &$results results
	 * @return array normalised array
	 */
	public function toArray(&$results) {
		if (empty($results)) {
			return array();
		}
		$arrReturn = array();
		foreach ($results as $arrRow) {
			$arrRowNew = array();
			foreach ($arrRow as $arrRowContent) {
				$arrRowNew = array_merge($arrRowNew, $arrRowContent);
			}
			$arrReturn[] = $arrRowNew;
		}
		return $arrReturn;
	}

	/**
	 * Returns codelist for type tables
	 *
	 * @return array
	 */
	public function getCodelist() {
		$arrReturn = array();

		$strTitleColname = 'title';
		$arrRows = $this->queryFind('all', array(
			'fields' => array('id', $strTitleColname),
			'conditions' => array('deleted' => '0'),
			//'order' => array('sortkey')
		));

		if (!empty($arrRows)) {
			foreach ($arrRows as $arrRow) {
				$strTitle = $arrRow[$strTitleColname];
				$arrReturn[$arrRow['id']] = $strTitle;
			}
		}

		return $arrReturn;
	}

	/**
	 *
	 * @param $strField
	 * @param $strId
	 * @param null $mixDefault
	 * @return null
	 */
	public function getFieldById($strField, $strId, $mixDefault = null) {
		$strReturn = $mixDefault;
		$arrRow = $this->queryFindRow('all', array(
			'fields' => array('id', $strField),
			'conditions' => array('id' => $strId)
		));

		if (isset($arrRow[$strField])) {
			$strReturn = $arrRow[$strField];
		}
		return $strReturn;
	}

	/**
	 * Insert rows
	 *
	 * @param string $strModel model name
	 * @param array $arrRows rows
	 * @return void
	 */
	public function insertRows($strModel, $arrRows) {
		if (empty($arrRows)) {
			return;
		}
		foreach ($arrRows as $arrRow) {
			$this->insertRow($strModel, $arrRow);
		}
	}

	/**
	 * Insert row
	 *
	 * @param string $strModel model name
	 * @param array $arrRow row
	 * @return array last insert row
	 */
	public function insertRow($strModel, $arrRow) {
		$model = $this->model($strModel);
		$model->create();
		$arrData = array($model->alias => $arrRow);
		$model->id = false;
		$arrResult = $model->save($arrData, false);
		return $arrResult;
	}

	/**
	 * Determine if date string is a valid date in that format
	 *
	 * @param string $strTime datetime
	 * @param string $strFormat format (d.m.Y)
	 * @return boolean
	 */
	public function validateTime($strTime, $strFormat = 'd.m.Y') {
		$d = DateTime::createFromFormat($strFormat, $strTime);
		$boolReturn = $d && $d->format($strFormat) == $strTime;
		return $boolReturn;
	}

	/**
	 * Returns true if date is valid (d.m.Y)
	 *
	 * @param string $strDate date
	 * @return boolean
	 */
	public function isDate($strDate) {
		if (!$this->validateTime($strDate, 'd.m.Y')) {
			return false;
		}
		if (!preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/', $strDate)) {
			return false;
		}
		return true;
	}

	/**
	 * Returns object by model classname
	 *
	 * @param string $strModel model name
	 * @return AppModel
	 */
	public function model($strModel) {
		return ClassRegistry::init($strModel);
	}

	/**
	 * Returns formated date/time
	 *
	 * @param string $strDate date
	 * @param string $strFormat format
	 * @param string $default default value = ''
	 * @return string
	 */
	public function formatDate($strDate, $strFormat = 'd.m.Y', $default = '') {
		//return CakeTime::format($strDate, $strFormat, $default);
		return format_time($strDate, $strFormat, $default);
	}

	/**
	 * Return ISO date-time string
	 *
	 * @param string $strDate date
	 * @return string
	 */
	public function formatDateTime($strDate) {
		return format_time($strDate, 'Y-m-d H:i:s');
	}

	/**
	 * Returns a number formated as currency
	 *
	 * @param string $strNumber number
	 * @return string
	 */
	public function formatCurrency($strNumber) {
		$strReturn = number_format($strNumber, 2, ".", "'");
		return $strReturn;
	}

	/**
	 * Check if value exists
	 *
	 * @param string $strValue
	 * @param string $strColname default is primaryKey (id)
	 * @return bool
	 */
	public function existValue($strValue, $strColname = null) {

		if ($strColname === null) {
			$strColname = $this->primaryKey;
		}

		$boolReturn = (bool)$this->find('count', array(
			'conditions' => array(
				$this->alias . '.' . $strColname => $strValue
			),
			'recursive' => -1,
			'callbacks' => false
		));
		return $boolReturn;
	}


}
