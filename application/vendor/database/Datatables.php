<?php

namespace vendor\database;

use Exception;
use vendor\plugins\JResponse;

class Datatables extends \CI_Model
{

  private $params = [];

  private $datas = [];
  private $count_datas = 0;
  private $count_datas_filtered = 0;

  public function __construct($class, $method = "datatables", $searchable = "searchable")
  {
    parent::__construct();
    $this->class = $class;
    $this->method = $method;
    $this->searchable = $searchable;

    $this->init();
  }

  private function query()
  {
    $class = new $this->class();
    $this->result = call_user_func_array(array($class, $this->method), $this->params);
    $this->thisClass = $class;
    return $this->result;
  }

  private function init()
  {
    $req = $this->input->method();
    $this->req = $req;
    $this->draw = $this->input->$req('draw');
    $this->length = $this->input->$req('length');
    $this->start = $this->input->$req('start');
    $this->number = $this->start + 1;
  }

  private function _search()
  {
    $method = $this->req;
    $search = $this->input->$method('search')['value'];
    $searchable = $this->searchable;

    $class = $this->thisClass;

    if (!empty($search)) {
      $index = 0;
      $this->search = strtolower(trim($search));

      $this->result->group_start();
      foreach ($class->$searchable as $column) {
        if (!empty($column)) {

          $exp = explode(",", $column);
          if (count($exp) > 1) {
            foreach ($exp as $field) {
              $SearchField = $this->getColumnsSearch($field);
              ($index == 0) ? $this->result->like($SearchField, $this->search) : $this->result->or_like($SearchField, $this->search);
              $index++;
            }
          } else {
            $SearchField = $this->getColumnsSearch($column);
            ($index == 0) ? $this->result->like($SearchField, $this->search) : $this->result->or_like($SearchField, $this->search);
            $index++;
          }
        }
      }
      $this->result->group_end();
    }

    $order = $this->input->$method('order');
    if (!empty($order)) {

      if (isset($class->$searchable[$order['0']['column']])) {

        $OrderField = $class->$searchable[$order['0']['column']];
        $OrderType = $order['0']['dir'];

        $this->orderField = $OrderField;
        $this->orderType = $OrderType;

        if (!empty($OrderField)) {
          $exp = explode(",", $OrderField);
          if (count($exp) > 1) {
            foreach ($exp as $value) {
              $this->result->order_by(trim($value), $OrderType);
            }
          } else {
            $this->result->order_by(trim($OrderField), $OrderType);
          }
        }
      }
    }
  }

  private function getColumnsSearch($data)
  {
    if ($this->result->dbdriver == "mysqli") {
      return "TRIM(LOWER($data))";
    } else if ($this->result->dbdriver == "postgre") {
      return "TRIM(LOWER(CAST($data AS text)))";
    } else {
      throw new Exception("This database driver not supported in this function");
      exit;
    }
  }

  public function setParams($params)
  {
    $this->params = $params;
  }

  public function execute()
  {
    $this->setCountData();
    $this->setCountFiltered();
    $this->setData();
  }

  public function setCountData()
  {
    $db = $this->query();
    $this->count_datas = $db->count_all_results();
  }

  public function setCountFiltered()
  {
    $db = $this->query();
    $this->_search();
    $this->count_datas_filtered = $db->count_all_results();
  }

  public function getNumber()
  {
    return $this->number++;
  }

  public function setData()
  {
    $db = $this->query();
    $this->_search();

    if ($this->length != -1) {
      $this->db->limit($this->length, $this->start);
    }

    $result = $db->get();

    $this->datas = $result->result();
  }

  public function getData()
  {
    return $this->datas;
  }

  public function getCountData()
  {
    return $this->count_datas;
  }

  public function getCountFiltered()
  {
    return $this->count_datas_filtered;
  }

  public function responseToJSON($data)
  {

    $response = new JResponse();
    return $response->append(array(
      "result" => "OK",
      "draw" => $this->draw,
      "recordsTotal" => $this->getCountData(),
      "recordsFiltered" => $this->getCountFiltered(),
      "data" => $data
    ))->send();
  }
}
