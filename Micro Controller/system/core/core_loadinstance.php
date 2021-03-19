<?php

use system\core\method;
use system\core\database;
use system\core\database_insert;
use system\core\database_update;
use system\core\database_select;
use system\core\database_delete;

/**
 * load Class
 *
 * Read views and models
 *
 * @package		system
 * @subpackage	core
 * @category	controller
 */

 class load extends system\core\database {

 	// --------------------------------------------------------------------

    /**
     * call views file
     *
     * @return array
     * @return mixed
     */

 	protected function view($paths = null, $data = null,$print = true){

        if(!is_array($paths)) $newpath[] = $paths;
        else $newpath = $paths;

        $HTML = null;

        foreach($newpath as $fileindex => $filepath){

            $build = null;
            $valuez = null;

     		$path = SERVER."/application/views/".$filepath.".php";

     		if(!empty($path) and file_exists($path)){

                ob_start();

     			require($path);

                $ob = ob_get_clean();

                $result = $ob;

                if(!empty($data) and is_array($data)){

                    foreach($data as $key => $val){

                        if(!is_array($val)){
                        
                            $build[] = "{".$key."}";
                            $valuez[] = $val;

                        }

                    }

                }

                if(is_array($this->get())){
                    
                    foreach($this->get() as $key => $val){

                        if(!is_array($val)){
                        
                            $build[] = "{[".$key."]}";
                            $valuez[] = clean_xss_string($val);

                            $build[] = "{urldecode[".$key."]}";
                            $valuez[] = clean_xss_string(urldecode($val));

                            $build[] = "{urlencode[".$key."]}";
                            $valuez[] = clean_xss_string(urlencode($val));

                        }

                    }

                }

                if(is_array($this->post())){
                    
                    foreach($this->post() as $key => $val){

                        if(!is_array($val)){
                        
                            $build[] = "([".$key."])";
                            $valuez[] = $val;

                             $build[] = "(urldecode[".$key."])";
                            $valuez[] = urldecode($val);

                            $build[] = "(urlencode[".$key."])";
                            $valuez[] = urlencode($val);

                        }

                    }

                }

                $replace = [

                    "{homeURL}" => HomeUrl(),
                    "{documentURL}" => documentUrl(),
                    "{sourceURL}" => sourceUrl()

                ];

                $result = str_replace($build,$valuez,$ob);
                $result = str_replace(array_keys($replace), $replace, $result);
                $result = preg_replace("/(\{urldecode\[\w+\]\})/", null, $result);
                $result = preg_replace("/(\{urlencode\[\w+\]\})/", null, $result);
                $result = preg_replace("/(\(urldecode\[\w+\]\))/", null, $result);
                $result = preg_replace("/(\(urlencode\[\w+\]\))/", null, $result);
                $result = preg_replace("/(\{\[\w+\]\})/", null, $result);
                $result = preg_replace("/(\(\[\w+\]\))/", null, $result);
                //$result = preg_replace("/(\{\w+\})/", null, $result);


                $HTML .= $result;

     		}else{

                $HTML .= null;

            }

        }

        if($print == false) return $HTML;

        echo $HTML;
 	}

    // --------------------------------------------------------------------

    /**
     * call model files
     *
     * @return array
     * @return mixed
     */

    protected function model($path = null){
    
        $path = SERVER."/application/models/".$path.".php";

        if(!empty($path) and file_exists($path)){

            require_once($path);

        }else{

            return false;

        }

    }


    // --------------------------------------------------------------------

    /**
     * method and query reader
     *
     * @return array
     * @return mixed
     */

    function generate_data(){

        return new method();

    }

    function db_query($command = null, $db_name = null){

        if(empty($db_name))

        $db = new database();
        return $db->query($command, $db_name);
        
    }

    function db_insert($database_name = null, $option = array()){

        return (new database_insert($database_name, $option))->catch_error();

    }

    function db_select($database_name = null, $option = array()){

        return (new database_select($database_name, $option))->catch_error();

    }

    function db_delete($database_name = null, $option = array()){

        return (new database_delete($database_name, $option))->catch_error();

    }

    function db_update($database_name = null, $option = array()){

        return (new database_update($database_name, $option))->catch_error();

    }




    // --------------------------------------------------------------------

    /**
     * Filter get method
     *
     * @return array
     * @return mixed
     */

    protected function get($index = null,$remove = null){

        $get = $this->generate_data()->get($index);

        if(!empty($get)){
            
            if(!empty($remove) and is_array($remove)){

                $get = str_replace($remove,null,$get);

                if(in_array("'",$remove) or in_array('"',$remove)){

                    $get = str_replace(["'","\"","%27","%22"],null,$get);

                }

            }

         return ($get);

        }else{

            return false;

        }

    }

    // --------------------------------------------------------------------

    /**
     * Filter post method
     *
     * @return array
     * @return mixed
     */

    protected function post($index = null,$remove = null){

        $get = $this->generate_data()->post($index);

        if(!empty($get)){
            
            if(!empty($remove) and is_array($remove)){

                $get = str_replace($remove,null,$get);

                if(in_array("'",$remove) or in_array('"',$remove)){

                    $get = str_replace(["'","\"","%27","%22"],null,$get);

                }

            }

         return ($get);

        }else{

            return false;

        }

    }

 }