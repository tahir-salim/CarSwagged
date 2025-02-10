@extends('admin.layout')
@section('content')
<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h2>Comments</h2>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Comments</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Post Id</th>
                            <th>User</th>
                            <th>Seller</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->post_id}}</td>
                            <td>{{$comment->user->name}}</td>
                            <td>{{$comment->seller->name}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>
                                @if ($comment->status == "Inactive")
                                   <span class="badge badge-warning">{{$comment->status}}</span>
                                @else
                                    <span class="badge badge-pill badge-success">{{$comment->status}}</span>
                               
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success change_status" href="/admin/change-status/{{$comment->id}}">{{$comment->status == 'Inactive' ? 'Active' : 'Inactive'}}</a>
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
