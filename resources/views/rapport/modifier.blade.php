@extends('layouts.backLayout.designadmin')


@section('content')


    @php($Module='Opérations')
    @php($titre='Liste des rapports journaliers')
    @php($soustitre='Modifier un rapport')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$soustitre}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{$Module}}</a></li>
                        <li class="breadcrumb-item active">{{$titre}}</li>
                        <li class="breadcrumb-item active">{{$soustitre}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if ($errors->any())

            <div class="alert alert-custom alert-danger fade show" role="alert">
                <div class="alert-text">
                    <strong>Echec :</strong> Veuillez renseigner les informations du formulaire !</div>
                <div class="alert-close">
                    <button type="button" class="btn-sx close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
            @endif

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$soustitre}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form action="{{ route('modifier-rapport',\App\Helpers\Crypt::UrlCrypt($type->id)) }}" method="POST">
                                @csrf
                    
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Titre du projet</label>
                                    <input placeholder="Entrez le titre " type='text' name="titre" class="form-control mb-1" value="{{$type->titre}}">
                                    <span class="form-text text-muted">  </span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Désigantion du projet</label>
                                    <input placeholder="Entrez le projet" type='text' name="nomprojet" class="form-control mb-1" value="{{$type->nomprojet}}">
                                    <span class="form-text text-muted">  </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Nom & Prénoms du chef</label>
                                    <input placeholder="Entrez le nom du chef" type='text' name="nomchef" class="form-control mb-1" value="{{$type->nomchef}}">
                                    <span class="form-text text-muted">  </span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Date du jour</label>
                                    <input placeholder="Entrez la date" type='date' name="datejour" class="form-control mb-1" value="{{$type->datejour}}">
                                    <span class="form-text text-muted">  </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                
                                <div class="col-lg-6">
                                    <label>Contact du chef projet</label>
                                    <input placeholder="Entrez le contact " type='text' name="contact" class="form-control mb-1" value="{{$type->contact}}">
                                    <span class="form-text text-muted">  </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('list-rapport') }}"> Retour</a>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Valider</button>
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        
    </section>
    <!-- /.content -->

</div>
@endsection
