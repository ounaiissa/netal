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
use App\Models\User;

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




    // public function getData()
    // {
    //     $id = Portfolio::select('id')->get();
    //     $user_id = Portfolio::select('user_id')->get();
    //     $title = Portfolio::select('title')->get();
    //     $description = Portfolio::select('description')->get();
    //     $imagesPath = PortfolioImage::select('path')->get();

    //     $user = User::select('name')->find($user_id);


    //     $data = [
    //         'id' => $id,
    //         'title' => $title,
    //         'description' => $description,
    //         'imagesPath' => $imagesPath,
    //         'user_id' => $user_id,
    //         'user_name' => $user,
    //     ];

    //     return response()->json($data);
    // }

    public function getData()
    {
        $portfolios = Portfolio::select('id', 'title', 'description', 'user_id')->get();

        $portfoliosWithImages = $portfolios->map(function ($portfolio) {
            $images = PortfolioImage::where('portfolio_id', $portfolio->id)->pluck('path')->toArray();
            $imagesPath = $images ? $images : null;

            return [
                'id' => $portfolio->id,
                'title' => $portfolio->title,
                'description' => $portfolio->description,
                'imagesPath' => $imagesPath,
                'user_id' => $portfolio->user_id,
            ];
        });

        $userIds = $portfoliosWithImages->pluck('user_id')->toArray();
        $users = User::whereIn('id', $userIds)->select('id', 'name')->get();
        $userNames = $users->pluck('name', 'id');

        $data = $portfoliosWithImages->map(function ($portfolio) use ($userNames) {
            $userName = $userNames[$portfolio['user_id']] ?? null;

            return [
                'id' => $portfolio['id'],
                'title' => $portfolio['title'],
                'description' => $portfolio['description'],
                'imagesPath' => $portfolio['imagesPath'],
                'user_id' => $portfolio['user_id'],
                'user_name' => $userName,
            ];
        });

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


    public function deletePortfolio($id)
    {
        try {
            $portfolio = Portfolio::findOrFail($id);

            if ($portfolio->images) {
                foreach ($portfolio->images as $image) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }

            $portfolio->delete();

            return response()->json('Portfolio item deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    // public function edit(Request $request, $id)
    // {
    //     $portfolio = Portfolio::findOrFail($id);
    //     $portfolio->title = $request->input('title');
    //     $portfolio->description = $request->input('description');


    //     if ($request->hasFile('images')) {
    //         $images = $request->file('images');

    //         // Delete old images
    //         if ($portfolio->images) {
    //             foreach ($portfolio->images as $image) {
    //                 Storage::delete($image->path);
    //                 $image->delete();
    //             }
    //         }

    //         // Save new images
    //         $newImages = [];
    //         foreach ($request->file('images') as $image) {
    //             $path = $image->store('public/portfolio_images');
    //             $portfolioImage = new PortfolioImage();
    //             $portfolioImage->path = $path;
    //             $portfolio->images()->save($portfolioImage);

    //             // Collect the new portfolio images
    //             $newImages[] = $portfolioImage;
    //         }

    //         $portfolio->images = $newImages;
    //     }

    //     $portfolio->save();

    //     // return response()->json(['Portfolio item updated successfully']);
    //     return response()->json(['portfolio' => $portfolio]);
    // }

    public function edit(Request $request, $id)
    {
        try {
            $portfolio = Portfolio::findOrFail($id);
            $portfolio->title = $request->input('title');
            $portfolio->description = $request->input('description');


            if ($request->hasFile('images')) {
                return response()->json('true');
                // Delete old images
                if ($portfolio->images) {
                    foreach ($portfolio->images as $image) {
                        Storage::delete($image->path);
                        $image->delete();
                    }
                }

                $newImages = [];
                foreach ($request->file('images') as $uploadedFile) {
                    $path = $uploadedFile->store('public/portfolio_images');
                    $portfolioImage = new PortfolioImage();
                    $portfolioImage->path = $path;
                    $newImages[] = $portfolioImage;
                }

                $portfolio->images()->saveMany($newImages);
            }

            $portfolio->save();

            return response()->json('Portfolio item updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
