@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/chart.js/Chart.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Bonjour {{auth()->user()->name}}!</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item active">Tableau de Bord</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-primary border-primary">
                        <i class="fe fe-money"></i>
                    </span>
                    <div class="dash-count">
                        <h3 class="text-primary"  style="font-weight: 700;">{{$all_contrats}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                <a href='/contrats'>
                    <h6 class="text-primary" style="font-weight: 700;">Contrats de Maintenance</h6>
                </a>
                <a href='/contrats'style="color:#3498DB;">
                    <div class="card-footer-sm-40">
                        <span class="badge bg-primary-light">Voir plus &rarr;</span>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-success">
                        <i class="fe fe-credit-card"></i>
                    </span>
                    <div class="dash-count">
                        <h3 class="text-success" style="font-weight:600;">{{$all_clients}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-success" style="font-weight: 700;">Clients</h6>

                <a href='/clients' style="color:green;">
                    <div class="card-footer-sm-40">
                        <span class="badge bg-success-light">Voir plus &rarr;</span>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-danger border-danger">
                        <i class="fe fe-folder"></i>
                    </span>
                    <div class="dash-count">
                        <h3 class="text-danger"  style="font-weight: 700;">{{$all_equipements}}</h3>
                    </div>
                </div>

                <div class="dash-widget-info">
                    <a href="/equipements">
                        <h6 class="text-danger" style="font-weight: 700;">Equipements</h6>
                    </a>
                    <a href='/equipements' style="color:red;">
                        <div class="card-footer-sm-40">
                            <span class="badge bg-danger-light">Voir plus &rarr;</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-warning border-warning">
                        <i class="fe fe-users"></i>
                    </span>
                    <div class="dash-count">
                        <h3 class="text-warning"  style="font-weight: 700;">{{$users}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">

                    <h6 class="text-warning" style="font-weight: 700;">Personnel</h6>

                <a href='/users' style="color:white;">
                    <div class="card-footer-sm-40">
                        <span class="badge bg-warning-light">Voir plus &rarr;</span>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <!-- Calendrier -->
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title text-center">Maintenance Préventive</h4>
            </div>
           <div class="card-body">
            <iframe src="https://calendar.google.com/calendar/embed?src=7ff90f956b84596b59ca09b35085f02110487299c7002b895c1fced2d5db6a80%40group.calendar.google.com&ctz=Africa%2FTunis" style="border: 0" width="600" height="400" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
        <!-- /Calendrier -->
    </div>
    <div class="col-md-6">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Premier Pie Chart -->
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title text-center">Instances Interventions </h4>
                    </div>
                    <div class="card-body">
                        <div style="cursor: pointer;" onclick="window.location.href='/interventions';">
                            {!! $pieChart_interventions->render() !!}
                        </div>
                    </div>
                </div>
                <!-- /Premier Pie Chart -->
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <!-- Deuxième Pie Chart -->
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title text-center">Contrats de Maintenance</h4>
                    </div>
                    <div class="card-body">
                        <div style="cursor: pointer;" onclick="window.location.href='/contrats';">
                            {!! $pieChart_contrats->render() !!}
                        </div>
                    </div>
                </div>
                <!-- /Deuxième Pie Chart -->
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-md-12">
        <!-- Tableau -->
        <div class="card card-table p-3">
            <div class="card-header">
                <h4 class="card-title" style="text-transform: uppercase !important;">Instances - Interventions en Attente</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="intervention-table" class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr class="text-uppercase">
                                <th>Etat</th>
                                <th>Client</th>
                                <th>Equipement</th>
                                <th>Interveant(s)</th>
                                <th>Panne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contenu du tableau -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Tableau -->
    </div>
</div>
@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        var table = $('#intervention-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{route('interventions.unclosed')}}",
            columns: [
                {data: 'etat', name: 'etat',

                render: function(data, type, full, meta) {
                    return '<a href="/interventions/' + full.id + '">' + data + '</a>';
                }
                } ,
                {data: 'client', name: 'client'},
                {data: 'equipement', name: 'equipement'},
                {data: 'destinateur', name: 'destinateur'},
                {data: 'description_panne', name: 'description_panne'},

            ]
        });

    });
</script>
<!-- JavaScript pour initialiser le calendrier -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!! json_encode($calendarEvents) !!}, // Utilisez les événements passés depuis le contrôleur
            // Autres options de configuration du calendrier ici
        });
        calendar.render();
    });
</script>
<script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endpush
