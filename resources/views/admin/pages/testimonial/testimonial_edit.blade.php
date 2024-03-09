@extends('admin.layout.app');

@section('heading', 'Testimonial Edit')

@section('button')
    <div>
        <a href="{{route('admin_testimonial')}}" class="btn btn-primary">View All</a>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin_testimonial_update',$testimonial_data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Existing Photo</label>
                                <div>
                                    <img src="{{asset('forntend/uploads/'.$testimonial_data->photo)}}" alt="" class="w_150">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Change Photo</label>
                                <div>
                                    <input type="file" name="photo">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name" value="{{$testimonial_data->name}}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Designation *</label>
                                <input type="text" class="form-control" name="designation" value="{{$testimonial_data->designation}}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Comment*</label>
                                <textarea name="comment" class="form-control h_100" cols="30" rows="10">{{$testimonial_data->comment}}</textarea>
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
