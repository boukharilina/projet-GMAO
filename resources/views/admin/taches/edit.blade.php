@extends('admin.layouts.app')

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Tâches supplimentaires</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Modifier Tâches supplimentaires</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">

			<!-- Edit client -->
<<<<<<< HEAD
			<form method="post" enctype="multipart/form-data" action="{{route('taches.update',$tache)}}">
=======
			<form method="post" enctype="multipart/form-data" action="{{route('taches.update',$tach)}}">
>>>>>>> lina
				@csrf
				@method("PUT")
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Technicien(s)<span class="text-danger">*</span></label>
								<select  class="select2 form-select form-control" name="user[]" multiple>
									<option >Sélectionner le(s) technicien(s)</option>
                                        @foreach($users as $user)
<<<<<<< HEAD
                                            @if(in_array($user->name, $tache->user))
=======
                                            @if(in_array($user->name, $tach->user))
>>>>>>> lina
                                                <option selected value='{{ $user->name }}'>{{ $user->name }}</option>
                                            @else
                                                <option value='{{ $user->name }}'>{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
							</div>
						</div>
						<div class="col-lg-6">
							<label>Type tâche<span class="text-danger">*</span></label>
<<<<<<< HEAD
							<input class="form-control" type="text" name="type" value="{{$tache->type ?? old('type')}}">
=======
							<input class="form-control" type="text" name="type" value="{{$tach->type ?? old('type')}}">
>>>>>>> lina
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Fournisseur/Client<span class="text-danger">*</span></label>
<<<<<<< HEAD
								<input type="text" name="fournisseur" class="form-control" value="{{$tache->fournisseur ?? old('fournisseur')}}">
=======
								<input type="text" name="fournisseur" class="form-control" value="{{$tach->fournisseur ?? old('fournisseur')}}">
>>>>>>> lina
							</div>
						</div>
						<div class="col-lg-6">
							<label>Date/Heure</label>
<<<<<<< HEAD
							<input type="datetime-local" name="date" class="form-control" value="{{$tache->date ?? old('date')}}">
=======
							<input type="datetime-local" name="date" class="form-control" value="{{$tach->date ?? old('date')}}">
>>>>>>> lina
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
							<label>Commentaire</label>
<<<<<<< HEAD
							<textarea name="commentaire" class="form-control" cols="30" rows="10" value="{{$tache->commentaire ?? old('commentaire')}}"></textarea>
=======
							<textarea name="commentaire" class="form-control" cols="30" rows="10">{{ $tach->commentaire ?? old('commentaire') }}</textarea>

>>>>>>> lina
						</div>
					</div>
				</div>


				<div class="submit-section">
                    <a href="{{route('taches.index')}}" class="btn btn-danger submit-btn">Annuler</a>
					<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Modifier</button>
				</div>
			</form>

			<!-- /Edit client -->

			</div>
		</div>
	</div>
</div>
@endsection



@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

