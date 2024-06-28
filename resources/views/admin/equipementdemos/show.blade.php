@extends('admin.layouts.app')

@push('page-header')
<div class="col">
	<h3 class="page-title">Gestion des equipementdemos de Démo</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">equipementdemo de Démo</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="profile-header">
			<div class="row align-items-center">

				<div class="col ml-md-n2 profile-user-info">
					<h4 class="user-name mb-0">Désignation : {{$equipementdemo->designation}}</h4>
                    <h5 class="user-name mb-0">Marque: {{$equipementdemo->marque}}</h5>
					<h6 class="text-muted">{{$equipementdemo->code}}</h6>
				</div>

			</div>
		</div>


		<div class="tab-content profile-tab-cont">

			<!-- Aperçu equipementdemodemo Tab -->
			<div class="tab-pane fade show active" id="per_details_tab">

				<!-- Aperçu equipementdemodemo -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title d-flex justify-content-between">
									<span class="badge rounded-pill bg-primary-light text-light">Aperçu</span>
									<a class="edit-link" data-toggle="modal" href="#edit_equipementdemo_details"><i class="fa fa-edit mr-1"></i>Modifier</a>
								</h4>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Modèle</p>
									<p class="col-sm-10">{{$equipementdemo->modele}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Modalité</p>
									<p class="col-sm-10">{{$equipementdemo->modalite->name}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Numéro de Série</p>
									<p class="col-sm-10">{{$equipementdemo->numserie}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Date d'entrée</p>
									<p class="col-sm-10">{{!empty($equipementdemo->date_entree) ? date('d-M-Y', strtotime($equipementdemo->date_entree)) : null}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Garantie</p>
									<p class="col-sm-10">	{{$equipementdemo->garantie}}</p>
								</div>

							</div>
							
						</div>
                        <!-- Edit Details Modal -->
                        <div class="modal fade" id="edit_equipementdemo_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Détails equipementdemo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data" action="{{route('equipementdemos.update',$equipementdemo)}}">
                                            @csrf
                                            @method("PUT")
                                            <div class="row form-row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Désignation<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="designation" value="{{$equipementdemo->designation}}">
                                                    </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Modalite<span class="text-danger">*</span></label>
                                                        <select class="select2 form-select form-control" name="modalite_id">
                                                            @foreach ($modalites as $modalite)
                                                                @if ($modalite->id == $equipementdemo->modalite_id )

                                                                    <option selected value="{{$modalite->id}}">{{$modalite->name}}</option>
                                                                @else
                                                                    <option value="{{$modalite->id}}">{{$modalite->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
												</div>

                                                <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Modèle<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="modele" value="{{$equipementdemo->modele}}">
                                                        </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Numéro Série</label>
                                                        <input class="form-control select edit_role" name="numserie" value="{{$equipementdemo->numserie}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Marque</label>
                                                        <input class="form-control select edit_role" name="marque" value="{{$equipementdemo->marque}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date d'entée</label>
                                                        <input type="date" value="{{$equipementdemo->date_entree}}" class="form-control" name="date_entree">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Garantie</label>
                                                        <input class="form-control select edit_role" name="garantie" value="{{$equipementdemo->garantie}}">
                                                    </div>
                                                </div>

                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Details Modal -->
            </div>
        </div>
    </div>
    @endsection
    @push('page-js')
    <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

@endpush
