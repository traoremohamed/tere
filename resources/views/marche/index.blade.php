@extends('layouts.backLayout.designadmin')

@section('content')



@php($Module='Bureau d\'etudes')
@php($titre='Liste des marchés')

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


                                    @can('creer-marche')
                                    <a href="{{ route('marchecreer') }}" align="right" class="btn btn-sm btn-primary font-weight-bolder right">
                                        <i class="la la-plus"></i>Ajouter un marche</a>
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
                                    <th>Refernce </th>
                                    <th>Intilué  </th>
                                    <th>Type de marché </th>
                                    <th>Date de publication</th>
                                    <th>Type de Contrat</th>
                                    <th>Description</th>
                                    <th>Date expiration</th>
                                    <th>Promoteur</th>
                                    <th>Pays</th>
                                    <th>Statut</th>
                                    <th>Resultat</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=0;
                                foreach ($marches as $key => $marche):
                                    $i++;
                                ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $marche->reference_marche }}</td>
                                    <td>{{ $marche->lib_marche }}</td>
                                    <td>{{ $marche->libelle_type_marche }}</td>
                                    <td>{{ $marche->date_pub_marc }}</td>
                                    <td>{{ $marche->libelle_type_contrat }}</td>
                                    <td>{{ $marche->description_marc }}</td>
                                    <td>{{ $marche->date_expi_marc }}</td>
                                    <td>{{ $marche->promoteur_marc }}</td>
                                    <td>{{ $marche->libelle_pays }}</td>
                                    <td><?php if ($marche->flag_en_cours_march == 1 and $marche->flag_attente_marc == 0 and $marche->flag_valide_marc == 0 and $marche->flag_termine_marc == 0){?>
                                            <span class="btn btn-block btn-outline-warning">En cours</span>
                                       <?php }elseif ($marche->flag_en_cours_march == 1 and $marche->flag_attente_marc == 1 and $marche->flag_valide_marc == 0 and $marche->flag_termine_marc == 0){ ?>
                                            <span class="btn btn-block btn-outline-secondary">En Attente</span>
                                            <?php }elseif ($marche->flag_en_cours_march == 1 and $marche->flag_attente_marc == 0 and $marche->flag_valide_marc == 1 and $marche->flag_termine_marc == 0){ ?>
                                            <span class="btn btn-block btn-outline-primary">Validé</span>
                                            <?php }elseif ($marche->flag_en_cours_march == 1 and $marche->flag_attente_marc == 0 and $marche->flag_valide_marc == 0 and $marche->flag_termine_marc == 1){ ?>
                                            <span class="btn btn-block btn-outline-success">Terminé</span>
                                            <?php }else{ ?>
                                            <span class="btn btn-block btn-outline-deflaut">Activé</span>
                                       <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($marche->flag_en_cours_march == 0 ){?>
                                            <span class="btn btn-block btn-outline-primary">Non disponible</span>
                                        <?php }elseif ($marche->flag_en_cours_march == 1 ){ ?>
                                        <span class="btn btn-block btn-outline-success">Succès</span>
                                        <?php }else{ ?>
                                            <span class="btn btn-block btn-outline-danger">Echec</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        @can('modifier-marche')
                                            <a href="{{ route('marchemodifier',\App\Helpers\Crypt::UrlCrypt($type->id_marche)) }}"
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
