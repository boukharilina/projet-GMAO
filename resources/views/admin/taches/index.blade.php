@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
    
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
	
		<!-- Suppliers -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
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