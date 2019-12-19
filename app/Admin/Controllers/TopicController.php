<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\PostsExporter;
use App\Models\Topic;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class TopicController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Topic';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topic);

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('user.name','User name');
//        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'))->copyable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('comment', '评论数')->display(function ($comment) {

//            var_dump($comments);exit;
            $count = count($comment);
            return "<span class='label label-warning'>{$count}</span>";
        });

        $grid->column('title', '标题')->expand(function ($model) {
            $comments = $model->comment()->take(10)->get()->map(function ($comment) {
                return $comment->only(['id', 'content', 'created_at']);
            });
            return new Table(['ID', '内容', '发布时间'], $comments->toArray());
        });


//        $grid->column('title', '标题')->modal('最新评论', function ($model) {
//
//            $comments = $model->comment()->take(10)->get()->map(function ($comment) {
//                return $comment->only(['id', 'content']);
//            });
//
//
//            return new Table(['ID', '内容'], $comments->toArray());
//        });
        /**
         * 导出功能
         */
        $grid->exporter(new PostsExporter());


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Topic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topic);

        $form->text('user_id', __('User id'));
        $form->text('title', __('Title'));
        $form->text('content', __('Content'));

        return $form;
    }
}
