<?php

class Master_User extends CI_Model
{
  var $table = 'tbl_user'; //nama tabel dari database
  var $column_order = array(null, 'user_nama', 'user_email', 'user_alamat'); //field yang ada di table user
  var $column_search = array('user_nama', 'user_email', 'user_alamat'); //field yang diizin untuk pencarian 
  var $order = array('user_id' => 'asc'); // default order 
}
