<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
//        $grid->column('email_verified_at', __('Email verified at'));
//        $grid->column('password', __('Password'));
//        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
        $grid->column('profile.age','age');
//        $grid->column('profile.gender','gender');

        $grid->column('profile.gender')->using(['fmale' => '女', 'male' => '男']);

        /**
         * 头部显示chart图表
         */
        $grid->header(function () {
            $gender = DB::table('profiles')->select(DB::raw('count(gender) as count, gender'))
                ->groupBy('gender')->get()->pluck('count', 'gender')->toArray();

            $gender['un_know'] = 0;

            $doughnut = view('admin.chart.gender', compact('gender'));

            return new Box('性别比例', $doughnut);
        });

        /**
         * 快捷搜索
         */
        $grid->quickSearch('name');

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
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

        $form = new Form(new User);

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
//        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
//        $form->password('password', __('Password'));
//        $form->text('remember_token', __('Remember token'));
        $form->text('profile.age');
        $form->text('profile.gender');

        $form->datetime('created_at');
        $form->datetime('updated_at');
//        $form->setAction('admin/users');

        $form->isEditing();

//        $form->deleting();

//        $form->text('title')->creationRules('required|min:3');


//        $form->destroy(function (Form $form){
//            var_dump($form);exit;
//        });
//        $form->deleted(function (Form $form){
//            var_dump($form);exit;
//        });

//        //保存后回调
//        $form->saved(function (Form $form) {
//            var_dump($form);exit;
//        });

//        $form->deleted(function () {
//            throw new \Exception('hahaa');
//        });

//        $form->select('name','bar')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);



        return $form;
    }

    public function destroy($id)
    {

//        parent::destroy($id);
        var_dump($id);exit;
//        $this->authorize('destroy', $topic);
//        $topic->delete();
//
//        return redirect()->route('topics.index')->with('success', '成功删除！');
    }

//    public function create(Content $content)
//    {
//        return $content;
//        var_dump($content);exit;
//    }


}
