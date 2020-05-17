<?php

namespace App\Http\Controllers;

use App\Services\PermitService;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $service = new PermitService();
        return view('cabinet', ['service' => $service]);
    }

    public function today()
    {
        $service = new PermitService();
        if (!$service->canToday()) {
            return redirect('/cabinet');
        }
        $permit = $service->setToday();
        return redirect('/permit/' . $permit);
    }

    public function tomorrow()
    {
        $service = new PermitService();
        if (!$service->canTomorrow()) {
            return redirect('/cabinet');
        }
        $permit = $service->setTomorrow();
        return redirect('/permit/' . $permit);
    }
}
