@extends('admin.layout.app');

@section('heading', 'Job Category')

@section('button')
    <div>
        <a href="{{route('admin_job_category')}}" class="btn btn-primary">View All</a>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin_job_category_update',$job_category_edit->id)}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Category Name *</label>
                                <input type="text" class="form-control" name="name" value="{{$job_category_edit->name}}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Icon Preview *</label>
                                <div class="mt-2">
                                    <i class="{{$job_category_edit->icon}}"></i>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Category Icon *</label>
                                <input type="text" class="form-control" name="icon" value="{{$job_category_edit->icon}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
