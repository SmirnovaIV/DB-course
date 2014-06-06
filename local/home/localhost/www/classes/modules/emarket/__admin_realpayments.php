<?php

	abstract class __emarket_admin_realpayments extends baseModuleAdmin {

		public function realpayments() {
			$fields_filter = getRequest('fields_filter');
			$fromDate = '';
			$toDate = '';
			if (!empty($fields_filter) && array_key_exists('order_date', $fields_filter)) {
				$string = $fields_filter['order_date']['gt'];
				$pattern = '/\./';
				$varDаte = preg_split($pattern, $string);
				$fromDate = mktime(0, 0, 0, $varDаte[1], $varDаte[0], $varDаte[2]);

				$string = $fields_filter['order_date']['lt'];
				$pattern = '/\./';
				$varDаte = preg_split($pattern, $string);
				$toDate = mktime(0, 0, 0, $varDаte[1], $varDаte[0], $varDаte[2]);
			}
			$range = $this->getDateRange($fromDate, $toDate);

			if($this->ifNotXmlMode()) {
				$data = array(
					'@fromDate' => $range['fromDate'],
					'@toDate' => $range['toDate'],
				);
				$this->setData($data);
				return $this->doData();
			}

			$limit = getRequest('per_page_limit');
			$curr_page = (int) getRequest('p');
			$offset = $limit * $curr_page;

			$sel = new selector('objects');
			$sel->types('object-type')->guid('emarket-orderstatus');
			$sel->where('codename')->equals('ready');
			$ready = $sel->first;

			$sel = new selector('objects');
			$sel->types('object-type')->name('emarket', 'order');
			$sel->where('status_id')->equals($ready);
			$sel->where('order_date')->between($range['fromDate'], $range['toDate']);
			$sel->where('name')->notequals('dummy');
			$sel->limit($offset, $limit);
			if(!getRequest('order_filter')) {
				$sel->order('order_date')->desc();
			}
			selectorHelper::detectFilters($sel);

			$domains = getRequest('domain_id');
			if(is_array($domains) && sizeof($domains)) {
				$domainsCollection = domainsCollection::getInstance();
				if(sizeof($domainsCollection->getList()) > 1) {
					$sel->where('domain_id')->equals($domains[0]);
				}
			}

			$this->setDataRange($limit, $offset);
			$data = $this->prepareData($sel->result, "objects");
			$data = array_merge($data, array(
				'@fromDate' => $range['fromDate'],
				'@toDate' => $range['toDate'],
			));
			$this->setData($data, $sel->length);

			return $this->doData();
		}

		public function setDateRange() {
			$range = $this->getDateRange(getRequest('param0'), getRequest('param1'));
			$data = array(
				'@fromDate' => $range['fromDate'],
				'@toDate' => $range['toDate'],
			);
			$this->setData($data);
			return $this->doData();
		}

		/**
		 * @param $fromDate временная метка timestamp
		 * @param $toDate временная метка timestamp
		 * @return array
		 */
		public function getDateRange($fromDate, $toDate) {
			$fromDate = (int)$fromDate;
			$toDate = (int)$toDate;
			if (empty($fromDate)) {
				if (empty($_SESSION['orderFromDate'])) {
					$_SESSION['orderFromDate'] = mktime(0,0,0,date('m'),date('d'),date('y'));
				}
			} else {
				$_SESSION['orderFromDate'] = $fromDate;
			}
			if (empty($toDate)) {
				if (empty($_SESSION['orderToDate'])) {
					$_SESSION['orderToDate'] = strtotime("+1 day", mktime(0,0,0,date('m'),date('d'),date('y')));
				}
			} else {
				$_SESSION['orderToDate'] = $toDate;
			}
			return array(
				'fromDate' => getSession('orderFromDate'),
				'toDate' => getSession('orderToDate'),
			);
		}
	};
?>