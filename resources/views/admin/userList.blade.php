@extends('admin.layouts._main')

@section('title', 'Users List')

@section('styles')
    <link href="/admintheme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div id="content">

            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($users as $user)
                                    @if($user->role!=1)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>

                                        <td>
                                            @if($user->role == 2)
                                                Merchant
                                            @elseif($user->role == 3)
                                                Rider
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->status!=1)
                                                <form action="{{route('activateuser',['id' => $user->id])}}" method="get">
                                                <input type="submit" value="Inactive" class="btn btn-danger btn-sm" >
                                                </form>
                                            @else
                                                <form action="{{route('inactivateuser',['id' => $user->id])}}" method="get">
                                                <input type="submit" value="Active" class="btn btn-success btn-sm" href="">
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


@endsection
@section('scripts')

    <script src="/admintheme/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/admintheme/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/admintheme/js/demo/datatables-demo.js"></script>
@endsection
