@extends('admin.layouts.app')

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Gestion Equipements de Démonstration</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Modifier Equipement de Démo</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">

			<!-- Edit Supplier -->
			<form method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('equipementdemos.update',$equipementdemo)}}">
				@csrf
				@method("PUT")
                <div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Code/Référence</label>
									<input class="form-control" type="text" name="code" value="{{$equipementdemo->code ?? old('code')}}">
								</div>
							</div>

                            <div class="col-lg-6">
								<div class="form-group">
									<label>Désignation<span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="designation" value="{{$equipementdemo->designation}}">
								</div>
							</div>
						</div>
					</div>

                    <div class="service-fields mb-3">
						<div class="row">
                            <div class="col-lg-6">
								<div class="form-group">
									<label>Modalité <span class="text-danger">*</span></label>
									<select class="select2 form-select form-control" name="modalite_id">
										@foreach ($modalites as $modalite)
                                            @if($modalite->id == $equipementdemo->modalite_id)

											    <option selected value="{{$modalite->id}}">{{$modalite->name}}</option>
                                            @else
                                                <option value="{{$modalite->id}}">{{$modalite->name}}</option>
                                            @endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Modèle<span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="modele" value="{{$equipementdemo->modele}}">
								</div>
							</div>
						</div>
					</div>

					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Numéro Série<span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="numserie" value="{{$equipementdemo->numserie}}">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Marque</label>
									<input class="form-control" type="text" name="marque" value="{{$equipementdemo->marque}}">
								</div>
							</div>
						</div>
					</div>

					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Date d'entrée</label>
									<input class="form-control" type="date" name="date_entree" value="{{$equipementdemo->date_installation}}">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Garantie</label>
									<input type="text" name="garantie" class="form-control" value="{{$equipementdemo->garantie}}">
								</div>
							</div>
						</div>
					</div>

                    <div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Fiche Technique</label>
									<input type="file" name="fiche_technique" class="form-control" value="{{$equipementdemo->document}}">
								</div>
							</div>
						</div>
					</div>

					<div class="submit-section">
                        <a href="{{route('equipementdemos.index')}}" class="btn btn-danger submit-btn">Annuler</a>
						<button class="btn btn-primary submit-btn" type="submit" >Modifier</button>
					</div>
				</form>
				<!-- /Edit Equipement-->

			</div>
		</div>
	</div>
</div>
@endsection

@push('page-js')
	<!-- Datetimepicker JS -->
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@endpush
