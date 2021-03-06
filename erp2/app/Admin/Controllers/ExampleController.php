<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Huztw\Admin\Facades\Admin;
use Huztw\Admin\Facades\Permission;
use Huztw\Admin\View\Content;

class ExampleController extends Controller
{
    public function index(Content $content)
    {
        Permission::permission()->check('dashboard', function () {
            if (Admin::user()) {
                echo 'User [' . Admin::user()->username . '] check fail!';
            } else {
                echo 'Please login first!';
            }
        });

        return $content
            ->layout('admin::layouts.admin', ['_title_' => trans("admin.home")])
            ->append('admin::index')
            ->style('<link href="' . admin_asset('vendor/huztw-admin/css/admin.css') . '" rel="stylesheet">')
            ->script('<script src="' . admin_asset('vendor/huztw-admin/jQuery/jquery-3.4.1.min.js') . '"></script>')
            ->script('<script src="' . admin_asset('vendor/huztw-admin/js/admin.js') . '"></script>');
    }
}
