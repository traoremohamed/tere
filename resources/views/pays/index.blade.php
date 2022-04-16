@extends('layouts.backLayout.designadmin')

@section('content')



    @php($Module='Tableau de bord')
        @php($titre='Liste des pays')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-6">
                    <h1>{{$titre}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{$Module}}</a></li>
                        <li class="breadcrumb-item active">{{$titre}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                    <h3 class="card-title">{{$titre}}</h3>
                                </div>
                                <div class="col-2">


                                    @can('creer-pays')
                                    <a href="#" align="right" class="btn btn-sm btn-primary font-weight-bolder right">
                                        <i class="la la-plus"></i>Ajouter un pays</a>
                                    @endcan
                                </div>
                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Libelle Pays </th>
                                    <th>Nationnalite</th>
                                    <th>Indicatif</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pays as $key => $pays)
                                <tr>
                                    <td>{{ $pays->libelle_pays }}</td>
                                    <td>{{ $pays->nationalite_pays }}</td>
                                    <td>{{ $pays->indicatif }}</td>

                                </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>





@endsection
