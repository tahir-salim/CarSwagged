<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarPost;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carLists = CarPost::with('user')->get();

        return view('admin.admin.car.index', compact('carLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required',
            'model' => 'required',
            'engine' => 'required',
            'drivetrain' => 'required',
            'mileage' => 'required',
            'transmission' => 'required',
            'title_status' => 'required',
            'vin' => 'required',
            'body_style' => 'required',
            'exterior_color' => 'required',
            'location' => 'required',
            'interior_type' => 'required',
            'initial_bid_price' => 'required',
            'car_description' => 'required',
            'highlights' => 'required',
            'equipment' => 'required',
            'modifications' => 'required',
            'known_flaws' => 'required',
            'car-images' => 'required',
            'car-images.*' => 'mimes:jpeg,jpg,png',
            'car-videos' => 'required',
            'car-videos.*' => 'mimes:mp4,webm,avi',
            'year' => 'required',
            'is_reserved' => 'required',
            'bid_end_time' => 'required',
            'zip_code' => 'required',
        ]);

        $insert = new CarPost();
        $insert->make = $request->make;
        $insert->model = $request->model;
        $insert->enigne = $request->engine;
        $insert->drivetrain = $request->drivetrain;
        $insert->user_id = auth()->user()->id;
        $insert->mileage = $request->mileage;
        $insert->transmission = $request->transmission;
        $insert->title_status = $request->title_status;
        $insert->vin = $request->vin;
        $insert->body_style = $request->body_style;
        $insert->exterior_color = $request->exterior_color;
        $insert->location = $request->location;
        $insert->interior_type = $request->interior_type;
        $insert->initial_bid_price = $request->initial_bid_price;
        $insert->car_description = $request->car_description;
        $insert->highlights = $request->highlights;
        $insert->equipment = $request->equipment;
        $insert->modifications = $request->modifications;
        $insert->known_flaws = $request->known_flaws;
        $insert->year = $request->year;
        $insert->is_reserved = $request->is_reserved;
        $insert->bid_end_time = $request->bid_end_time;
        $insert->zip_code = $request->zip_code;
        $insert->created_at = time();

        if ($insert->save()) {

            $carid = $insert->id;

            if ($request->hasfile('car-images')) {
                foreach ($request->file('car-images') as $file) {
                    $name = rand(0000, 9999) . rand(0000, 9999) . time() . '.' . $file->extension();
                    $folderpath = "/car-images/" . auth()->user()->id;
                    $fullpath = $folderpath . '/' . $name;
                    $file->move(public_path($folderpath), $name);
                    $imageData[] = $fullpath;
                    $imagesCar = json_encode($imageData);
                }
            } else {
                $imagesCar = "";
            }

            if ($request->hasfile('car-videos')) {
                foreach ($request->file('car-videos') as $video) {
                    $name = rand(0000, 9999) . rand(0000, 9999) . time() . '.' . $video->extension();
                    $folderpath = "/car-videos/" . auth()->user()->id;
                    $fullpath = $folderpath . '/' . $name;
                    $video->move(public_path($folderpath), $name);
                    $videoData[] = $fullpath;
                    $videoCar = json_encode($videoData);
                }
            } else {
                $videoCar = "";
            }
            $update = CarPost::find($carid);
            $update->car_images = $imagesCar;
            $update->car_videos = $videoCar;

            if ($update->save()) {
                return redirect('admin/car')->with('success', 'Data Successfully Added');
            } else {
                return redirect('admin/car/create')->with('error', 'Data Successfully Added But Images Or Videos Not Added');
            }

        } else {
            return redirect('admin/car/create')->with('error', 'Data Not Successfully Added ');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);
        $carList = CarPost::with('user')->where('id', $id)->first();
        return view('admin.admin.car.detail', compact('carList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = CarPost::find(decrypt($id));
        return view('admin.admin.car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'make' => 'required',
            'model' => 'required',
            'engine' => 'required',
            'drivetrain' => 'required',
            'mileage' => 'required',
            'transmission' => 'required',
            'title_status' => 'required',
            'vin' => 'required',
            'body_style' => 'required',
            'exterior_color' => 'required',
            'location' => 'required',
            'interior_type' => 'required',
            'initial_bid_price' => 'required',
            'car_description' => 'required',
            'highlights' => 'required',
            'equipment' => 'required',
            'modifications' => 'required',
            'known_flaws' => 'required',
            'car-images.*' => 'mimes:jpeg,jpg,png,gif',
            'car-videos.*' => 'mimes:mp4,webm,avi',
            'year' => 'required',
            'is_reserved' => 'required',
            'zip_code' => 'required',
        ]);

        $insert = CarPost::find(decrypt($id));
        $insert->make = $request->make;
        $insert->model = $request->model;
        $insert->enigne = $request->engine;
        $insert->drivetrain = $request->drivetrain;
        $insert->mileage = $request->mileage;
        $insert->transmission = $request->transmission;
        $insert->title_status = $request->title_status;
        $insert->vin = $request->vin;
        $insert->body_style = $request->body_style;
        $insert->exterior_color = $request->exterior_color;
        $insert->location = $request->location;
        $insert->interior_type = $request->interior_type;
        $insert->initial_bid_price = $request->initial_bid_price;
        $insert->car_description = $request->car_description;
        $insert->highlights = $request->highlights;
        $insert->equipment = $request->equipment;
        $insert->modifications = $request->modifications;
        $insert->known_flaws = $request->known_flaws;
        $insert->year = $request->year;
        $insert->is_reserved = $request->is_reserved;
        $insert->bid_end_time = $request->bid_end_time;
        $insert->zip_code = $request->zip_code;
        $insert->created_at = time();

        if ($request->hasfile('car-images')) {
            foreach ($request->file('car-images') as $file) {
                $name = rand(0000, 9999) . rand(0000, 9999) . time() . '.' . $file->extension();
                $folderpath = "/car-images/" . auth()->user()->id;
                $fullpath = $folderpath . '/' . $name;
                $file->move(public_path($folderpath), $name);
                $imageData[] = $fullpath;
                $imagesCar = json_encode($imageData);
            }
            $insert->car_images = $imagesCar;
        }

        if ($request->hasfile('car-videos')) {

            foreach ($request->file('car-videos') as $video) {

                $name = rand(0000, 9999) . rand(0000, 9999) . time() . '.' . $video->extension();
                $folderpath = "/car-videos/" . auth()->user()->id;
                $fullpath = $folderpath . '/' . $name;
                $video->move(public_path($folderpath), $name);
                $videoData[] = $fullpath;
                $videoCar = json_encode($videoData);
            }
            $insert->car_videos = $videoCar;
        }

        if ($insert->save()) {
            return redirect('admin/car')->with('success', 'Data Successfully Updated');

        } else {
            return back()->with('error', 'Data Not Successfully Updated ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = CarPost::find(decrypt($id));
        $car->delete();
        return back();
    }

    public function uploadImages(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->move(public_path('images/cars/' . auth()->user()->id), $imageName);
        $imageUpload = new ImageUpload();
        $imageUpload->filename = $imageName;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }

    public function car_status(Request $request)
    {
        $id = $request->status_id;
        $car = CarPost::find($id);
        if ($request->has('status')) {
            $car->status = $request->status;
            if ($request->status == 'Published') {
                $car->bid_start_time = date('Y-m-d H:i:s');
            }
            $car->save();
            return response()->json(['success', 'Car Post Status has been Changed']);
        }
        if ($request->has('reason')) {
            $car->reason = $request->reason;
            $car->save();
            return back()->with('message', 'Car Status has been Changed');
        }

    }

    public function featured($id)
    {
        $car = CarPost::find($id);
        $car->is_featured = $car->is_featured == true ? false : true;
        $car->save();
        return response()->json(['message', 'Success']);
    }

    public function set_bid_time(Request $request)
    {
        $id = decrypt($request->car_bid_id);
        $car = CarPost::find($id);
        if ($request->bid_start_time) {
            $car->bid_start_time = $request->bid_start_time;
        }
        if ($request->bid_end_time) {
            $car->bid_end_time = $request->bid_end_time;
        }
        $car->is_bid = true;
        $car->status = 'Published';
        if ($car->save()) {

            return back()->with('success', 'Bid Timer has Been Updated');

        } else {
            return back()->with('error', 'Please Add Correct Bid Timer');
        }

    }
}
