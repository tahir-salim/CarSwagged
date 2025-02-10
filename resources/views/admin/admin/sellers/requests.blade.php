@extends('admin.layout')
@section('content')
<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h2>Requests</h2>
    </div>
</div>


<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Requests</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{$request->name}}</td>
                            <td>{{$request->subject}}</td>
                            
                            <td>{{$request->message}}</td>
                            <td>
                                @if ($request->status == "Active")
                                <span class="badge badge-pill badge-success">{{$request->status}}</span>
                                @else
                                    
                                    <span class="badge badge-warning">{{$request->status}}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{URL::to('admin/seller-request',encrypt($request->id))}}" method="POST">
                                    @csrf
                                    @if($request->status == 'Active')
                                    <button type="submit" class="btn btn-success">Active</button>
                                    @else
                                    <button type="submit" class="btn btn-info">Inactive</button>
                                    @endif
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
