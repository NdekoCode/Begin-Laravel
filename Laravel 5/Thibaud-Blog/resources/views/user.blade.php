@extends('layout')

@section('content')
    <div>
        <h2 class="text-sm flex items-center ">
            <p class="text-lg font-bold">{{ $user->email }}</p>
            {{-- Ce formulaire ne va s'afficher que si l'utilisateur est connecté --}}
            @auth
                @if (auth()->user()->id !== $user->id)
                    <form method="post" action="/follow/{{ $user->email }}">
                        {{ csrf_field() }}
                        {{-- Car le navigateur ne supporte pas les autres type de methode ('delete','patch') --}}
                        {{--  Si l'utilisateur connecté suit l'utilisateur de la page alors modifie la methode du formulaire  --}}
                        @if (auth()->user()->follows($user))
                            @method('delete')
                        @endif
                        <button type="submit" class="btn btn-primary">
                            {{-- Si l'utilisateur connecté suis l'utilisateur de la page --}}
                            @if (auth()->user()->follows($user))
                                Ne plus suivre
                            @else
                                Suivre +
                            @endif
                        </button>
                    </form>
                @endif
            @endauth
        </h2>
        @if (auth()->check() && auth()->user()->id === $user->id)
            <h4 class="title title-4">Entrer votre message</h4>
            <form action="/messages" method="post">
                @csrf

                <div class="form-container h-full w-full">
                    @if ($errors->has('auth_errors'))
                        <div class="alert alert-danger">{{ $errors->first('auth_errors') }}</div>
                    @endif
                    <div class="mb-3">
                        <textarea class="px-2 py-2 border rounded w-full focus:ring focus:ring-offset-2 transition-all outline-none {{ $errors->has('message') ? 'border-red-500' : '' }}"
                            name="message" id="message" placeholder="Qu'avez-vous à dire aujourd'hui ?"></textarea>
                        @if ($errors->has('message'))
                            <p class="font-thin text-red-500 mt-1 text-sm">

                                {{ $errors->first('message') }}</p>
                        @endif
                    </div>
                    <button class="border px-2 py-2 rounded bg-blue-700 text-white transition-all hover:bg-blue-800"
                        type="submit">Publier</button>

            </form>
        @endif


        <ul class="mt-5">

            @foreach ($messages as $k => $msg)
                <li class="px-2 py-2 shadow hover:shadow border-b border mb-1">
                    <small><em>{{ $msg->created_at }}</em></small><br /> {{ $msg->content }}
                </li>
            @endforeach
        </ul>

    </div>
@endsection
