@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
<style>
    body {
        text-align: center;
    }

    .Container {
        width: 100%;
        overflow-y: auto;
        background-color: #fff;
        border-radius: 5px;
        margin: 0 auto;
        padding: 25px;
        min-height: 400px; /* Adjust as needed */
    }

    .Content {
        width: 100%;
        color: #000;
        text-align: center;
    }

    .Flipped,
    .Flipped .Content {
        transform: rotateX(180deg);
    }

    /* Designing for scroll-bar */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: gainsboro;
        border-radius: 5px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: rgb(149, 143, 143);
        border-radius: 5px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .page-title {
        text-align: left; /* Assurez-vous que le texte est aligné à gauche */
    }
</style>
@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Tâches supplémentaires</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de bord</a></li>
		<li class="breadcrumb-item active">Tâches supplémentaires</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('taches.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- taches -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
                    <div class="Container Flipped">
                        <div class="Content">
					<table id="tache-table" class="datatable table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Type tâche</th>
								<th>Technicien(s)</th>
								<th>Fournisseur/Client</th>
								<th>Date/Heure</th>
								<th>Commentaire</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
                </div>
            </div>
				</div>
			</div>
		</div>
		<!-- /taches-->

	</div>
</div>

@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        var table = $('#tache-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{route('taches.index')}}",
            columns: [
                {data: 'type', name: 'type'},
                {data: 'user', name: 'use'},
                {data: 'fournisseur', name: 'fournisseur'},
                {data: 'date', name: 'date'},
                {data: 'commentaire', name: 'commentaire'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush
