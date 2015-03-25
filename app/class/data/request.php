<?php
namespace axion\data;

class Request {
    public $verb;
    public $elements;
    public $parameters;
    public $format;

    function __construct(){
        $this->verb = $_SERVER['REQUEST_METHOD'];

        if(isset($_SERVER['PATH_INFO']) && !is_null($_SERVER['PATH_INFO'])){
            $this->elements = explode('/', $_SERVER['PATH_INFO']);
        } else if(!empty($_SERVER['QUERY_STRING'])) {
            $this->elements = explode('/', $_SERVER['QUERY_STRING']);
        } else {
            $this->elements = explode('/', $_SERVER['REQUEST_URI']);
        }

        // initialize html as default format
        $this->format = 'html';
        $this->parseIncomingParams();
        
        if(isset($this->parameters['format'])) {
            $this->format = $this->parameters['format'];
        }

        return true;
    }

    public function parseIncomingParams() {
        $parameters = array();
        // WH Grab any GET data
        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }
        // WH Get data from PUT/POST requests (overrides GET)
        $body = file_get_contents("php://input");
        $content_type = false;
        if(isset($_SERVER['CONTENT_TYPE'])) {
            $content_type = $_SERVER['CONTENT_TYPE'];
        }
        switch($content_type) {
            // WH FFx sends charset=UTF-8, which was breaking everything
            case "application/json":
            case "application/json; charset=UTF-8":
                $body_params = json_decode($body);
                if($body_params) {
                    foreach($body_params as $param_name => $param_value) {
                        $parameters[$param_name] = $param_value;
                    }
                }
                $this->format = "json";
                break;
            case "application/x-www-form-urlencoded":
                parse_str($body, $postvars);
                foreach($postvars as $field => $value) {
                    $parameters[$field] = $value;
                }
                $this->format = "html";
                break;
            default:
                // we could parse other supported formats here
                break;
        }
        $this->parameters = $parameters;
    }
}