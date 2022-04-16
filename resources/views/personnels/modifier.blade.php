@extends('layouts.backLayout.designadmin')


@section('content')

@php($Module='Parametre')
@php($titre='Liste des personnels')
@php($soustitre='Modifier un personnel')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{$soustitre}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a class="text-muted">{{$Module}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">{{$titre}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">{{$soustitre}}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
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

            <!--end::Notice-->
            <!--begin::Card-->
            <div class="card card-custom" style="width: 100%">
                <div class="card-header">
                    <div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-favourite text-primary"></i>
											</span>
                        <h3 class="card-label">{{$soustitre}}</h3>
                    </div>

								<div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i>Exporter
                            </button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav flex-column nav-hover">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-print"></i>
                                            <span class="nav-text">Imprimer</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-text-o"></i>
                                            <span class="nav-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-pdf-o"></i>
                                            <span class="nav-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                        <!--begin::Button-->
                        @can('creation-partenaire')
                                                        @can('active-desactive-personnel')

                                                        <?php if($personnel->flag_personnel == 1){ ?>

                                                            <label class="label label-lg label-warning label-inline"><a href="{{ route('desactivepersonnel',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}" style="color:#ffffff"> Desactiver </a></label>

                                                        <?php }else{ ?>

                                                            <label class="label label-lg label-success label-inline"><a href="{{ route('activepersonnel',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}" style="color:#ffffff"> Active </a></label>

                                                        <?php }  ?>

                                                       <br>

                                                        @endcan

                                                        @can('active-desactive-personnelres')

                                                        <?php if($personnel->flag_actif_responsable == 1){ ?>

                                                            <label class="label label-lg label-secondary label-inline"><a href="{{ route('desactivepersonnelres',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}" style="color:#ffffff"> Desactiver DG </a></label>

                                                        <?php }else{ ?>

                                                            <label class="label label-lg label-primary label-inline" style="color:#ffffff"><a href="{{ route('activepersonnelres',\App\Helpers\Crypt::UrlCrypt($personnel->id_personnel )) }}" style="color:#ffffff"> Active DG </a></label>

                                                        <?php }  ?>


                                                        @endcan
                        @endcan
                        <!--end::Button-->
                    </div>
                </div>
                <form  action="{{ route('modifierpersonnel',\App\Helpers\Crypt::UrlCrypt($id))}}" method="post"  enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Nom du personnel:</label>
                            <input class="form-control" type="text" name="nom_personnel" value="{{$personnel->nom_personnel}}" >
                            <span class="form-text text-muted">  </span>
                        </div>

                        <div class="col-lg-6">
                            <label>Prenom du personnel:</label>
                            <input class="form-control" type="text" name="prenom_personnel" value="{{$personnel->prenom_personnel}}" >
                            <span class="form-text text-muted">  </span>
                        </div>

                        <div class="col-lg-6">
                            <label>Fonction:</label>
                            <input class="form-control" type="text" name="fonction_personnel" value="{{$personnel->fonction_personnel}}" >
                            <span class="form-text text-muted">  </span>
                        </div>





                        <div class="col-lg-6">
                            <label>Date debut fonction:</label>
                            <input class="form-control" type="date" name="date_debut_fonction" value="{{$personnel->date_debut_fonction}}" >
                            <span class="form-text text-muted">  </span>
                        </div>

                        <div class="col-lg-6">
                            <label>Date fin fonction:</label>
                            <input class="form-control" type="date" name="date_fin_fonction" value="{{$personnel->date_fin_fonction}}" >
                            <span class="form-text text-muted">  </span>
                        </div>

 <div class="col-lg-6">
                                                    <label>Photo:</label>
                                                    <input type="file" class="form-control" placeholder="ajouter un  fichier" name="image_personnel"  />


                                                    <span class="form-text text-muted">  </span>
                                                </div>


  <div class="col-lg-6">
                            <label>Mot:</label>
                            <textarea class="summernote" id="description_slide" name="mot_personnel" rows="6">{{$personnel->mot_personnel}}</textarea>

                        </div>


                        <div class="col-lg-6">
                        <label>Photo:</label>
                            @if(!empty($personnel->image_personnel))

                                                            <img src="{{ asset('/frontend/imagepersonnel/'. $personnel->image_personnel)}}" width="100%" height="75%" alt="">

                                                          @endif
                                                </div>





                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a class="btn btn-sm btn-secondary" href="{{ route('personnel') }}"> Retour</a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                        </div>
                    </div>
                </div>

                </form>
            </div>


            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>



@endsection
