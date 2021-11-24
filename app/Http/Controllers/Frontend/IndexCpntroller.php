<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsFeed;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class IndexCpntroller extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        return view('frontend.index');
    }
}
