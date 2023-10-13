@extends('adminlte::page')

@section('title', 'Event Analytic')

@section('content_header')
    <h1>Event Analytic</h1>
@stop

@section('content')

<div class="row">
    <div class="container col-12 col-sm-6">
        <h6 class="font-weight-bold">Most 5 active person</h6>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Event</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->attended_events }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container col-12 col-sm-6">
        <h6 class="font-weight-bold">Most 5 attended event</h6>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Event</th>
                    <th scope="col">Jumlah partisipan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topEvents as $event)
                <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->attendees }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div>

</div>

@stop

@section('css')
@stop

@section('js')
<script> 
</script>
@stop