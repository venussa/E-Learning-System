<?php

class list_courses extends load{
        
    function __construct(){
        
        header_content_type("json");
        
        echo json_encode(API_access("list_course?q=".$this->get("q")));
        
    }
    
}