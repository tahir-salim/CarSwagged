@extends('admin.layout')
@section('content')
<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h2>Buyer List</h2>
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
                <h4 class="mt-0 header-title">Buyers</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buyers as $buyer)
                        <tr>
                            <td>{{$buyer->name}}</td>
                            <td>{{$buyer->email}}</td>
                            <td>{{$buyer->address}}</td>
                            <td>
                            @if ($buyer->status == "Pending" || $buyer->status == "Inactive")
                                <span class="badge badge-warning">{{$buyer->status}}</span>
                            @elseif($buyer->status == "Approved")
                                <span class="badge badge-pill badge-success">{{$buyer->status}}</span>
                            @elseif($buyer->status == "Rejected")
                                <span class="badge badge-pill badge-danger">{{$buyer->status}}</span>
                            @endif
                            </td>
                            <td style="white-space: nowrap; width: 15%;">
                            
                            <form action="{{URL::to('admin/user-status',encrypt($buyer->id))}}" method="POST" id="user_status{{$buyer->id}}">@csrf
                              <select class="form-control" name="user_status" onchange="$('#user_status{{$buyer->id}}').submit()">
                                  <option value="Inactive">Inactive</option>
                                  <option value="Approved" @selected($buyer->status == 'Approved')>Approve</option>
                                  <option value="Rejected" @selected($buyer->status == 'Rejected')>Reject</option>
                              </select>
                              </form>
                              
                            </td>

                            <td><a href="{{url('/admin/buyers/'.encrypt($buyer->id))}}" class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 4px;" title="Show Buyer Detail"><i class="fas fa-eye"></i></a></td>
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
