<?php


class ControllerExtensionDashboardCustomers extends Controller {


	public function dashboard() {


		$this->load->language('extension/dashboard/customers');


		$data['heading_title'] = $this->language->get('heading_title');


		$data['text_view'] = $this->language->get('text_view');


		$data['token'] = $this->session->data['token'];


		// Total Orders


		$this->load->model('property/agent');


		$today = $this->model_property_agent->getTotalAgent(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));


		$yesterday = $this->model_property_agent->getTotalAgent(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));


		$difference = $today - $yesterday;


		if ($difference && $today) {


			$data['percentage'] = round(($difference / $today) * 100);


		} else {


			$data['percentage'] = 0;


		}





		$order_total = $this->model_property_agent->getTotalAgent($data);


		if ($order_total > 1000000000000) {


			$data['total'] = round($order_total / 1000000000000, 1) . 'T';


		} elseif ($order_total > 1000000000) {


			$data['total'] = round($order_total / 1000000000, 1) . 'B';


		} elseif ($order_total > 1000000) {


			$data['total'] = round($order_total / 1000000, 1) . 'M';


		} elseif ($order_total > 1000) {


			$data['total'] = round($order_total / 1000, 1) . 'K';


		} else {


			$data['total'] = $order_total;


		}





		$data['order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], true);


		return $this->load->view('extension/dashboard/customers_info', $data);


	}


}


