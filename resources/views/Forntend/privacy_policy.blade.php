@extends('forntend.layout.app')

@section('seo_title'){{ $privacy_page_data->title }}@endsection
@section('seo_meta_description'){{ $privacy_page_data->meta_description }}@endsection

@section('main-content')
<div class="page-top" style="background-image: url('{{ asset('forntend/uploads/banner.jpg') }}')">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $privacy_page_data->heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $privacy_page_data->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
