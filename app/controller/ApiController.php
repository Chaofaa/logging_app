<?php

namespace app\controller;

use app\model\LoggingModel;

Class ApiController extends Controller {

    public function getList()
    {
        $log_model = new LoggingModel();

        $pagination = $this->pagination([
            'total' => $log_model->count(),
            'limit' => 5
        ]);

        $data = $log_model->getList(['limit' => [$pagination['from'], $pagination['limit']]]);

        $list = false;
        if(!empty($data))
        {
            $group = 0;
            foreach ($data as $item) {
                $created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $item['created_at']);

                $date = $created_at->format('d.m.Y');
                $item['readable_created_at'] = $created_at->format('d.m.Y H:i');

                if(isset($list[$group]['date']) && $list[$group]['date']==$date){
                    $list[$group]['items'][] = $item;
                }else {
                    $group++;
                    $list[$group] = [
                        'title' => ($date==date('d.m.Y'))?'Today':$date,
                        'date' => $date,
                        'items' => [$item]
                    ];
                }
            }
        }

        $data = [
            'items' => $list,
            'total_pages' => $pagination['total_pages'],
            'current_page' => $pagination['page'],
            'status' => 'ok'
        ];

        return $this->output_json($data);
    }

    public function save()
    {
        $post = $_POST;
        if(!isset($post['description']) || !isset($post['time'])) return $this->output_json(['status' => 'No data']);

        $data = [
            'description' => $post['description'],
            'time' => $post['time']
        ];

        $log_model = new LoggingModel();

        if($status = $log_model->save($data)){
            return $this->output_json(['status' => 'saved']);
        }else{
            return $this->output_json(['status' => 'error']);
        }

    }

}