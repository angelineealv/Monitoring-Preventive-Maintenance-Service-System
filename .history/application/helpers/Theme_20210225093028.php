<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Theme
{
  protected $_ci;

  function __construct()
  {
    $this->_ci = &get_instance();
  }

  function panel($view, $data = NULL)
  {
    if ($this->_ci->session->userdata("login") == true) {
      $data["_content"] = $this->_ci->load->view($view, $data, true);
      $this->_ci->load->view("template/_detail.php", $data);
    } else {
      redirect("login", "refresh");
    }
  }
}
