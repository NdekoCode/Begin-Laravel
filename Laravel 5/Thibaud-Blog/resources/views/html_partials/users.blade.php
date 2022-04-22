@extends('layout')
@section('content')
    @auth
        <section>

            <h2 class="title title-2">Tous les utilisateurs que vous suivez</h2>
                @forelse (auth()->user()->follow as $user)
                    <div>
                        <ul class="mt-5">
                            <li class="px-2 py-2 shadow hover:shadow border-b border mb-1"><a
                                    class="hover:underline font-bold text-blue-700 transition-all"
                                    href="/{{ $user['email'] }}">{{ $user['email'] }}</a></li>
                        </ul>
                    </div>
                @empty
                    <div class="alert alert-infos">Vous ne suivez aucun n'utilisateur pour le moment</div>

                @endforelse
        </section>
    @endauth
    <section>

        <h2 class="title title-2">Tous les utilisateurs</h2>
        @foreach ($users as $user)
            <div>
                <ul class="mt-5">
                    <li class="px-2 py-2 shadow hover:shadow border-b border mb-1"><a
                            class="hover:underline font-bold text-blue-700 transition-all"
                            href="/{{ $user['email'] }}">{{ $user['email'] }}</a></li>
                </ul>
            </div>
        @endforeach
    </section>
@endsection
