@extends('admin.layout.app');

@section('heading', 'Home Page Settings')

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('home_page_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-start custom-tab">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-1-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-home" type="button" role="tab"
                                        aria-controls="v-pills-1" aria-selected="true">Search</button>

                                    <button class="nav-link" id="v-pills-2-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-2" type="button" role="tab" aria-controls="v-pills-2"
                                        aria-selected="false">Job Category
                                    </button>

                                    <button class="nav-link" id="v-pills-3-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-3" type="button" role="tab" aria-controls="v-pills-3"
                                        aria-selected="false">Why Choose
                                    </button>
                                    <button class="nav-link" id="v-pills-4-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-4" type="button" role="tab" aria-controls="v-pills-4"
                                        aria-selected="false">Featured Job
                                    </button>
                                    <button class="nav-link" id="v-pills-5-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-5" type="button" role="tab" aria-controls="v-pills-5"
                                        aria-selected="false">Testimonial
                                    </button>
                                    <button class="nav-link" id="v-pills-6-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-6" type="button" role="tab" aria-controls="v-pills-6"
                                        aria-selected="false">Blog</button>

                                    <button class="nav-link" id="v-pills-7-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-7" type="button" role="tab" aria-controls="v-pills-6"
                                        aria-selected="false">Seo Section</button>


                                </div>
                                <div class="col-lg-9 col-md-">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            {{-- Search Section Start Here --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-lable">Heading *</label>
                                                        <input type="text" class="form-control" name="heading"
                                                            value="{{ $home_page_data->heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Text </label>
                                                        <textarea class="form-control h_100" name="text" cols="30" rows="10">{{ $home_page_data->text }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-lable">Job Title *</label>
                                                                <input type="text" class="form-control" name="job_title"
                                                                    value="{{ $home_page_data->job_title }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-lable">Job Location *</label>
                                                                <input type="text" class="form-control"
                                                                    name="job_location"
                                                                    value="{{ $home_page_data->job_location }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-lable">Job Category *</label>
                                                                <input type="text" class="form-control"
                                                                    name="job_category"
                                                                    value="{{ $home_page_data->job_category }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-lable">Search *</label>
                                                                <input type="text" class="form-control" name="search"
                                                                    value="{{ $home_page_data->search }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4"> +
                                                        <label class="form-lable">Background Image *</label>
                                                        <div>
                                                            <img src="{{ asset('forntend/uploads/' . $home_page_data->background) }}"
                                                                name="background" class="w_300">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Change Image</label>

                                                        <input type="file" class="form-control mt_10"
                                                            name="background">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Search Section Ends Here --}}
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                            aria-labelledby="v-pills-profile-tab">
                                            {{-- Job Category Section Start Here --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-lable">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="job_category_heading"
                                                            value="{{ $home_page_data->job_category_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Sub Heading </label>
                                                        <input type="text" class="form-control"
                                                            name="job_category_subheading"
                                                            value="{{ $home_page_data->job_category_subheading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Status *</label>
                                                        <select name="job_category_status" class="form-control"
                                                            id="">
                                                            <option value="Show"
                                                                @if ($home_page_data->job_category_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->job_category_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Job Category Section Start Here --}}
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel"
                                            aria-labelledby="v-pills-3">
                                            {{-- Why Choose Section Start Here --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-lable">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="why_choose_heading"
                                                            value="{{ $home_page_data->why_choose_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Sub Heading </label>
                                                        <input type="text" class="form-control"
                                                            name="why_choose_subheading"
                                                            value="{{ $home_page_data->why_choose_subheading }}">
                                                    </div>
                                                    <div class="mb-4"> +
                                                        <label class="form-lable">Background Image *</label>
                                                        <div>
                                                            <img src="{{ asset('forntend/uploads/' . $home_page_data->why_choose_background) }}"
                                                                name="why_choose_background" class="w_300">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Change Image</label>

                                                        <input type="file" class="form-control mt_10"
                                                            name="why_choose_background">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Status *</label>
                                                        <select name="why_choose_status" class="form-control"
                                                            id="">
                                                            <option value="Show"
                                                                @if ($home_page_data->why_choose_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->why_choose_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Why Choose Section Ends  Here --}}
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-4" role="tabpanel"
                                            aria-labelledby="v-pills-4-tab">
                                            {{-- Featured Job Section Start Here --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-lable">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="featured_job_heading"
                                                            value="{{ $home_page_data->featured_job_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Sub Heading </label>
                                                        <input type="text" class="form-control"
                                                            name="featured_job_subheading"
                                                            value="{{ $home_page_data->featured_job_subheading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Status *</label>
                                                        <select name="featured_job_status" class="form-control"
                                                            id="">
                                                            <option value="Show"
                                                                @if ($home_page_data->featured_job_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->featured_job_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Featured Job Section Start Here --}}
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-5" role="tabpanel"
                                            aria-labelledby="v-pills-5">
                                            {{-- Testimonial Section Start Here --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-lable">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="testimonial_heading"
                                                            value="{{ $home_page_data->testimonial_heading }}">
                                                    </div>
                                                    <div class="mb-4"> +
                                                        <label class="form-lable">Background Image *</label>
                                                        <div>
                                                            <img src="{{ asset('forntend/uploads/' . $home_page_data->testimonial_background) }}"
                                                                name="testimonial_background" class="w_300">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Change Image</label>

                                                        <input type="file" class="form-control mt_10"
                                                            name="testimonial_background">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-lable">Status *</label>
                                                        <select name="testimonial_status" class="form-control"
                                                            id="">
                                                            <option value="Show"
                                                                @if ($home_page_data->testimonial_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->testimonial_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Testimonial Section Ends  Here --}}
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-6" role="tabpanel"
                                            aria-labelledby="v-pills-6-tab" tabindex="0">
                                            <!-- Blog Section Start -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Heading *</label>
                                                        <input type="text" class="form-control" name="blog_heading"
                                                            value="{{ $home_page_data->blog_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Sub Heading</label>
                                                        <input type="text" class="form-control" name="blog_subheading"
                                                            value="{{ $home_page_data->blog_subheading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Status *</label>
                                                        <select name="blog_status" class="form-control select2">
                                                            <option value="Show"
                                                                @if ($home_page_data->blog_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->blog_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Blog Section End -->
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-7" role="tabpanel"
                                            aria-labelledby="v-pills-7-tab" tabindex="0">
                                            <!-- Blog Section Start -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Title *</label>
                                                        <input type="text" class="form-control" name="title"
                                                            value="{{ $home_page_data->title }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Sub Heading</label>
                                                        <input type="text" class="form-control" name="meta_description"
                                                            value="{{ $home_page_data->meta_description }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Blog Section End -->
                                        </div>

                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
