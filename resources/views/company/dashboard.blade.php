@extends('Forntend.layout.app')

@section('main-content')
<div class="page-top" style="background-image: url('{{ asset('forntend/uploads/banner.jpg') }}')">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content user-panel">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    @include('company.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <h1>Abc Compnay</h1>
                <p>See all the statistics at a glance:</p>

                <div class="row box-items">
                    <div class="col-md-4">
                        <div class="box1">
                            <h4>404</h4>
                            <p>Open Jobs</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box2">
                            <h4>3</h4>
                            <p>Featured Jobs</p>
                        </div>
                    </div>
                </div>

                <h3 class="mt-5">Recent Jobs</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Is Featured?</th>
                                <th>Is Urgent?</th>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>Senior Laravel Developer</td>
                                <td>Web Development</td>
                                <td>
                                    <span class="badge bg-success"
                                        >Active</span
                                    >
                                </td>
                                <td>
                                    <a
                                        href=""
                                        class="btn btn-warning btn-sm text-white"
                                        ><i class="fas fa-edit"></i
                                    ></a>
                                    <a
                                        href=""
                                        class="btn btn-danger btn-sm"
                                        onClick="return confirm('Are you sure?');"
                                        ><i class="fas fa-trash-alt"></i
                                    ></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>UI/UX Designer</td>
                                <td>Web Design</td>
                                <td>
                                    <span class="badge bg-danger"
                                        >Pending</span
                                    >
                                </td>
                                <td>
                                    <a
                                        href=""
                                        class="btn btn-warning btn-sm text-white"
                                        ><i class="fas fa-edit"></i
                                    ></a>
                                    <a
                                        href=""
                                        class="btn btn-danger btn-sm"
                                        onClick="return confirm('Are you sure?');"
                                        ><i class="fas fa-trash-alt"></i
                                    ></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
