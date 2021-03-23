<?php

namespace vendor\plugins;

class JResponse {

    private static $instance;
    private $jResponse;

    public static function json($result, $type, $message, array $data = array(), $code = null) {

        if (!self::$instance) {
            self::$instance = new jResponse($data);
        }
        
        self::$instance->set_result($result);
        self::$instance->set_type($type);
        self::$instance->set_message($message);
        self::$instance->set_code($code);
        
        return self::$instance;
    }

    public static function data($data) {
        if (!self::$instance) {
            self::$instance = new jResponse();
        }

        foreach ($data as $key => $value) {
            self::$instance->jResponse->$key = $value;
        }

        return self::$instance;
    }

    public function __construct($data = array()) {

        $jResponse = new \stdClass();
        $jResponse->data = $data;

        $this->jResponse = $jResponse;
    }
    
    public function set_result($result) {
        $this->jResponse->result = $result;
    }
    
    public function set_type($type) {
        $this->jResponse->type = $type;
    }
    
    public function set_message($message) {
        $this->jResponse->message = $message;
    }
    
    public function set_code($code) {
        $this->jResponse->code = $code;
    }

    public function append($key, $value = null) {
        if(is_array($key)) {
            foreach ($key as $jKey => $jVal) {
                $this->jResponse->$jKey = $jVal;
            }
        } else {
            $this->jResponse->$key = $value;
        }

        return $this;
    }

    public function appendData($key, $value) {

        if (is_array($key)) {
            foreach ($key as $jKey => $jValue) {
                $this->jResponse->data[$jKey] = $jValue;
            }
        } else {
            $this->jResponse->data[$key] = $value;
        }
    }

    public function send() {
        $CI =& get_instance();
        
        return $CI->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->jResponse, JSON_UNESCAPED_UNICODE));
    }

}
