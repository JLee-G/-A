<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Huztw\Admin\Views\Content;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...');
    }
}
