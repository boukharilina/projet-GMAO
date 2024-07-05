@extends('admin.layouts.app')

@push('page-header')
<div class="col">
	<h3 class="page-title">Gestion Equipement</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Equipements</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="profile-header">
			<div class="row align-items-center">

				<div class="col ml-md-n2 profile-user-info">
					<h4 class="user-name mb-0">Modèle : {{$equipement->modele}}</h4>
                    <h5 class="user-name mb-0">Marque : {{$equipement->marque}}</h5>
				</div>

			</div>
		</div>
		<div class="profile-menu">
			<ul class="nav nav-tabs nav-tabs-solid">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#per_details_tab">Aperçu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#password_tab">Pièces remplacées</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link" href="/equipements/{{ $equipement->id}}/sousequipements/create" class="btn btn-primary float-right mt-2 text-light">Ajouter Sous-equipement</a>
				</li>

			</ul>
		</div>

		<div class="tab-content profile-tab-cont">

			<!-- Aperçu equipement Tab -->
			<div class="tab-pane fade show active" id="per_details_tab">

				<!-- Aperçu equipement -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title d-flex justify-content-between">
									<span class="badge rounded-pill bg-primary-light text-light">Aperçu</span>
									<a class="edit-link" data-toggle="modal" href="#edit_equipement_details"><i class="fa fa-edit mr-1"></i>Modifier</a>
								</h4>


								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Client</p>
									<p class="col-sm-10">	{{$equipement->client->name}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Modalité</p>
									<p class="col-sm-10">{{$equipement->designation}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Numéro de Série</p>
									<p class="col-sm-10">{{$equipement->numserie}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Date Installation</p>
									<p class="col-sm-10">{{!empty($equipement->date_installation) ? date('d-M-Y', strtotime($equipement->date_installation)) : null}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Software</p>
									<p class="col-sm-10">	{{$equipement->software}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Nombre planning préventif/an</p>
									<p class="col-sm-10">	{{$equipement->plan_prev}}</p>
								</div>

							</div>
							<!-- Details contrats -->
							@if($equipement->contrat)
							<div class="card-body">
								<h4 class="card-title d-flex justify-content-between">
									<span  class="badge rounded-pill bg-primary-light text-light">Détails du contrat</span>
                                </h4>
                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Type contrat</p>
									<p class="col-sm-10">	{{$equipement->contrat->type_contrat}}</p>
								</div>
								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Date de début</p>
									<p class="col-sm-10">{{date('d-m-Y', strtotime($equipement->contrat->date_debut))}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Date de fin</p>
									<p class="col-sm-10">{{date('d-m-Y', strtotime($equipement->contrat->date_fin))}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Garantie</p>
								</div>
							</div>
							@else
							<div class="p-3 mb-2 bg-danger text-light">
                    			<p>Cet équipement est hors contrat.</p>
							</div>
							@endif
							<!-- /Details contrats -->



                        <!-- Edit Details Modal -->
						<div class="modal fade" id="edit_equipement_details" aria-hidden="true" role="dialog">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Détails Equipement</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="post" enctype="multipart/form-data" action="{{route('equipements.update',$equipement)}}">
											@csrf
											@method("PUT")
											<div class="row form-row">
												<div class="col-12">
                                                    <div class="form-group">
                                                        <label>Client <span class="text-danger">*</span></label>
                                                        <select class="select2 form-select form-control" name="client_id">
                                                            @foreach ($clients as $client)
                                                                @if ($client->id == $equipement->client_id )

                                                                    <option selected value="{{$client->id}}">{{$client->name}}</option>
                                                                @else
                                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
												</div>
												<div class="col-12">
                                                        <div class="form-group">
                                                            <label>Modèle<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="modele" value="{{$equipement->modele}}">
                                                        </div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Numéro Série</label>
														<input class="form-control select edit_role" name="numserie" value="{{$equipement->numserie}}">
													</div>
												</div>


												<div class="col-12">
													<div class="form-group">
														<label>software</label>
														<input class="form-control select edit_role" name="software" value="{{$equipement->software}}">
													</div>
												</div>


												<div class="col-12">
													<div class="form-group">
														<label>Nombre planning préventif/an</label>
														<input class="form-control select edit_role" type="number" name="plan_prev" value="{{$equipement->plan_prev}}">
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Date insatallation</label>
														<input type="date" value="{{$equipement->date_installation}}" class="form-control" name="date_installation">
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

                <!-- Liste des sous equipements -->
                @if($equipement->sousequipements->isEmpty())
                <div class="p-3 mb-2 bg-danger text-light">
                     <p>Pas de sous-équipements.</p>
                </div>
                @else
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-uppercase"><span class="badge rounded-pill bg-primary-light text-light">Liste des sous-équipements</span></h3>
                             <div class="table-responsive">
                                 <table id="equipement-sousequipement-table" class="table table-bordered">
                                     <thead>
                                         <tr>

                                             <th>Designation</th>
                                             <th>Numéro Série</th>
                                             <th>Modèle</th>
                                             <th>Marque</th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                        @foreach ($sousequipements as $sousequipement)
                                        <tr>
                                            <td>{{$sousequipement->designation}}</td>
                                            <td>{{$sousequipement->identifiant}}</td>
                                            <td>{{$sousequipement->modele}}</td>
                                            <td>{{$sousequipement->marque}}</td>
                                        </tr>
                                        @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                    </div>

                @endif



                <!-- Liste des pièces de remplacement -->
                @if($equipement->pieces->isEmpty())
                <div class="p-3 mb-2 bg-danger text-light">
                     <p>Aucune pièce de rechange.</p>
                </div>
                @else
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-uppercase"><span class="badge rounded-pill bg-primary-light text-light">Liste des pièces de rechange</span></h3>
                             <div class="table-responsive">
                                 <table id="equipement-pieces-table" class="table table-bordered">
                                     <thead>
                                         <tr class="text-uppercase">

                                             <th>Designation</th>
                                             <th>Référence/code</th>
                                             <th>Numéro de série</th>
											 <th>Date remplacement</th>
                                             <th>Quantité</th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                        @foreach ($pieces as $piece)

                                        <tr>
                                            <td>{{$piece->designation}}</td>
                                            <td>{{$piece->reference}}</td>
                                            <td>{{$piece->numserie}}</td>
											<td>{{date('d-m-Y', strtotime($piece->date_remplacement))}}</td>
                                            <td>{{$piece->qte}}</td>
                                        </tr>

                                        @endforeach
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                    </div>

                @endif
                </div>
                    </div>
                 <!-- ajout pieces remplacées
                <div id="password_tab" class="tab-pane fade">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pièces remplacées</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-12">
                                    <form action="{{ route('equipements.addPiece', $equipement->id) }}" method="POST">
                                        @csrf
                                        <div class="row form-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Désignation<span class="text-danger">*</span></label>
                                                    <input type="text" name="designation"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Numéro de série<span class="text-danger">*</span></label>
                                                      <input type="text" name="identifiant" class="form-control">
                                                    </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Modèle</label>
                                                    <input class="form-control" type="text" name="modele">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Marque</label>
                                                    <input class="form-control" type="text" name="marque">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Date de remplacement</label>
                                                    <input type="date" class="form-control" name="date_remplacement">
                                                </div>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</ajout pieces rmeplacées-->




            </div>
        </div>
    </div>
    @endsection
    @push('page-js')
    <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#equipement-pieces-table').DataTable();

        });
    </script>

@endpush
