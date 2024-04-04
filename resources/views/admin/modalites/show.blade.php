@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Gestion Modalités</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Modalité-Equipements</li>
	</ul>
</div>

@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
        <div class="profile-header">
			<div class="row align-items-center">

				<div class="col ml-md-n2 profile-user-info">
					<h4 class="user-name mb-0"><span class="badge rounded-pill bg-primary-light text-light">EQUIPEMENTS : {{$modalite->name}}</span></h4>
				</div>

			</div>
		</div>

		<!-- Recent Orders -->
		<div class="card">
			<div class="card-body">
				<div class="table-bordered">
					<table id="equipement-modalite-table" class="datatable table table-hover table-center mb-0">
						<thead>
							<tr class="text-uppercase">
                                <th>#</th>
								<th>Designation</th>
								<th>Modèle</th>
								<th>Numéro Série</th>
								<th>Date Installation</th>
                                <th>Software</th>
                                <th>Client</th>
                                <th>Action</th>

							</tr>
						</thead>
                        <tbody>
                            <?php $i=0; ?>
							@foreach ($equipements as $equipement)
                            @if(!empty($equipement->modalite))
                            <?php $i++; ?>
							<tr>
                                <td>{{ $i }}</td>
								<td>{{$equipement->designation}}</td>
								<td>{{$equipement->modele}}</td>
								<td>{{$equipement->numserie}}</td>
								<td>{{date('d-m-Y', strtotime($equipement->date_installation))}}</td>
								<td>{{$equipement->software}}</td>
                                <td>{{$equipement->client->name}}</td>
                                <td class="text-center">
                                    <a href="{{route('equipements.show', $equipement->id)}}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('equipements.edit', $equipement->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
							</tr>
                            @endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Recent Orders -->

	</div>
</div>
@endsection

@push('page-js')
<script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#equipement-modalite-table').DataTable();
    });
</script>
@endpush
