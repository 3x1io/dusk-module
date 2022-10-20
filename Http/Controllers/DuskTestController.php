<?php

namespace Modules\Dusk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Base\Services\Components\Base\Alert;
use Modules\Dusk\Entities\TestLog;
use Modules\Dusk\Tests\CreateUserTest;
use Modules\Dusk\Tests\UserLogin;

class DuskTestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(): \Illuminate\Http\RedirectResponse
    {
        $classes = config('dusk.classes');

        foreach($classes as $item){
            $item::make('web')->run();
        }

        return Alert::make(__('Dusk Testing Run Success'))->fire();
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        TestLog::truncate();

        return Alert::make(__('Your Log Has Been Cleared'))->fire();
    }
}
