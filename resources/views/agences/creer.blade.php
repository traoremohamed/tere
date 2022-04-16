@extends('layouts.backLayout.designadmin')


@section('content')

@php($Module='Parametre')
@php($titre='Liste des agences')
@php($soustitre='Ajouter agence')


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
                </div>
                {!! Form::open(array('route' => 'creeragences','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <div class="card-body">
                    <div class="form-group row">

                        <div class="col-lg-6">
                            <label>Nom de l'agence:</label>
                            <select class="form-control "
                                    name="type_agence" id="kt_select2_2">
                                <option value="">Veuillez selectinnez type agence</option>
                                <option value="DELEGATION REGIONALE">DELEGATION REGIONALE</option>
                                <option value="BUREAUX DIRECTS">BUREAUX DIRECTS</option>
                                <option value="SIEGE">SIEGE</option>
                            </select>

                        </div>

                        <div class="col-lg-6">
                            <label>Nom de l'agence:</label>
                            <input type="text" class="form-control" placeholder="Nom de agence" name="nom_agence"  />

                        </div>

                        <div class="col-lg-6">
                            <label>Contact tel agence:</label>
                            <input type="text" class="form-control" placeholder="Contact tel agence" name="contact_tel_agence"  />

                        </div>

                        <div class="col-lg-6">
                            <label>Contact email agence:</label>
                            <input type="text" class="form-control" placeholder="Contact email agence" name="contact_mail_agence"  />

                        </div>

                        <div class="col-lg-6">
                            <label>Latitude agence:</label>
                            <input type="text" class="form-control" placeholder="Latitude agence" name="lat_agence"  />

                        </div>

                        <div class="col-lg-6">
                            <label>Longitude agence:</label>
                            <input type="text" class="form-control" placeholder="Longitude agence" name="long_agence"  />

                        </div>

                        <div class="col-lg-6">
                            <label>Inforamtion complementaire:</label>
                            <textarea class="summernote" id="info_compl_agence" name="info_compl_agence" rows="6"></textarea>

                        </div>

                        <div class="col-lg-6">
                            <label>Ordre:</label>
                            <input type="number" class="form-control" placeholder="ordre d'affichage" name="ordre_agence">
                        </div>
                        <div class="col-lg-12">
                            <label>Image agence:</label>
                            <input type="file" class="form-control" placeholder="ajouter un  fichier" name="image_agence"  />


                            <span class="form-text text-muted">  </span>
                        </div>



                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a class="btn btn-sm btn-secondary" href="{{ route('agences') }}"> Retour</a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Valider</button>
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
{!! Form::close() !!}


@endsection
