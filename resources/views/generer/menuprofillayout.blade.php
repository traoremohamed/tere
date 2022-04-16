@extends('layouts.backLayout.designadmin')

@section('content')



     @php($Module='Parametre')
           @php($titre='Attribution du profil:')
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
    <div class="col-md-12">
        <form action="{{ route('menuprofillayout',$role->id) }}" method="POST" enctype="multipart/form-data" >
            @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h3 class="card-title">{{$titre}}</h3>
                        <h4 class="card-title">{{ $nomprof }}</h4>
                    </div>
                    <div class="col-2">

                        @can('role-create')

                        <button type="submit" class="btn btn-sm btn-primary font-weight-bolder"> <i class="la la-plus"></i>Attribuer
                        </button>

                        @endcan
                    </div>
                </div>

            </div>


                <!-- /.card-header -->

                <div class="card-body">
                    <?php $i=0; foreach ($tablsm as $key => $tablvue) { $i++;?>
                    <div class="card card-primary">


                        <div id="accordion">

                            <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->


                            <div class="card-header">
                                <h4 class="card-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key; ?>">
                                        {{ $tablvue[0]->menu }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne<?php echo $key; ?>" class="panel-collapse collapse in">
                                <?php foreach ( $tablvue as $key => $vue) { ?>
                                    <div class="card-body">
                                        <div class="checkbox-list">
                                            <label class="checkbox">
                                                <input type="checkbox"  value="<?php echo $vue->id_sousmenu;?>" <?php if(in_array ($vue->id_sousmenu, $roleSousmenus)) {echo 'checked';}?> name="route[<?php echo $vue->id_sousmenu;?>]" id="route<?php echo $vue->id_sousmenu;?>" />
                                                <span></span><?php echo    $vue->libelle; ?></label>

                                        </div>
                                    </div>
                                <?php  } ?>
                            </div>
                        </div>




                    </div>
                    <?php  } ?>
                </div>
                <!-- /.card-body -->

        </div>
        <!-- /.card -->
        </form>
    </div>

</div>
<!-- /.row -->
        </div>
    </section>
</div>

@endsection
