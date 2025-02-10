@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Update Website Content</h4>
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
                    <form action={{ url('admin/settings', $setting->id) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <label for="validationCustom01">Main Heading</label>
                                <input type="text" class="form-control" id="question" value="{{ $setting->key }}"
                                    readonly>

                                {{-- <select name="question_type" class="form-control" >
                                <option value="buyer" @selected($faq->question_type == 'buyer')>Buyer Questions</option>
                                <option value="seller" @selected($faq->question_type == 'seller')>Seller Questions</option>
                                <option value="signin" @selected($faq->question_type == 'signin')>Sign In Questions</option>
                            </select>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('question_type')
                                    {{ $errors->first('question_type') }}
                                    @enderror
                                </li>
                            </ul> --}}
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                @if ($setting->key == 'Car Swagged Logo')
                                    <label for="validationCustom02">Image</label>
                                    <input type="file" class="form-control" name="image" id="">
                                @elseif ($setting->key == 'Facebook' || $setting->key || ('Instagram' && $setting->key) || 'Twitter')
                                    <label for="validationCustom02">Link</label>
                                    <input type="text" class="form-control" id="question" name="social" value="{{ $setting->value }}">
                                @else
                                    <label for="validationCustom02">Sub Heading</label>
                                    <input type="text" class="form-control" id="question" value="{{ $setting->value }}"
                                        readonly>
                                @endif
                            </div>

                            @if ($setting->key != 'Car Swagged Logo' &&
                                $setting->key != 'Facebook' &&
                                $setting->key != 'Instagram' &&
                                $setting->key != 'Twitter')
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <label for="validationCustom02">Description</label>
                                    <textarea class="form-control" id="answer" name="description">{{ $setting->description }}</textarea>
                                    <ul class="parsley-errors-list filled" id="parsley-id-39">
                                        <li class="parsley-required">
                                            @error('answer')
                                                {{ $errors->first('answer') }}
                                            @enderror
                                        </li>
                                    </ul>
                                </div>
                            @endif

                        </div>

                        <div class="row mt-2">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <button class="btn btn-primary" type="submit">Update</button>
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
@endsection
