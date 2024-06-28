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
        <iframe src="https://calendar.google.com/calendar/embed?src=7ff90f956b84596b59ca09b35085f02110487299c7002b895c1fced2d5db6a80%40group.calendar.google.com&ctz=Africa%2FTunis" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
</body>
@push('page-js')
@endpush
</html>
