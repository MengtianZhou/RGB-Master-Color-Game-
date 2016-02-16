<?php
	class Product_size_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function get_sizes(){
			$sql='SELECT * FROM product_size';
			$query = $this->db->query($sql);
			return $query->result();
		}
		public function get_size($ps_id){
			$sql='SELECT * FROM product_size WHERE ps_id=?';
			$query = $this->db->query($sql,$ps_id);
			foreach ($query->result_array() as $row){
				return $row['size'];
			}
		}
		public function get_price($ps_id){
			$sql='SELECT * FROM product_size WHERE ps_id=?';
			$query = $this->db->query($sql,$ps_id);
			foreach ($query->result_array() as $row){
				return $row['price'];
			}
		}
	}
?>