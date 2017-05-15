<?php

namespace app\controller;

use app\model\LoggingModel;

class ViewController extends Controller
{

    public function index()
    {
        $logs_model = new LoggingModel();

        $list = $logs_model->getList();

        $data = [
            'list' => $list
        ];

        $this->view('index.php', $data);
    }

}