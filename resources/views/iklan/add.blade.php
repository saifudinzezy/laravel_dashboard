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

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{$error}} <br>
                                @endforeach
                            </div>
                        @endif
                        <br>

                        <form class="col s12" method="POST" enctype="multipart/form-data" action="{{url(action('IklanController@store'))}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="last_name" type="text" class="validate" name="judul" value="{{old('judul')}}">
                                    <label for="nama_iklam" class="active">Nama Iklan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="file" class="custom-file-input" name="image" class="validate">
                                    <label class="custom-file-label"></label>
                                </div>
                            </div>

                            <br><br>
                            <button class="btn waves-effect light-green text-right" type="submit" name="action">Simpan
                            </button>
                        </form>
                        <div class="clearBoth"></div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
@endsection