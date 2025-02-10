@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Create Car Post</h4>
        </div>
    </div>
</div>
<div class="row">
    <!-- ============================================================== -->
    <!-- validation form -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action={{url('seller/car')}} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <label for="validationCustom01">Make</label>
                            <input type="text" class="form-control" id="make" name="make" placeholder="Make" value={{old('make')}} >
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('make')
                                    {{ $errors->first('make') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Model" value={{old('model')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('model')
                                        {{ $errors->first('model') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Year</label>
                            <input type="number" class="form-control" id="year" name="year" placeholder="2002" value={{old('year')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('year')
                                        {{ $errors->first('year') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Enigne</label>
                            <input type="text" class="form-control" id="engine" name="engine" placeholder="Engine" value={{old('engine')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('engine')
                                        {{ $errors->first('engine') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Drivetrain</label>
                            <input type="text" class="form-control" id="drivetrain" name="drivetrain" placeholder="Drivetrain" value={{old('drivetrain')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('drivetrain')
                                        {{ $errors->first('drivetrain') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Mileage</label>
                            <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Mileage" value={{old('mileage')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('mileage')
                                        {{ $errors->first('mileage') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Transmission</label>
                            <select class="form-control" id="transmission" name="transmission">
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                            </select>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('transmission')
                                        {{ $errors->first('transmission') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Title Status</label>
                            <input type="text" class="form-control" id="title_status" name="title_status" placeholder="Title Status"  value={{old('title_status')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('title_status')
                                        {{ $errors->first('title_status') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">VIN</label>
                            <input type="text" class="form-control" id="vin" name="vin" placeholder="VIN" value={{old('vin')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('vin')
                                        {{ $errors->first('vin') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Body Style</label>
                            <select class="form-control" id="body_style" name="body_style" >
                                <option value="Coupe">Coupe</option>
                                <option value="Convertible">Convertible</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Sedan">Sedan</option>
                                <option value="SUV/Crossover">SUV/Crossover</option>
                                <option value="Truck">Truck</option>
                                <option value="Van/Minivan">Van/Minivan</option>
                                <option value="Wagon">Wagon</option>
                            </select>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('body_style')
                                        {{ $errors->first('body_style') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Exterior color</label>
                            <input type="text" class="form-control" id="exterior_color" name="exterior_color" placeholder="Exterior Color" value={{old('exterior_color')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('exterior_color')
                                        {{ $errors->first('exterior_color') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" value={{old('location')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('location')
                                        {{ $errors->first('location') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Interior Type</label>
                            <input type="text" class="form-control" id="interior_type" name="interior_type" placeholder="Interior Type" value={{old('interior_type')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('interior_type')
                                        {{ $errors->first('interior_type') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Initial Bid Price</label>
                            <input type="number" class="form-control" id="initial_bid_price" name="initial_bid_price" placeholder="Initial Bid Price" value={{old('initial_bid_price')}}>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('initial_bid_price')
                                        {{ $errors->first('initial_bid_price') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            Is Reserved?
                            <select class="form-control" id="is_reserved" name="is_reserved">
                                <option value="">Is Reserved ?</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('is_reserved')
                                        {{ $errors->first('is_reserved') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            Zip Code
                            <input type="text" class="form-control" id="zip_code" name="zip_code"  >
                              
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('zip_code')
                                        {{ $errors->first('zip_code') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Car Description</label>
                            <textarea class="form-control" id="car_description" name="car_description" placeholder="Car Description" >{{old('car_description')}}</textarea>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('car_description')
                                        {{ $errors->first('car_description') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Highlights</label>
                            <textarea class="form-control" id="highlights" name="highlights" placeholder="Highlights">{{old('highlights')}}</textarea>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('highlights')
                                        {{ $errors->first('highlights') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Equipment</label>
                            <textarea class="form-control" id="equipment" name="equipment" placeholder="Equipment">{{old('equipment')}}</textarea>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('equipment')
                                        {{ $errors->first('equipment') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Modifications</label>
                            <textarea class="form-control" id="modifications" name="modifications" placeholder="Modifications">{{old('modifications')}}</textarea>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('modifications')
                                        {{ $errors->first('modifications') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">known_flaws</label>
                            <textarea class="form-control" id="known_flaws" name="known_flaws" placeholder="Known Flaws">{{old('known_flaws')}}</textarea>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('known_flaws')
                                    {{ $errors->first('known_flaws') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 " id="car_image">
                            <label for="validationCustom02">Car Images</label>
                            <input type="file" id="car-images" name="car-images[]" class="dropify" multiple/>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @if($errors->has('car-images'))
                                        <div class="error">{{ $errors->first('car-images') }}</div>
                                    @endif
                                    @if($errors->has('car-images.*'))
                                        <div class="error">{{ $errors->first('car-images.*') }}</div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 " id="car_image">
                            <label for="validationCustom02">Car Videos</label>
                            <input type="file" id="car-videos" name="car-videos[]" class="dropify" multiple/>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @if($errors->has('car-videos'))
                                        <div class="error">{{ $errors->first('car-videos') }}</div>
                                    @endif
                                    @if($errors->has('car-videos.*'))
                                        <div class="error">{{ $errors->first('car-videos.*') }}</div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end validation form -->
    <!-- ============================================================== -->
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $('#car-images').dropify();
    $('#car-videos').dropify();
    $('#car_description').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
    });
    $('#highlights').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
    });
    $('#equipment').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
    });
    $('#modifications').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
    });
    $('#known_flaws').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
    });

});
</script>
@endsection
