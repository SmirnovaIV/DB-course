<?php
	class emarketTop {
		/**
		 * Добавить статистику по заказу
		 * @param $order
		 */
		public function addOrder($order) {
			$objects = umiObjectsCollection::getInstance();
			$orderItems = $order->order_items;
			foreach($orderItems as $item) {
				$item = $objects->getObject($item);

				$itemId = '';
				if (count($item->item_link) != 0) {
					$itemId = $item->item_link[0]->getId();
				} else {
					continue;
				}

				$date = explode(' ', $order->order_date);
				$date = strtotime($date[0]);
				$number = l_mysql_query("SELECT count(*) as 'count' FROM `cms3_emarket_top` WHERE `id` = " . $itemId . " AND `date` = " . $date, true);
				$row = mysql_fetch_assoc($number);

				if ($row['count'] > 0) {
					l_mysql_query("UPDATE `cms3_emarket_top` SET `title` = '" . $item->getName() . "', `amount` = `amount` + " . $item->item_amount . ", `total_price` = `total_price` + " . $item->item_total_price . " WHERE `id` = " . $itemId . " AND `date` = " . $date);
				} else {
					l_mysql_query("INSERT INTO `cms3_emarket_top` (`id`, `date`, `title`, `amount`, `total_price`) VALUES (" . $itemId . ", " . $date . ", '" . $item->getName() . "', " . (int) $item->item_amount . ", " . (double) $item->item_total_price . ")");
				}
			}
		}

		/**
		 * Удалить статистику по заказу
		 * @param $order
		 */
		public function delOrder($order) {
			$objects = umiObjectsCollection::getInstance();
			$orderItems = $order->order_items;
			foreach($orderItems as $item) {
				$item = $objects->getObject($item);

				$itemId = '';
				if (count($item->item_link) != 0) {
					$itemId = $item->item_link[0]->getId();
				} else {
					continue;
				}

				$date = explode(' ', $order->order_date);
				$date = strtotime($date[0]);
				$number = l_mysql_query("SELECT count(*) as 'count' FROM `cms3_emarket_top` WHERE `id` = " . $itemId . " AND `date` = " . $date, true);
				$row = mysql_fetch_assoc($number);

				if ($row['count'] > 0) {
					l_mysql_query("UPDATE `cms3_emarket_top` SET `title` = '" . $item->getName() . "', `amount` = `amount` - " . $item->item_amount . ", `total_price` = `total_price` - " . $item->item_total_price . " WHERE `id` = " . $itemId . " AND `date` = " . $date);
				}
			}
		}

		/**
		 * Получить ТОП популярных товаров
		 * @param $range диапазон дат
		 * @param $numberItems кол-во возвращаемых популярных товаров
		 * @param $sort поле сортировки
		 * @return array
		 */
		public function getTop($range, $numberItems, $sort) {
			if ($sort == 'price') {
				$sort = 'total_price';
			} else {
				$sort = 'amount';
			}
			$res = l_mysql_query("SELECT `id`, `title`, SUM(`amount`) AS 'amount', SUM(`total_price`) AS 'total_price' FROM `cms3_emarket_top` WHERE `amount` != 0 AND `total_price` !=0 AND `date` BETWEEN " . $range['fromDate'] . " AND " . $range['toDate'] . " GROUP BY `id` ORDER BY `" . $sort . "` DESC LIMIT 0," . $numberItems, true);
			$result = array();
			if($res) {
				while ($row = mysql_fetch_assoc($res)) {
					$result[] = $row;

				}
			}
			return $result;
		}

		public function recalculation($limit, $page) {
			$offset = $page * $limit;

			$sel = new selector('objects');
			$sel->types('object-type')->name('emarket', 'order');
			$sel->where('status_id')->equals(order::getStatusByCode('ready'));
			$sel->where('order_date')->less(strtotime(date('Y-m-d')));
			$sel->limit($offset, $limit);

			foreach($sel->result as $order) {
				$this->addOrder($order);
			}

			return array(
				'page' => $page+1,
				'current' => $offset+$limit
			);
		}

		public function clearTableTop() {
			l_mysql_query("DELETE FROM `cms3_emarket_top` WHERE `date` < ". strtotime(date('Y-m-d')));
			return;
		}

		public function allOrdersRecalculate() {
			$sel = new selector('objects');
			$sel->types('object-type')->name('emarket', 'order');
			$sel->where('status_id')->equals(order::getStatusByCode('ready'));
			$sel->where('order_date')->less(strtotime(date('Y-m-d')));
			return $sel->length;
		}
	}
?>