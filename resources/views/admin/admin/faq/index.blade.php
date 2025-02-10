@extends('admin.layout')

@section('content')

<div class="row mt-2">

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <h2>Faqs</h2>

    </div>

</div>



<div class="row">

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">

        <a href="{{url('admin/faq/create')}}" class="btn btn-primary">Create Faq</a>

    </div>

</div>



<div class="row mt-2">

    <div class="col-12">

    @if(session()->has('success'))

        <div class="alert alert-success" id="alert">

            {{session('success')}}

        </div>

        @endif

        <div class="card">

            <div class="card-body">

                <h4 class="mt-0 header-title">Faqs</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>

                        <tr>

                            <th>Question</th>

                            <th>Answer</th>

                            <th>Question Type</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($faqs as $faq)

                        <tr>

                            <td>{{$faq->question}}?</td>

                            <td>{{Str::limit($faq->answer, 100)}}</td>

                            <td>{{$faq->question_type}}</td>

                            

                            <td style="white-space: nowrap; width: 15%;">

                            <a href="{{url('admin/faq/'.$faq->id.'/edit')}}" class="btn btn-primary">Edit</a> 
                            
                            <a href="#" class="btn btn-danger" onclick="$('#faq{{$faq->id}}').submit()">Delete</a>

                            <form action="{{URL::to('admin/faq',$faq->id)}}" method="POST" id="faq{{$faq->id}}">@csrf @method('DELETE')</form>

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

