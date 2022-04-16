@extends('layouts.backLayout.designadmin')


@section('content')

@php($Module='Parametre')
@php($titre='Liste des slides')
@php($soustitre='Modifier un slide')


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

                                            <!--end::Dropdown-->
                                            <!--begin::Button-->

 @can('active-desative-produit')

                                <?php if($produit->flag_produit == 1){ ?>

                                    <label class="label label-lg label-warning label-inline"><a href="{{ route('desactiveproductservice',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Desactiver </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-success label-inline"><a href="{{ route('activeproductservice',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Active </a></label>

                                <?php }  ?>

                                @endcan

                                @can('produit-phare-active-desactive')

                                <?php if($produit->flag_produit_phare == 1){ ?>

                                    <label class="label label-lg label-success label-inline"><a href="{{ route('desactiveproduitphare',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Desactiver produit pahre </a></label>

                                <?php }else{ ?>

                                    <label class="label label-lg label-primary label-inline"><a href="{{ route('activeproduitphare',\App\Helpers\Crypt::UrlCrypt($produit->id_produit)) }}" style="color: #FFFFFF"> Active produit phare </a></label>

                                <?php }  ?>

                                @endcan
                                            <!--end::Button-->
                                        </div>
                </div>
                <form  action="{{ route('modifierproductservice',\App\Helpers\Crypt::UrlCrypt($id))}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label></label>
                                <select
                                    class="form-control "
                                    name="id_cat_produit" id="kt_select2_2"/>

                                <?php echo $categoriesact; ?>

                                </select>

                            </div>

                            <div class="col-lg-6">
                                <label>Titre service:</label>
                                <input class="form-control" type="text" name="titre_produit" value="{{$produit->titre_produit}}" >
                                <span class="form-text text-muted">  </span>
                            </div>

                            <div class="col-lg-6">
                                <label>Lien de l'article:</label>
                                <input type="text" class="form-control" placeholder="Lien produit" name="lien_produit" value="{{$produit->lien_produit}}"  />

                            </div>

                            <div class="col-lg-6">
                                <label>Description:</label>
                                <textarea class="summernote" id="description_produit" name="description_produit" rows="6">{{$produit->description_produit}}</textarea>

                            </div>

                            <div class="col-lg-6">
                                <label>Icon:</label>
                                <input type="file" class="form-control" placeholder="ajouter une icone" name="icon"  />


                                <span class="form-text text-muted">  </span>
                            </div>

                            <div class="col-lg-6">
                                <label>Image:</label>
                                <input type="file" class="form-control" placeholder="ajouter un  fichier" name="image"  />


                                <span class="form-text text-muted">  </span>
                            </div>

                             <div class="col-lg-6">
                                                           @if(!empty($produit->icon_produit))
                                                                                          <img src="{{ asset('/frontend/produit/icon/'. $produit->icon_produit)}}" alt="" style="width:90px;">
                                                                                          @endif
                                                        </div>

                                                        <div class="col-lg-6">
                                                          @if(!empty($produit->image_produit))
                                                                                         <img src="{{ asset('/frontend/produit/image/'. $produit->image_produit)}}" alt="" style="width:90px;">
                                                                                         @endif
                                                        </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-sm btn-secondary" href="{{ route('productservice') }}"> Retour</a>
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



@endsection
