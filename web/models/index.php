<?php
class Index_model extends Database {
	public function test() {
		return $this -> db -> fetchAllRows('test_table');
	}
}