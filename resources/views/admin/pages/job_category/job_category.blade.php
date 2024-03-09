@extends('admin.layout.app');

@section('heading', 'Job Category')

@section('button')
<div>
    <a href="{{route("admin_job_category_create")}}" class="btn btn-primary"><i class="fas fa-plus"></i>Add new</a>
</div>
@endsection

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin_profile_submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Category Icon</th>
                                            <th>Icon Preview</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($job_categories as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{{$item->name}}}</td>
                                                <td>{{$item->icon}}</td>
                                                <td>
                                                    <i class="{{$item->icon}}"></i>
                                                </td>
                                                <td class="pt_10 pb_10">
                                                    <a href="{{route("admin_job_category_edit", $item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{route("admin_job_category_delete",$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
