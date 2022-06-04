@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Opérations')
    @php($titre='Liste des consommables utilisés')
    @php($titres='Rapport journalier des consommables sur chantier')

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

                                    @can('consommable-create')

                                    <a href="{{ route('creer-consommable') }}" align="right" class="btn btn-sm btn-primary font-weight-bolder right">
                                        <i class="la la-plus"></i>Ajouter un consommable </a>
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
                                    <th>unité</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($data as $key => $consommable)
                                <tr>
                                    <td>{{ $consommable->id }}</td> 
                                    <td>{{ ucfirst($consommable->rapport->nomprojet) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($consommable->rapport->datejour)->format('d/m/Y') }}</td>
                                    <td>{{ $consommable->designation }}</td>
                                    <td>{{ $consommable->quantite }}</td>
                                    <td>{{ $consommable->unite }}</td>
                                    <td align="center">
                                        @can('consommable-edit')
                                        <a href="{{ route('modifier-consommable',$consommable->id) }}" class="btn btn-warning btn-xs btn-clean btn-icon"
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
