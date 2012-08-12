<?php
Class data_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	
public function get_user($user_id) {
	$result	= $this->db->get_where('user', array('id'=>$user_id));
	return $result->row()->email;
}

public function get_userid($user_email) {
	$result	= $this->db->get_where('user', array('email'=>$user_email));
	return $result->row()->id;
}

public function create_user($user_email, $meta) {
	$result	= $this->db->insert('user', array('email' => $user_email, 'meta' => $meta));
}
public function get_user_meta($user_id) {
	$result	= $this->db->get_where('user', array('id'=>$user_id));
	return $result->row()->meta;
}
public function update_user_meta($user_email, $meta) {
	$this->db->where('email',$user_email);
	$this->db->update('user', array('meta' => $meta));
}

public function get_user_emeta($user_email) {
	$result	= $this->db->get_where('user', array('email'=>$user_email));
	if(isset($result->row()->meta))
		return $result->row()->meta;
	else
		return "";
}


public function get_user_page($user_id) {

$this->db->order_by("startdate", "asc"); 
	return $this->db->get_where('daypage', array('user_id'=>$user_id))->result_array();
	
}

public function update_user_page($user_id, $user_array) {
	$this->db->where('user_id',$user_id);
	$this->db->update('daypage', $user_array);
}

public function post_user_page($pagedata){
	$this->db->insert('daypage',$pagedata);
}
}