<?php
class Member_model extends CI_Model {
	
	//생성자
	function Member_model() {
		parent::__construct();
	}
	
	//data insert
	function member_insert() {
		$this->mem_id = $_POST["mem_id"];
		$this->mem_name = iconv('utf-8', 'euc-kr', $_POST['mem_name']);
		$this->mem_passwd = md5($_POST['mem_passwd']);
		$this->mem_photo = '';
		$this->mem_photo = '';
		$this->mem_reg_dt = date("Y-m-d H:i:s", time());
		$this->mem_last_login = date("Y-m-d H:i:s", time());
		
		return $this->db->insert('member', $this);
	}
	
	//data modify
	function member_update($data, $where) {
		if($this->db->update('member', $data, $where)) {
			return TRUE;
		}
		else return FALSE;
	}
	
	
	//data delete
	
	
	//data search
	function member_select($que) {
		$query = $this->db->query($que);
		$nums = $query->num_rows();
		
		if($nums <= 0) return 'none';
		else if($nums > 1) return 'dup';
		else {
			return $query->row();
		}
	}
}