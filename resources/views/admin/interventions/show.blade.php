@extends('admin.layouts.app')

@push('page-header')
<div class="col">
	<h3 class="page-title">Gestion Interventions</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Aperçu Intervention</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="profile-header">

				<div class="row">
					<div class="col-sm-6 m-b-20">
						<img alt="Logo" class="inv-logo img-fluid" src="/assets/img/logo.png ">
					</div>
					<div class="col-sm-6 m-b-20"> 
						<h4 class="text-info"><strong>CLIENT : </strong>{{$intervention->client->name}}</h4>
							<h5 class="text-black text-uppercase">Equipmement : {{$intervention->equipement->modele .'-'.$intervention->equipement->numserie}}</h5>
							<h5 class="text-muted">Sous équipement :
										@if($intervention->sousequipement)
										{{$intervention->sousequipement->designation}}@endif
							</h5>
				</div>

					<div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
						<h6><strong>Détail</strong></h6>
						<ul class="list-unstyled mb-0">
							<li><h6 class="mb-0"><strong>Etat global : {{ $intervention->etat_final_global }}</strong></h6></li>	
							<li>
								<h6 class="text-muted">Date de clôture: {{$intervention->date_fin_global}}
									</h6>
							</li>
							
							</li>       
						</ul>
					</div>
				</div>

		<div class="tab-content profile-tab-cont">

			<!-- Aperçu intervention Tab -->
			<div class="tab-pane fade show active" id="per_details_tab">

				<!-- Aperçu intervention -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title d-flex justify-content-between">
									<span class="badge rounded-pill bg-info text-light">APERÇU</span>
                                    
									<a class="edit-link" href="/interventions/{{ $intervention->id }}/edit"><i class="fa fa-edit mr-1"></i>Modifier</a>
                                  
                                    <a class="edit-link" data-toggle="modal" href="#ajout_sousintervention"><i class="fa fa-edit mr-1"></i>Ajouter sous-intervention</a>
									<a class="edit-link" data-toggle="modal" href="#ajout_piece"><i class="fa fa-edit mr-1"></i>Ajouter pièce</a>
									<span class="label label-primary"></span>

								</h4>


                                <div class="row">
									<p class="col-sm-E text-muted text-sm-right mv-0 mb-sm-2">Équipement avant visite :</p>
									<p class="col-sm-9">{{$intervention->etat_initial}}</p>
								</div>

								<div class="row">
									<p class="col-sm-E text-muted text-sm-right mb-0 mb-sm-2">Description de la Panne :</p>
									<p class="col-sm-9">{{$intervention->description_panne}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Etat intervention :</p>
									<p class="col-sm-9">{{$intervention->etat}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-E text-muted text-sm-right mv-0 mb-sm-2">Heure/Date d'appel client :</p>
									<p class="col-sm-9">{{$intervention->appel_client}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Mode d'appel client :</p>
									<p class="col-sm-15">{{$intervention->mode_appel}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Priorité :</p>
									<p class="col-sm-15">	{{$intervention->priorite}}</p>
								</div>

								<div class="row">
									<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Intervenant(s) : </p>
									<p class="col-sm-15">
                                        @if (is_array($intervention->destinateur))
                                        {{
                                           implode(', ', $intervention->destinateur)
                                         }}
                                        @endif
                                    </p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Sous-traitant :</p>
                                    @if($intervention->soustraitant)
                                    <p class="col-sm-15">{{$intervention->soustraitant->name}}@endif</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Date/Heure de début :</p>
									<p class="col-sm-15">{{$intervention->date_debut}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">Date/Heure de fin :</p>
									<p class="col-sm-15">{{$intervention->date_fin}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-E text-muted text-sm-right mv-0 mb-sm-2">Description intervention :</p>
									<p class="col-sm-9">{{$intervention->description_intervention}}</p>
								</div>

                                <div class="row">
									<p class="col-sm-E text-muted text-sm-right mv-0 mb-sm-2">Équipement après visite :</p>
									<p class="col-sm-9">	{{$intervention->etat_final}}</p>
								</div>



							</div>
    
						<!-- Ajout sous intervention -->
						<div class="modal fade" id="ajout_sousintervention" aria-hidden="true" role="dialog">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Ajouter une sous-intervention</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="post" enctype="multipart/form-data" action="{{ route('sousinterventions.store', ['intervention_id' => $intervention->id]) }}">
										@csrf
											<div class="row form-row">
												<div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date/Heure début <span class="text-danger">*</span></label>
             											<input type="datetime-local" name="date_debut" class="form-control">
                                                    </div>
												</div>
												<div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date/Heure fin <span class="text-danger">*</span></label>
             											<input type="datetime-local" name="date_fin" class="form-control">
                                                    </div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Equipement avant visite<span class="text-danger">*</span></label>
														<select  class="select2 form-select form-control" name="etat_initial">
															<option >Sélectionner l'etat initial</option>
															<option value="Fonctionnel">Fonctionnel</option>
															<option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
															<option value="Panne Intermittente">Panne Intermittente</option>
															<option value=" l'arrêt">A l'arrêt</option>

														</select>
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Intervenant(s)</label>
														<select  class="select2 form-select form-control" name="intervenant[]" multiple>
															<option >Sélectionner l'intervenant(s)</option>
															@foreach($users as $user)
																<option value="{{ $user->name }}">{{ $user->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Description</label>
														<input type="text" name="description_panne" class="form-control">
													</div>
												</div>
											<button type="submit" class="btn btn-primary btn-block">Valider</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- /Ajout sous-intervention -->
						</div>

						<!-- Ajout pièce remplacée-->
						<div class="modal fade" id="ajout_piece" aria-hidden="true" role="dialog">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Ajouter pièce remplacée</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form method="post" enctype="multipart/form-data" action="{{ route('pieces.store', ['intervention_id' => $intervention->id]) }}">
										@csrf
											<div class="row form-row">
												<div class="col-12">
                                                    <div class="form-group">
                                                    <label>Client<span class="text-danger">*</span></label>
														<select id="client" onchange="getEquipements(this.value)" class="select2 form-select form-control" name="client">
															<option value="Sélectionner un Client">Sélectionner un Client</option>
															@foreach ($clients as $client)
																<option value="{{ $client->id }}">{{ $client->name }}</option>
											   				@endforeach
														</select>
                                                    </div>
												</div>
												<div class="col-12">
                                                    <div class="form-group">
													<label for="equipement">Equipement<span class="text-danger">*</span></label>
														<select id="equipement" onchange="getSousequipements(this.value)" class="select2 form-select form-control" name="equipement">
															<option value="Sélectionner un equipement">Sélectionner un equipement</option>
														</select>
													</div>
												</div>
												<div class="col-12">
                                                    <div class="form-group">
													<label for="sousequipement">Sous-equipement<span class="text-danger">*</span></label>
														<select id="sousequipement" class="select2 form-select form-control" name="sousequipement">
															<option value="Sélectionner un equipement">Sélectionner un sous-equipement</option>
														</select>
													</div>
												</div>
												<div class="col-12">
                                                    <div class="form-group">
                                                        <label>Désignation<span class="text-danger">*</span></label>
             											<input type="text" name="designation" class="form-control" placeholder="Saisir la désignation">
                                                    </div>
												</div>
												<div class="col-12">
                                                    <div class="form-group">
                                                        <label>Référence/code<span class="text-danger">*</span></label>
             											<input type="text" name="reference" class="form-control" placeholder="Saisir la reference">
                                                    </div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Numéro de série</label>
														<input type="text" name="numserie" class="form-control" placeholder="Saisir le numéro de serie">
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Date de remplacement<span class="text-danger">*</span></label>
														<input type="date" name="date_remplacement" class="form-control" placeholder="Saisir la date de remplacement">
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Quantité</label>
														<input type="number" name="qte" class="form-control" placeholder="Saisir la quantité">
													</div>
												</div>
											<button type="submit" class="btn btn-primary btn-block">Valider</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- /Ajout pièce remplacée -->
						</div>


					<!-- index Sous interventions -->
                    @if($intervention->sousinterventions->isEmpty())
                        <div class="p-3 mb-2 bg-warning text-light">
                            <h6 class="text-center">Pas de sous intervention.</h6>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-uppercase"><span class="badge rounded-pill bg-info text-light">Historique des sous-interventions</span></h4>
									<div class="table-responsive">
										<table id="sousinterventions-table" class="table table-bordered">
											<thead>
                                                <tr class="text-uppercase">
                                                    <th>Date début</th>
                                                    <th>Etat initial</th>
                                                    <th>Intervenant(s)</th>
                                                    <th>Description</th>
                                                    <th>Etat final</th>
                                                    <th>Date fin</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($sousinterventions as $sousintervention)
                                                    <tr>
                                                    <td>{{date('d-m-Y h:m A', strtotime($sousintervention->date_debut))}}</td>
                                                    <td>{{$sousintervention->etat_initial}}</td>
                                                    <td>
                                                        @if (is_array($sousintervention->intervenant))
                                                        {{
                                                            implode(', ', $sousintervention->intervenant)
                                                        }}
                                                        @endif
                                                    </td>
                                                    <td>{{$sousintervention->description_panne}}</td>
                                                    <td>{{$sousintervention->etat_final}}</td>
                                                    <td>{{date('d-m-Y h:m A',strtotime($sousintervention->date_fin))}}</td>
                                                    <td>
                                                        <!-- Bouton "Edit" pour chaque sous-intervention -->
                                                        <a data-placement="top" title="Modifier" class='btn btn-info edit-link' data-toggle="modal" data-target="#edit_sousintervention_{{$sousintervention->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <!-- Bouton "Supprimer" pour chaque sous-intervention -->
                                                        <a data-toggle="tooltip" data-placement="top" title="Supprimer" class='btn btn-danger' route='interventions.destroy' onclick="return confirm('Voulez-vous vraiment supprimer la demande {{$sousintervention->id}} ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                    @endif

					<!-- /index Sous interventions -->

					<!-- index pièces de repmlacement-->
                    @if($intervention->pieces->isEmpty())
                        <div class="p-3 mb-2 bg-warning text-light">
                            <h6 class="text-center">Pas de pièces remplacées.</h6>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-uppercase"><span class="badge rounded-pill bg-info text-light">Pièces remplacées</span></h4>
									<div class="table-responsive">
										<table id="pieces-table" class="table table-bordered">
											<thead>
                                                <tr class="text-uppercase">
                                                    <th>Désignation</th>
                                                    <th>reférence</th>
                                                    <th>numéro de série</th>
                                                    <th>date de remplacement</th>
                                                    <th>quantité</th>
                                                    <th>Actions</th>
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
                                                    <td>
                                                        <!-- Bouton "Edit" pour chaque sous-intervention -->
														<a data-placement="top" title="Modifier" class='btn btn-info edit-link' data-toggle="modal" data-target="#edit_piece_{{$piece->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                    @endif

					<!-- /index pièces remplacées -->

					<!-- Edit Modal des sous-intervention -->
					@foreach($sousinterventions as $sousintervention)
					<div class="modal fade" id="edit_sousintervention_{{$sousintervention->id}}" aria-hidden="true" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Modifier sous-intervention</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

									<form method="post" enctype="multipart/form-data" action="{{route('sousinterventions.update',$sousintervention->id)}}">
										@csrf
										@method("PUT")
										<div class="col-12">
											<div class="form-group">
												<label>Date début<span class="text-danger">*</span></label>
												<input class="form-control" type="datetime-local" name="date_debut" value="{{$sousintervention->date_debut}}">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Date fin<span class="text-danger">*</span></label>
												<input class="form-control" type="datetime-local" name="date_fin" value="{{$sousintervention->date_fin}}">
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Equipement avant visite</label>
												<select  class="select2 form-select form-control" name="etat_initial">

													@if ( $sousintervention->etat_initial == "Fonctionnel")
													<option selected value='Fonctionnel'>Fonctionnel</option>
													<option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
													<option value="Panne Intermittente">Panne Intermittente</option>
													<option value="A l'arrêt">A l'arrêt</option>

													@elseif ($sousintervention->etat_initial == "Partiellement Fonctionnel")
													<option selected value='Partiellement Fonctionnel'>Partiellement Fonctionnel</option>
													<option value='Fonctionnel'>Fonctionnel</option>
													<option value="Panne Intermittente">Panne Intermittente</option>
													<option value="A l'arrêt">A l'arrêt</option>

													@elseif ($sousintervention->etat_initial == "Panne Intermittente")
													<option selected value='Panne Intermittente'>Panne Intermittente</option>
													<option value='Partiellement Fonctionnel'>Partiellement Fonctionnel</option>
													<option value='Fonctionnel'>Fonctionnel</option>
													<option value="A l'arrêt">A l'arrêt</option>

													@else
													<option selected value="A l'arrêt">A l'arrêt</option>
													<option value='Panne Intermittente'>Panne Intermittente</option>
													<option value='Partiellement Fonctionnel'>Partiellement Fonctionnel</option>
													<option value='Fonctionnel'>Fonctionnel</option>
													@endif
                                    			</select>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Intervenant(s)</label>
												<select  class="select2 form-select form-control" name="intervenant[]" multiple>
													<option >Sélectionner l'intervenant(s)</option>
													@foreach($users as $user)
														@if(in_array($user->name, $sousintervention->intervenant))
															<option selected value='{{ $user->name }}'>{{ $user->name }}</option>
														@else
															<option value='{{ $user->name }}'>{{ $user->name }}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Description</label>
												<input type="text" name="description_panne" class="form-control" value="{{$sousintervention->description_panne}}">
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Equipement après visite</label>
												<select  class="select2 form-select form-control" name="etat_initial">
                                                @if ( $sousintervention->etat_final == "Fonctionnel")
                                                    <option selected value="Fonctionnel">Fonctionnel</option>
                                                    <option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
                                                    <option value="Panne Intermittente">Panne Intermittente</option>
                                                    <option value="A l'arrêt">A l'arrêt</option>
										        @elseif ($sousintervention->etat_final == "Partiellement Fonctionnel")
                                                    <option selected value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
                                                    <option value="Fonctionnel">Fonctionnel</option>
                                                    <option value="Panne Intermittente">Panne Intermittente</option>
                                                    <option value="A l'arrêt">A l'arrêt</option>
										        @elseif ($sousintervention->etat_final == "Panne Intermittente")
                                                    <option selected value="Panne Intermittente">Panne Intermittente</option>
                                                    <option value="Fonctionnel">Fonctionnel</option>
                                                    <option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
                                                    <option value="A l'arrêt">A l'arrêt</option>
										        @elseif ($sousintervention->etat_final == "A l'arrêt")
                                                    <option selected value="A l'arrêt">A l'arrêt</option>
                                                    <option value="Fonctionnel">Fonctionnel</option>
                                                    <option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
                                                    <option value="Panne Intermittente">Panne Intermittente</option>
										        @else
                                                    <option> Sélectionner l'etat final de l'equipement</option>
                                                    <option value="Fonctionnel">Fonctionnel</option>
                                                    <option value="Partiellement Fonctionnel">Partiellement Fonctionnel</option>
                                                    <option value="Panne Intermittente">Panne Intermittente</option>
                                                    <option value="A l'arrêt">A l'arrêt</option>
										        @endif
												</select>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Description sous intervention</label>
												<input type="text" name="description_sousintervention" class="form-control" value="{{$sousintervention->description_sousintervention ?? old('description_sousintervention')}}">
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label>Rapport</label>
												<input type="file" class="form-control" name='rapport' value="{{$sousintervention->rapport ?? old('rapport')}}">>
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-block">Modifier</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<!-- /Edit Modal des sous-intervention -->
            </div>

			<!-- Edit Modal pièce remplacée-->
			@foreach($pieces as $spiece)
			<div class="modal fade" id="edit_piece_{{$piece->id}}" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier pièce remplacée</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<form method="post" enctype="multipart/form-data" action="{{route('pieces.update',$piece->id)}}">
								@csrf
								@method("PUT")
								<div class="col-12">
									<div class="form-group">
										<label>Désignation<span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="designation" value="{{$piece->designation}}">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Référence/code<span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="reference" value="{{$piece->reference}}">
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Numéro de série</label>
										<input class="form-control" type="text" name="numserie" value="{{$piece->numserie}}">
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Date de remplacement</label>
										<input class="form-control" type="date" name="date_remplacement" value="{{$piece->date_remplacement}}">			
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Quantité</label>
										<input type="number" name="qte" class="form-control" value="{{$piece->qte ?? old('qte')}}">
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-block">Modifier</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<!-- /Edit Modal des sous-intervention -->
        </div>
    </div>

    @endsection
    @push('page-js')
	
        <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('#sousinterventions-table').DataTable();
				$('#pieces-table').DataTable();
            }); 
        </script>
		<script>
			function getEquipements(clientId) {
				fetch('/getEquipements?client_id=' + clientId)
					.then(response => response.json())
					.then(data => {
						const equipementSelect = document.getElementById('equipement');
						equipementSelect.innerHTML = '<option value="">Selectionner Equipement</option>';
						data.forEach(equipement => {
							const option = document.createElement('option');
							option.value = equipement.id;
							option.text = equipement.modele + " - " + equipement.numserie;
							equipementSelect.appendChild(option);
						});
					})
					.catch(error => console.error('Error fetching equipements:', error));
			}
		</script>
		
		<script>
			function getSousequipements(equipementId) {
				fetch('/getSousequipements?equipement_id=' + equipementId)
					.then(response => response.json())
					.then(data => {
						const sousequipementSelect = document.getElementById('sousequipement');
						sousequipementSelect.innerHTML = '<option value="">Selectionner Sousequipement</option>';
						data.forEach(sousequipement => {
							const option = document.createElement('option');
							option.value = sousequipement.id;
							option.text = sousequipement.designation;
							sousequipementSelect.appendChild(option);
						});
					})
					.catch(error => console.error('Error fetching sousequipements:', error));
			}
		</script>
	
    @endpush
