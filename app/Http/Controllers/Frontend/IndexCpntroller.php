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
        $testimonials = Testimonial::where('status', 1)->get();
        $news         = NewsFeed::where('status', 1)->get();
        return view('frontend.index', compact('testimonials', 'news'));
    }
}
