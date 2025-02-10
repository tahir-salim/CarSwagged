@extends('admin.layout')

@section('content')
    <div class="row mt-2">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <h2>Setting</h2>

        </div>

    </div>



    {{-- <div class="row">

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">

        <a href="{{url('admin/faq/create')}}" class="btn btn-primary">Create Faq</a>

    </div>

</div> --}}



    <div class="row mt-2">

        <div class="col-12">

            @if (session()->has('success'))
                <div class="alert alert-success" id="alert">

                    {{ session('success') }}

                </div>
            @endif

            <div class="card">

                <div class="card-body">

                    <h4 class="mt-0 header-title">Manage Website Content</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>

                            <tr>

                                <th>Main Heading</th>

                                <th>Sub Heading</th>

                                <th>Description</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($settings as $setting)
                                <tr>
                                    <td>{{ $setting->key }}</td>
                                    @if ($setting->key == 'Car Swagged Logo')
                                        @php
                                            $logo = json_decode($setting->value);
                                            $image = implode($logo);
                                        @endphp
                                        <td><img src="{{ asset($image) }}" alt="" width="150px" height="100px">
                                        </td>
                                    @else
                                        <td>{{ $setting->value }}</td>
                                    @endif

                                    <td>{{ Str::limit($setting->description, 150) }}</td>

                                    <td style="white-space: nowrap; width: 15%;">
                                        <a href="{{ url('admin/settings/' . $setting->id . '/edit') }}"
                                            class="btn btn-primary">Edit</a>
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
        $(document).ready(function() {

            $('#datatable').DataTable();

        });
    </script>
@endsection
