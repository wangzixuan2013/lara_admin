<?php
/**
 * Created by Gavin.wang.
 * File: PostsExporter.php
 * Date: 2019/12/19
 * Time: 18:03
 */

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;

class PostsExporter extends ExcelExporter
{
    protected $fileName = '帖子列表.xlsx';

    protected $columns = [
        'id'      => 'ID',
        'title'   => '标题',
        'content' => '内容',
    ];
}