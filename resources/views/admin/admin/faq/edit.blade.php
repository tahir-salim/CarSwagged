@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Create Faq</h4>
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
                <form action={{url('admin/faq',$faq->id)}} method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <label for="validationCustom01">Question Type</label>
                            <select name="question_type" class="form-control" >
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
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="Question" value="{{$faq->question}}">
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('question')
                                        {{ $errors->first('question') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Answer</label>
                            <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer" value="{{$faq->answer}}">
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('answer')
                                        {{ $errors->first('answer') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button class="btn btn-primary" type="submit">Submit</button>
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
