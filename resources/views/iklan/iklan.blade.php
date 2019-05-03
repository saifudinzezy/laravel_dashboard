<!-- Menghubungkan dengan view template master.blade.php -->
@extends('welcome')

@section('konten')
    <div class="header">
        <h1 class="page-header">
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="{{url('iklan')}}">Iklan</a></li>
            <li class="active">Data</li>
        </ol>

    </div>
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="card">
                    <div class="card-content">
                        @if(Session::has('alert-success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check"></i>
                                <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th class="center">No</th>
                                    <th class="center">Image</th>
                                    <th class="center">Title</th>
                                    <th class="center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1 @endphp
                                @foreach ($data as $d)
                                    <tr>
                                        <td class="center" width="10%">{{$no++}}</td>
                                        <td class="center" width="20%"><img width="50px" height="50px" src="{{asset('upload/image/'.$d->image)}}" alt="{{$d->judul}}"></td>
                                        <td class="center">{{$d->judul}}</td>
                                        <td width="15%" class="center">
                                            <a class="btn btn-warning btn-sm" href="/iklan/show/{{ $d->id }}"><span class="material-icons">create</span></a>
                                            <a class="btn btn-danger btn-sm" href="/iklan/destroy/{{ $d->id }}"><span class="material-icons">delete</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="fixed-action-btn horizontal click-to-toggle">
            <a href="{{url(action('IklanController@add'))}}" class="btn-floating btn-large red">
                <i class="material-icons">add</i>
            </a>
        </div>
@endsection