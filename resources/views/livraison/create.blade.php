@extends('layouts.backLayout.designadmin')


@section('content')


    @php($Module='Opérations')
    @php($titre='Liste des livrables')
    @php($soustitre='Ajouter un livrable')




<div class="content-wrapper" >
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
                        {!! Form::open(array('route' => 'store-livrable','method'=>'POST')) !!}
                       
                        <div class="card-body" >
                            <div class="form-group row ">
                                <div class="col-lg-12">
                                    <select class="form-control select2" name="rapport_id">
                                        <?php echo $rapports; ?>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Désignation livrable</label>
                                    <input placeholder="Entrez la désignation" type=text name="designation" class="form-control mb-1">
                                    <span class="form-text text-muted">  </span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Date du livrable</label>
                                    <input placeholder="Entrez la date" type='date' name="datelivraison" class="form-control mb-1">
                                    <span class="form-text text-muted">  </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('list-livrable') }}"> Retour</a>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Valider</button>
                                </div>
                            </div>
                        </div>
                        
                        {!! Form::close() !!}

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
