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
	<h3 class="page-title">Gestion Sous-traitants</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Sous-traitants</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('soustraitants.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- Sous-traitants -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
                    <div class="Container Flipped">
                        <div class="Content">
					<table id="soustraitant-table" class="table table-bordered table-hover">
						<thead>
                            <tr class="text-uppercase">
								<th>Nom Sous-taitant</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Fax</th>
								<th>Adresse</th>

								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>
							{{-- @foreach ($Sous-traitants as $client)
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
		<!-- /Sous-traitants-->

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
    $(document).ready(function() {
        var table = $('#soustraitant-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{route('soustraitants.index')}}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'fax', name: 'fax'},
                {data: 'address', name: 'address'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush
