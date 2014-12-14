<?php
App::uses('AppModel', 'Model');
App::uses('EventInterfaceModel', 'Model');

/**
 * Link Model
 *
 * @property Event $Event
 */
class Link extends EventInterfaceModel {

	public function saveLink($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}

}
