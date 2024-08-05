<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::leftJoin('banner_images as bi', 'banners.id', '=', 'bi.banner_id')
            ->select('banners.*', DB::raw("COUNT(bi.id) as total_images"))
            ->groupBy('banners.id')
            ->orderBy('is_active', 'DESC')
            ->paginate(4);
        return view('app.admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'max:255'],
            'image.*' => ['required', 'file']
        ]);
        if ($validate) {
            Banner::where('is_active', 1)->update(['is_active' => 2]);
            $insertNewBanner = Banner::create([
                'name' => $request->name,
                'created_at' => now()
            ]);
            $images = $request->file('image');
            foreach ($images as $image) {
                $fileExt = $image->getClientOriginalExtension();
                $fileName = time() . '-banner' . random_int(10, 1200000) . '.' . $fileExt;
                $image->move(public_path('uploads'), $fileName);
                BannerImage::create([
                    'file_name' => $fileName,
                    'banner_id' => $insertNewBanner->id,
                    'created_at' => now()
                ]);
            }
            return redirect()->route('bannersManagerIndex')->with('statusSuccess', 'Added new banner successfully!');
        }
        return back()->withErrors($validate);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }
    public function updateStatus(String $banner_id)
    {
        $banner = Banner::find($banner_id);
        if ($banner) {
            if ($banner->is_active == 1) {
                $banner->is_active = 2;
            } else {
                $banner->is_active = 1;
            }
            $banner->update();
            return back()->with('statusSuccess', 'Banner updated successfully!');
        } else {
            return back()->with('statusError', 'No banner found to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $banner_id)
    {
        $banner = Banner::find($banner_id);
        if ($banner) {
            $banner_images = BannerImage::where('banner_id', $banner->id)->get();
            if ($banner_images) {
                foreach ($banner_images as $itemImage) {
                    $existingFile = public_path('uploads/') . $itemImage->file_name;
                    if ($existingFile) {
                        unlink($existingFile);
                    }
                    $itemImage->delete();
                }
                $banner->delete();
                return back()->with('statusSuccess', 'Banner deleted successfully!');
            }
        } else {
            return back()->with('statusError', 'No banner found to delete');
        }
    }
}
