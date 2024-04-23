@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Pièces remplacées</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Pièces remplacées</li>
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
					<table id="piece-table" class="table table-bordered table-hover">
						<thead>
                            <tr class="text-uppercase">
								<th>designation</th>
                                <th>reference</th>
								<th>numéro de serie</th>
								<th>date remplacement</th>
								<th>quantité</th>
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
    // Show spinner when DataTable is processing
    $('#piece-table').on('processing.dt', function(e, settings, processing) {
      if (processing) {
        $('#spinner').show();
        } else {
        $('#spinner').hide();
        }
    });

    $(document).ready(function() {
        var table = $('#piece-table').DataTable({
            processing: false,
            serverSide: false,
            ajax: "{{route('pieces.index')}}",
            columns: [
                {data: 'designation', name: 'designation'},
                {data: 'reference', name: 'reference'},
                {data: 'numserie', name: 'numserie'},
                {
                    data: 'date_remplacement',
                    name: 'date_remplacement',

                    render: function(data, type, row)
                    { if (data)

                    { const date = new Date(data);

                    return date.toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
                    }

                    return '';

                    }
                },
                {   data: 'date_fin',
                    name: 'date_fin',

                    render: function(data, type, row)
                    { if (data)

                        { const date = new Date(data);

                        return date.toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
                        }

                    return '';

                    }
                },
                {data: 'qte', name: 'qte'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush
