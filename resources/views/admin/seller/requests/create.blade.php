@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Add Request For Admin</h4>
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
                <form action="{{url('seller/seller-request')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                    <div class="col-md-6">
                    <label for="validationCustom02">Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Enter Subject" >
                    </div>
                    <div class="col-md-6">
                    <label for="my-textarea">Message</label>
                    <textarea id="my-textarea" class="form-control" name="message" rows="3"></textarea>
                    </div>  
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button class="btn btn-primary" type="submit">Submit Answer</button>
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
