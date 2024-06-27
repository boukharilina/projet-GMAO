<!DOCTYPE html>
<html>
<head>
    <title>Rapport Equipements de Démonstration</title>
    <style>
        table {
            inline-size: 100%;
            block-size: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-start: left;
        }
    </style>
</head>
<body>
    <h2>Rapport Equipements de Démonstration</h2>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Designation</th>
                <th>Modèle</th>
                <th>Marque</th>
                <th>Numéro Série</th>
                <th>Modalité</th>
                <th>Garantie</th>
                <th>Date entrée</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipementdemos as $equipementdemo)
                <tr>
                    <td>{{ $equipementdemo->code }}</td>
                    <td>{{ $equipementdemo->designation }}</td>
                    <td>{{ $equipementdemo->modele }}</td>
                    <td>{{ $equipementdemo->marque }}</td>
                    <td>{{ $equipementdemo->numserie }}</td>
                    <td>{{ $equipementdemo->modalite }}</td>
                    <td>{{ $equipementdemo->garantie }}</td>
                    <td>{{ $equipementdemo->date_entree }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
