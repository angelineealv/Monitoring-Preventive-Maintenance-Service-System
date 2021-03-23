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

  var $searchData = array(
    'username',
    'name'
  );
  //field yang diizin untuk pencarian 
  var $order = array(
    'userid' => 'asc'
  ); // default order 


}
