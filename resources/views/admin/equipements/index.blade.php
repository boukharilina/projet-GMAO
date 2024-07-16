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
    <h3 class="page-title">Gestion Equipements</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
        <li class="breadcrumb-item active">Equipements</li>
    </ul>
</div>
<div class="col-sm-5 col">
    <a href="{{route('equipements.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Recent Orders -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="Container Flipped">
                        <div class="Content">
                            <table id="equipement-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Code</th>
                                        <th>Designation</th>
                                        <th>Modèle</th>
                                        <th>Numéro Série</th>
                                        <th>Client</th>
                                        <th>Date Installation</th>
                                        <th>Software</th>
                                        <th class="action-btn">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Add a spinner/loader-->
                                    <tr id="spinner-row">
                                        <td colspan="8" class="text-center">
                                            <div id="spinner" class="spinner-border text-primary" role="status"
                                                style="display: none;">
                                                <span class="sr-only">en cours...</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    $('#equipement-table').on('processing.dt', function(e, settings, processing) {
        $('#spinner-row').toggle(processing);
    });

    $(document).ready(function() {
        var table = $('#equipement-table').DataTable({
            processing: true, // Enable server-side processing if needed
            serverSide: false, // Adjust based on your server-side configuration
            ajax: "{{ route('equipements.index') }}",

            columns: [
                { data: 'code', name: 'code' },
                { data: 'designation', name: 'designation' },
                { data: 'modele', name: 'modele' },
                { data: 'numserie', name: 'numserie' },
                { data: 'client', name: 'client' },
                {
                    data: 'date_installation',
                    name: 'date_installation',
                    render: function(data, type, row) {
                        if (data) {
                            const date = new Date(data);
                            return date.toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
                        }
                        return '';
                    }
                },
                { data: 'software', name: 'software' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
