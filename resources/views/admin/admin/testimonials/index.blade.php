@extends('admin.layout')
@section('content')
<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h2>Testimonials</h2>
    </div>
</div>

<!-- <div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
        <a href="{{url('admin/car/create')}}" class="btn btn-primary">Create Car Post</a>
    </div>
</div> -->

<div class="row mt-2">
    <div class="col-12">
    @if(session()->has('success'))
        <div class="alert alert-success" id="alert">
            {{session('success')}}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Testimonials</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Post Id</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>{{$testimonial->user->name}}</td>
                            <td>{{$testimonial->post_id}}</td>
                            <td>{{$testimonial->review}}</td>
                            <td>{{$testimonial->rating}}</td>
                            <td>
                            @if ($testimonial->status == "Pending" || $testimonial->status == "Inactive")
                                   <span class="badge badge-warning">{{$testimonial->status}}</span>
                                @elseif($testimonial->status == "Approved")
                                    <span class="badge badge-pill badge-success">{{$testimonial->status}}</span>
                                @elseif($testimonial->status == "Rejected")
                                    <span class="badge badge-pill badge-danger">{{$testimonial->status}}</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap; width: 15%;">
                            <form action="{{URL::to('admin/testimonial-status',encrypt($testimonial->id))}}" method="POST" id="testimonial_status{{$testimonial->id}}">@csrf
                              <select class="form-control" name="testimonial_status" onchange="$('#testimonial_status{{$testimonial->id}}').submit()">
                                  <option value="Inactive">Inactive</option>
                                  <option value="Approved" @selected($testimonial->status == 'Approved')>Approve</option>
                                  <option value="Rejected" @selected($testimonial->status == 'Rejected')>Reject</option>
                              </select>
                              </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#datatable').DataTable();
        });
       
    </script>
@endsection
