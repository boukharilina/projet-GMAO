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
	<h3 class="page-title">Gestion Clients</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Clients</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('clients.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- clients -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
                    <div class="Container Flipped">
                        <div class="Content">
					<table id="client-table" class="table table-bordered table-hover">
						<thead>
                            <tr class="text-uppercase">
								<th>Nom Client/Raison Sociale</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Fax</th>

							    <th class="action-btn">Action</th>
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
							{{-- @foreach ($clients as $client)
							<tr>
								<td>
								{{$client->product}}
								</td>
								<td>{{$client->name}}</td>
								<td>{{$client->phone}}</td>
								<td>{{$client->email}}</td>
								<td>{{$client->address}}</td>
								<td>{{$client->company}}</td>
								<td>
									<div class="actions">
										<a class="btn btn-sm bg-success-light" href="{{route('edit-client',$client)}}">
											<i class="fe fe-pencil"></i> Edit
										</a>
										<a data-id="{{$client->id}}" href="javascript:void(0);" class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
											<i class="fe fe-trash"></i> Delete
										</a>
									</div>
								</td>
							</tr>
							@endforeach							 --}}
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
		</div>
		<!-- /clients-->

	</div>
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; 2024 <a href="/" target="_blank">STIET</a>.</p>
        </div>
    </footer>
</div>

@endsection

@push('page-js')
<script>
    // Show spinner when DataTable is processing
    $('#client-table').on('processing.dt', function(e, settings, processing) {
        $('#spinner-row').toggle(processing);
    });

    $(document).ready(function() {
        var table = $('#client-table').DataTable({
            processing: true, // Enable server-side processing if needed
            serverSide: false, // Adjust based on your server-side configuration
            ajax: "{{route('clients.index')}}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'fax', name: 'fax'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush
