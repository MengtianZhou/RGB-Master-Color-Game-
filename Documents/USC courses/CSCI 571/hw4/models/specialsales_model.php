<?php
	class Specialsales_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function get_specialsales(){
			$sql='SELECT * FROM specialsales as s, products as p WHERE s.p_id=p.p_id';
			$query = $this->db->query($sql);
			return $query->result();
		}
		public function get_specialsales_by_category($pc_id){
			$sql='SELECT * FROM specialsales as s, products as p WHERE s.p_id=p.p_id and p.pc_id=?';
			$query = $this->db->query($sql,$pc_id);
			return $query->result();
		}
		public function select($p_id){
			$sql='SELECT * FROM specialsales WHERE p_id=?';
			$query=$this->db->query($sql,$p_id);
			if($query->num_rows()>0){
				return $query->result();
			}
			else{
				return 0;
			}
		}
	}
?>