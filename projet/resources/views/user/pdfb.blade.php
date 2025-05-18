@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Synthèse du PV #{{ $mahdar->id }}</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <h2>Détails du PV</h2>
        </div>
        <div class="card-body">
            <p><strong>Titre :</strong> {{ $mahdar->title }}</p>
            <p><strong>Créé par :</strong> {{ $mahdar->user->name }}</p>
            <p><strong>Date :</strong> {{ $mahdar->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Participants</h2>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($mahdar->participants as $participant)
                <li class="list-group-item">
                    {{ $participant->fullname }} - {{ $participant->role }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Besoins</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahdar->needs as $need)
                    <tr>
                        <td>{{ $need->number }}</td>
                        <td>{{ $need->description }}</td>
                        <td>{{ $need->quantity_required }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('mahdars.export-pdf', $mahdar) }}" 
       class="btn btn-primary">
        <i class="fas fa-file-pdf"></i> Exporter en PDF
    </a>
</div>
@endsection