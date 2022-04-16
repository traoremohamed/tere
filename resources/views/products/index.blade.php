@extends('layouts.backLayout.designadmin')


@section('content')

    @php($Module='Statistique')
    @php($titre='Statistiques des produits')
    @php($soustitre='Statistiques  produit')

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
                                    <a href="{{ route('products')}} " class="text-muted">{{$titre}}</a>
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


                    @if ($message = Session::get('errors'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                @endif


                <!--end::Notice-->
                    <!--begin::Card-->
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header">
                            <div class="card-title">
    											<span class="card-icon">
    												<i class="flaticon2-favourite text-primary"></i>{{$soustitre}}
    											</span>
                                <h3 class="card-label"></h3>
                            </div>
                        </div>


                        <div class="card-body">


                            <form action="{{ route('products')}}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}


                                <div align=right>
                                     <button type="submit" class="btn btn-sm btn-primary">Rechercher</button>

                                     <?php if(!empty($recherches)){?>
                                       <a class="btn btn-secondary" href="/apercuproduits/{{$date1}}/{{$date2}}" target="_blank">&nbsp;&nbsp;Aper&ccedil;u &nbsp;&nbsp;</a>
                                     <?php } ?>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        Periode du : <input type="date" name="date1" class="form-control"/>

                                    </div>

                                    <div class="col-lg-6">
                                       Au : <input type="date" name="date2" class="form-control"/>
                                    </div>


                                </div>
                            </form>


                            <?php if (!empty($recherches)){ ?>
                            <div class="row">

                                <div class="col-lg-12">

                                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
                                           style="margin-top: 13px !important">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Categorie produit</th>
                                            <th>Nom du produit</th>
                                            <th>Nombre de click</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;
                                        foreach ($recherches as $recherche): $i++; ?>
                                        <tr>
                                            <td>{{ $i}}</td>
                                            <td>{{ $recherche->libelle_cat_prod}} </td>
                                            <td>{{ $recherche->titre_produit}} </td>
                                            <td>{{ $recherche->nombre}}</td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>

                                <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>



@endsection
