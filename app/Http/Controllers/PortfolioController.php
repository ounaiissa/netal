<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Portfolio;
use App\Models\PortfolioImage;


class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth()->user()->id)->get();
        return view('dashboard', ['portfolios' => $portfolios]);
        // return response()->json($portfolios);
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


        return redirect('/dashboard');
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
        // return response()->json($title . $description . $ImagesPath);


        // $portfolios = Portfolio::with('images')->where('user_id', auth()->user()->id)->get();

        // return response()->json($portfolios);

        // $user = Auth::user();
        // if (!$user) {
        //     // Handle unauthorized access
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        // $portfolios = Portfolio::with('images')->where('user_id', $user->id)->get();
        // $title = $portfolios->pluck('title');
        // $description = $portfolios->pluck('description');
        // $imagesPath = $portfolios->flatMap(function ($portfolio) {
        //     return $portfolio->images->pluck('path');
        // });

        // return response()->json([
        //     'title' => $title,
        //     'description' => $description,
        //     'imagesPath' => $imagesPath,
        // ]);
    }
}
