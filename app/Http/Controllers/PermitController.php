<?php

namespace App\Http\Controllers;

use App\Permit;
use Illuminate\Http\Request;
use \PDF;

class PermitController extends Controller
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

    public function permit($id)
    {
        $permit = Permit::findOrFail($id);
        return view('permit', ['permit' => $permit]);
    }

    public function pdf($id)
    {
        $permit = Permit::findOrFail($id);
        $pdf = \PDF::loadView('pdf.permit', ['permit' => $permit]);
        return $pdf->download("permit№$id.pdf");
    }
}
