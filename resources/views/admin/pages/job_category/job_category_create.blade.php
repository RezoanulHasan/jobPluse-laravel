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
                        <form action="{{route('admin_job_category_store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Category Name *</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group mb-3">
                                <label>Category Icon *</label>
                                <input type="text" class="form-control" name="icon">
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
