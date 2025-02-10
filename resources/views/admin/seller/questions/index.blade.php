@extends('admin.layout')

@section('content')

<div class="row mt-2">

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <h2>Questions</h2>

    </div>

</div>



<div class="row mt-2">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <h4 class="mt-0 header-title">Questions</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>

                        <tr>

                            <th>Post Id</th>

                            <th>User</th>

                            <th>Question</th>

                            <th>Answer</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($questions as $question)

                        <tr>

                            <td>{{$question->post_id}}</td>

                            <td>{{$question->user->name}}</td>

                            

                            <td>{{$question->question}}</td>

                            <td>{{$question->answer == null ? 'Empty..!' : $question->answer}}</td>

                            <td>

                                @if ($question->status == "pending")

                                   <span class="badge badge-warning">{{$question->status}}</span>

                                @else

                                    <span class="badge badge-pill badge-success">{{$question->status}}</span>

                               

                                @endif

                            </td>

                            <td>

                                <a class="btn btn-success" href="{{url('/seller/question-answer/'.$question->id)}}"><i class="fa fa-edit"></i></a>

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

