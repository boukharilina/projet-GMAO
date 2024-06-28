@extends('admin.layouts.app')

<x-assets.datatables />


@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Rapport Contrats</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Générer rapport des contrats</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="#generate_report" data-toggle="modal" class="btn btn-primary float-right mt-2">Générer rapport</a>
</div>
@endpush

@section('content')
    @isset($contrats)
    <div class="row">
        <div class="col-md-12">
            <!-- contrats reports-->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="contrat-table" class="datatable table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Equipement</th>
                                    <th>Date de début </th>
                                    <th>Date de fin</th>
                                    <th>Type contrat</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($contrats as $contrat)
                                <tr>
                                    <td>{{$contrat->client->name}}</td>
                                    <td>{{$contrat->equipement->modele}}</td>
                                    <td>{{date('d-m-Y', strtotime($contrat->date_debut))}}</td>
                                    <td>{{date('d-m-Y', strtotime($contrat->date_fin))}}</td>
                                    <td>{{$contrat->type_contrat}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /contrats Report -->
        </div>
    </div>
    @endisset


    <!-- Generate Modal -->
    <div class="modal fade" id="generate_report" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Générer Rapport</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('contrats.report')}}">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="row"> 
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>DE</label>
                                            <input type="date" name="from_date" class="form-control from_date">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>A</label>
                                            <input type="date" name="to_date" class="form-control to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block submit_report">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Generate Modal -->
@endsection


@push('page-js')
<script>
    $(document).ready(function(){
        $('#contrat-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'collection',
                text: 'Exporter',
                buttons: [
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    }
                ]
                }
            ]
        });
    });
</script>
@endpush
