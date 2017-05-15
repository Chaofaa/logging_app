<?php

namespace app\controller;

Class Controller {

    function __construct()
    {
        $this->init_database();
    }

    public function init_database()
    {
        $conf = require_once(__DIR__.'/../config/database.php');
        $db = new \MysqliDb($conf);
    }

    public function pagination($param)
    {
        $param['total_pages'] = ($param['total']>=$param['limit'])?ceil($param['total'] / $param['limit']):1;

        $page = (isset($_POST['page']))?$_POST['page']:1;
        $param['page'] = ($page > $param['total_pages'])?1:$page;

        $param['from'] = ($param['total_pages'] >= $param['page'])?$param['limit']*($param['page']-1):0;

        return $param;
    }

    public function output_json($data)
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($data);
    }

    public function view($name, $variables = false)
    {
        $file = base_path."/views/".$name;

        if(! file_exists($file)) die('Unable to load view');

        if(is_array($variables)){
            extract($variables);
        }

        ob_start();
        include(base_path . "/views/" . $name);
        ob_end_flush();

    }

}