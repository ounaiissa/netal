<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Response;




class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth()->user()->id)->get();
        // return view('dashboard', ['portfolios' => $portfolios]);
        return response()->json($portfolios);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'images' => 'required|file',
            'images' => 'required|array',
            'images.*' => 'image|mimes:png,jpeg,png,jpg,gif|max:2048',
            // 'files' => 'required|array',
            // 'files.*' => 'image|mimes:png,jpeg,png,jpg,gif|max:2048',
        ]);


        $portfolio = new Portfolio();
        $portfolio->title = $request->input('title');
        $portfolio->description = $request->input('description');
        $portfolio->user_id = auth()->user()->id;
        $portfolio->save();


        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $path = $image->store('public/portfolio_images');
                // $portfolio->images()->create(['path' => $path]);
                $portfolioImage = new PortfolioImage();
                $portfolioImage->path = $path;
                $portfolio->images()->save($portfolioImage);
            }
        }


        // return redirect('/dashboard');
        return Response::json(['message' => 'Portfolio created successfully']);
        // ->header('Location', '/dashboard')
        // ->header('Access-Control-Allow-Origin', '*')
        // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }




    public function getData()
    {
        $title = Portfolio::select('title')->get();
        $description = Portfolio::select('description')->get();
        $imagesPath = PortfolioImage::select('path')->get();


        $data = [
            'title' => $title,
            'description' => $description,
            'imagesPath' => $imagesPath,
        ];

        return response()->json($data);
    }

    public function getImage($image)
    {
        $path = storage_path('app/public/portfolio_images/' . $image);
        if (file_exists($path)) {
            return response()->file($path);
        }
        abort(404);
    }
}
