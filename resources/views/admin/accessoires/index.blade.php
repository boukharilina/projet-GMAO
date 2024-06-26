@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Gestion Accessoires</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Accessoires</li>
	</ul>
</div>

@endpush

@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- Recent Orders -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="accessoire-table" class="datatable table table-hover table-center mb-0">
						<thead>
							<tr>

								<th>Designation</th>
								<th>Quantité</th>
								<th>Description</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>

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
<script>
    $(document).ready(function() {
        var table = $('#accessoire-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('accessoires.index')}}",
            columns: [
                {data: 'designation', name: 'designation'},
                {data: 'quantite', name: 'quantite'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

    });
</script>
@endpush
