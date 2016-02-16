<?php
	class Products_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function get_products_by_category($pc_id){
			$sql='SELECT * FROM products WHERE pc_id=?';
			$query = $this->db->query($sql,$pc_id);
			return $query->result();
		}

		public function get_product_by_id($p_id){
			$sql='SELECT * FROM products WHERE p_id=?';
			$query = $this->db->query($sql,$p_id);
			return $query->result();
		}
		public function get_image($p_id){
			$sql='SELECT * FROM products WHERE p_id=?';
			$query = $this->db->query($sql,$p_id);
			foreach ($query->result_array() as $row){
				return $row['image'];
			}
		}
		public function get_name($p_id){
			$sql='SELECT * FROM products WHERE p_id=?';
			$query = $this->db->query($sql,$p_id);
			foreach ($query->result_array() as $row){
				return $row['name'];
			}
		}
	}
?>