<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Replicate extends RowAction
{
    public $name = '举报';

    public function handle(Model $model,\Illuminate\Http\Request $request)
    {
        // $model ...

//        var_dump($model->getKey());exit;
        // 获取到表单中的`type`值
        $request->get('type');

        // 获取表单中的`reason`值
        $request->get('reason');

        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $type = [
            1 => '广告',
            2 => '违法',
            3 => '钓鱼',
        ];

        $this->checkbox('type', '类型')->options($type);
        $this->textarea('reason', '原因')->rules('required');
    }

}