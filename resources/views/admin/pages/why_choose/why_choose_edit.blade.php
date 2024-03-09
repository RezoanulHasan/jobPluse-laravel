@extends('admin.layout.app');

@section('heading', 'Why Choose Item Edit')

@section('button')
    <div>
        <a href="{{route('admin_why_choose')}}" class="btn btn-primary">View All</a>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin_why_choose_update',$why_choose_item->id)}}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label>Icon Preview *</label>
                                <div class="mt-2">
                                    <i class="{{$why_choose_item->icon}}"></i>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Icon *</label>
                                <input type="text" class="form-control" name="icon" value="{{$why_choose_item->icon}}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Heading *</label>
                                <input type="text" class="form-control" name="heading" value="{{$why_choose_item->heading}}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Text *</label>
                                <textarea name="text" class="form-control h_100" cols="30" rows="10">{{$why_choose_item->text}}</textarea>
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
