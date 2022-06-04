@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Opérations')
    @php($titre='Liste des matériels et machines utilisés')
    @php($titres='Rapport journalier des machines sur chantier')

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
            <!--begin::Entry-->
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
                                    <h3 class="card-title">{{$titres }}</h3>
                                </div>
                                <div class="col-2">

                                    @can('machine-create')

                                    <a href="{{ route('creer-machine') }}" align="right" class="btn btn-sm btn-primary font-weight-bolder right">
                                        <i class="la la-plus"></i>Ajouter un matériel ou machine </a>
                                    @endcan
                                </div>
                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Projet</th>
                                    <th>Date</th>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($data as $key => $machine)
                                <tr>
                                    <td>{{ $machine->id }}</td> 
                                    <td>{{ ucfirst($machine->rapport->nomprojet) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($machine->rapport->datejour)->format('d/m/Y') }}</td>
                                    <td>{{ $machine->designation }}</td>
                                    <td>{{ $machine->quantite }}</td>
                                    <td align="center">
                                        @can('machine-edit')
                                        <a href="{{ route('modifier-machine',$machine->id) }}" class="btn btn-warning btn-xs btn-clean btn-icon"
                                           title="Modifier"> <i class="fas fa-edit"></i> </a>
                                        @endcan
                                    </td>
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
