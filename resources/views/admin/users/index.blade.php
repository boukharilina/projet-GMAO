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
	<h3 class="page-title">Gestion Utilisateurs</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Utilisateurs</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('users.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>

@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
                    <div class="Container Flipped">
                        <div class="Content">
					<table id="user-table" class="table table-bordered table-hover">
						<thead>
							<tr style="boder:1px solid black;" class="text-uppercase">
							    <th>Avatar</th>
								<th>Name</th>
								<th>Matricule</th>
								<th>Email</th>
								<th>Rôle</th>
								<th>Modalité</th>
								<th>Département</th>
								<th>Mobile</th>
								<th class="text-center action-btn">Actions</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Add a spinner/loader-->
                                <div id="spinner" class="spinner-border text-primary" role="status"
                                    style="display: none;
                                    position: absolute;
                                    inset-block-start: 50%;
                                    inset-inline-start: 50%;">
                                    <span class="sr-only">en cours...</span>
                                </div>

						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
		</div>
	</div>
</div>
@endsection

@push('page-js')
<script>
    // Show spinner when DataTable is processing
    $('#user-table').on('processing.dt', function(e, settings, processing) {
        $('#spinner-row').toggle(processing);
    });

    $(document).ready(function() {
        var table = $('#user-table').DataTable({
            processing: true, // Enable server-side processing if needed
            serverSide: false, // Adjust based on your server-side configuration
            ajax: "{{route('users.index')}}",
            columns: [
                {data: 'avatar', name: 'avatar', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'matricule', name: 'matricule'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'modalite', name: 'modalite'},
                {data: 'departement', name: 'departement'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

});
</script>
@endpush
