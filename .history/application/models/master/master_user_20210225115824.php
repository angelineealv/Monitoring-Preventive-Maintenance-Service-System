<?php

class Master_User extends CI_Model
{
  var $table = 'msuser'; //nama tabel dari database
  var $selectData = array(
    'userid',
    'username',
    'name',
    'isactive'
  );
  var $column_search = array('username', 'name'); //field yang diizin untuk pencarian 
  var $order = array('user_id' => 'asc'); // default order 


}
