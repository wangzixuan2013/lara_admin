<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Replicate;
use App\Models\Movie;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MovieController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Movie';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Movie);
//        $grid->fixColumns(3);

        $grid->column('id', __('Id'))->sortable();
        /**
         * 1、设置表头帮助信息 help
         * 2、title在行中编辑
         * 3、editable
         */
        $grid->column('title', __('名称'))->help('这一列是...')->editable();
//        $grid->column('director', __('Director'));

        $grid->column('director')->display(function ($userId){
            return User::find($userId)->name;
        });

        $grid->column('released','上映?')->display(function ($released){
            return $released == 1 ? '是' : '否';
        });

        $grid->column('describe', __('Describe'));
        $grid->column('rate', __('Rate'));
        $grid->column('release_at', __('Release at'));
        /**
         * 列的排序
         */
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->editable('datetime');

        $grid->filter(function ($filter){
            $filter->between('created_at','Created Time')->datetime();
        });

        // 添加不存在的字段
//        $grid->column('1111')->display(function () {
//            return 'blablabla....';
//        });

        $grid->actions(function ($actions){
            $actions->add(new Replicate);
        });

        //禁用行选择器
        $grid->disableColumnSelector();

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
        $show = new Show(Movie::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('director', __('Director'));
        $show->field('describe', __('Describe'));
        $show->field('rate', __('Rate'));
        $show->field('release_at', __('Release at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('released', __('Released'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Movie);

        $form->text('title', __('Title'));
        $form->number('director', __('Director'));
        $form->text('describe', __('Describe'));
        $form->switch('rate', __('Rate'));
        $form->datetime('release_at', __('Release at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('created_at', __('Created at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('updated_at', __('Updated at'))->default(date('Y-m-d H:i:s'));
        $form->switch('released', __('Released'));

        return $form;
    }


}
