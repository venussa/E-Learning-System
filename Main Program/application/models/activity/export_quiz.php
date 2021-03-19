<?php 

class export_quiz extends load{
        
        function __construct(){
            
            if(userData()["user_type"] == "student") exit;
            
            if(!empty($this->get("cluster"))){
            
                header_content_type("json");
                    
                $query = API_access("data_select?name=data_question",true,[
                    "id" => clean_xss_string($this->get("cluster"))
                ]);
                
                $title = clean_xss_string(str_replace(" ","-",$query[0]["title"]));
                
                foreach($query as $key => $val){
                    
                    if(is_numeric($key)){
                        
                        $build = $val;
                        
                    }
                    
                }
                
                unset($build["id"]);
                unset($build["topic_id"]);
                unset($build["cluster"]);
                $data["general"] = $build;
                $build = null;
                
                $query = API_access("data_select?name=data_question_list",true,[
                    "cluster_id" => $query[0]["cluster"]
                ]);
                
                foreach($query as $key => $val){
                    
                    if(is_numeric($key)){
                        
                        unset($val["id"]);
                        unset($val["cluster_id"]);
                        $build[] = $val;
                        
                    }
                    
                }
                
                $data["question"] = $build;
                
                header('Content-disposition: attachment; filename='.$title.'.json');
                header('Content-type: application/json');
                
                echo json_encode($data);
            
                
            }else{
                
                if(!empty($_FILES["file"]["name"])){
                    
                    $file = $_FILES["file"];
                    
                    $extention = get_extention($file["name"]);
                    
                    if($extention !== "json"){
                        echo "Import failed";
                        exit;
                    }
                    
                    $path = SERVER."/sources/repository/".userData()["nidn"]."/".$file["name"];
                    
                    if(move_uploaded_file($file["tmp_name"], $path)){
                        
                        $data = implode(file($path));
                        
                        $json = json_decode($data,true);
                        
                        $general = $json["general"];
                        $general["topic_id"] = $this->post("topic_id");
                        $general["cluster"] = userData()["nidn"]."-".time();
                        
                        API_access("data_insert?name=data_question", true, $general);
                        
                        foreach($json["question"] as $key => $val){
                            
                            $val["cluster_id"] = $general["cluster"];
                            
                            API_access("data_insert?name=data_question_list",true,$val);
                            
                            
                        }
                        
                        unlink($path);
                        
                    }else{
                        
                        echo "Import failed";
                        exit;
                        
                    }
                    
                    
                }
                
            }
            
        }
    
}