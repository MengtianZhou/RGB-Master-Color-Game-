<?php
	class Product_category_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function get_categories(){
			$sql='SELECT * FROM product_category';
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>