@extends('layouts.backLayout.designadmin')

@section('content')



@php($Module='Parametre')
@php($titre='Liste des types de marché')

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


                                    @can('creer-type-marche')
                                    <a href="{{ route('typemarchecreer') }}" align="right" class="btn btn-sm btn-primary font-weight-bolder right">
                                        <i class="la la-plus"></i>Ajouter un type de marché</a>
                                    @endcan
                                </div>
                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>N° </th>
                                    <th>Libelle type marché </th>
                                    <th>Code type marché</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=0;
                                foreach ($types as $key => $type):
                                    $i++;
                                ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $type->libelle_type_marche }}</td>
                                    <td>{{ $type->code_type_marche }}</td>
                                    <td><?php if ($type->flag_type_marche == 0){?>
                                            <span class="btn btn-block btn-outline-warning">Desactivé</span>
                                       <?php }else{ ?>
                                            <span class="btn btn-block btn-outline-success">Activé</span>
                                       <?php } ?></td>
                                    <td>
                                        @can('modifier-type-marche')
                                            <a href="{{ route('typemarchemodifier',\App\Helpers\Crypt::UrlCrypt($type->id_type_marche)) }}"
                                               class="btn btn-warning btn-xs btn-clean btn-icon"
                                               title="Modifier"> <i class="fas fa-edit"></i> </a>
                                        @endcan
                                    </td>

                                </tr>
                                <?php endforeach; ?>

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
