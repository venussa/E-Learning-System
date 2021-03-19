<?php

class select_place extends load{
        
    function __construct(){
        
        header_content_type("json");
        
        $data = http_build_query($_POST);
        
        echo json_encode(API_access("select_place?".$data));
        
    }
    
}