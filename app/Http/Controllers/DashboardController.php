<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboards.index');
    }

    public function setlocale($locale)
    {
        try {
            session()->put('locale', $locale);
            // App::setlocale($locale);
            // session()->put('locale', $locale);
            return response()->json([
                'url' => redirect()->getUrlGenerator()->previous()
            ], 200);
            // Auth::user()->profile->update(['language' => $locale]);
            // return redirect()->back();
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());

            return false;
        }
    }
}
