<?php
class Data_Service {

	public $service;
	public $post_id;

	public function __construct($data, $post_id="", $extra_data="") {

		$this->service = $data;

		if( _exists($post_id) ) {
			$this->post_id = $post_id;
		}

		if( $this->verify() ) {

			return true;

		}

		return false;

	}

	public function get_data() {

		if( is_file(_template_dir . '/silo/' . $this->service . '.json') ) {

			$raw_data = file_get_contents(_template_dir . '/silo/' . $this->service . '.json');

			if( !empty($raw_data) ) {

				return $this->parse_data(json_decode($raw_data));

			}

		}

		return false;

	}

	public function parse_data($raw_data) {

		if( _exists($raw_data->acf_fields) ) {

			$data = array();

			if( _exists($this->post_id) ) {
				$field_id = $this->post_id;
			} else {
				$field_id = $raw_data->post_id;
			}

			foreach($raw_data->acf_fields as $row) {

				$data_field = get_field($row, $field_id);

				if( !empty($data_field) ) {

					$data[$row] = $data_field;

				}

			}

			return $data;

		}

		return false;

	}

	public function verify() {

		if( file_exists(_template_dir . '/silo/' . $this->service . '.json') ) {
			return true;
		}

		return false;

	}

}
