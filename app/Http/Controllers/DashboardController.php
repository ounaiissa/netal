<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function store(Request $request)
    {
        return redirect()->back()->with('success', 'Form submitted successfully');
        // dd('Store method called');
    }
}
