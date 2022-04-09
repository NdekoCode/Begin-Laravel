@extends('layout')
@section('content')

@foreach($users as $user)
<div>
    <ul>
        <li>{{ $user['email'] }}</li>
    </ul>
</div>
@endforeach

@endsection
