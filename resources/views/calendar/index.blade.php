<!-- resources/views/calendar/index.blade.php -->
@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')

@endpush

@push('page-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Preventive</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .calendar-container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
@endpush
<body>
    <div class="container calendar-container">
        <br>
        <h1>Maintenance Preventive</h1>
        <iframe src="https://calendar.google.com/calendar/embed?src=78d132901fa018a6b40d2d44fb4d7aa57af4e295c302ab6ae6b734dc02b5c2ab%40group.calendar.google.com&ctz=Africa%2FTunis" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
</body>
@push('page-js')
@endpush
</html>