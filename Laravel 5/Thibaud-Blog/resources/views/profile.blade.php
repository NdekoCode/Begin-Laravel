@extends ('layout')

@section('content')
    <div class="mb-3">

        <h1 class="text-3xl font-bold mb-3">Mon compte</h1>
        <p class="flex items-center"><img src="storage/{{ auth()->user()->avatar }}" class="m-1 inline-block" width="150"
                alt=""><a class="link" href="/{{ auth()->user()->email }}">{{ auth()->user()->email }}</a></p>
    </div>
    {{-- Modifier le mot de passe --}}
    <h2 class="title title-2">Modifier votre mot de passe</h2>
    <form action="/updated-password" method="post" class="font-normal flex items-center justify-center w-1/2 ">
        @csrf

        <div class="form-container h-full w-full">
            @if ($errors->has('auth_errors'))
                <div class="alert alert-danger">{{ $errors->first('auth_errors') }}</div>
            @endif
            <div class="mb-3">
                <input
                    class="px-2 py-2 border rounded w-full focus:ring focus:ring-offset-2 transition-all outline-none {{ $errors->has('password') ? 'border-red-500' : '' }}"
                    type="password" name="password" id="password" placeholder="Nouveau Mot de passe">
                @if ($errors->has('password'))
                    <p class="font-thin text-red-500 mt-1 text-sm">

                        {{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <input
                    class="px-2 py-2 border rounded w-full focus:ring focus:ring-offset-2 transition-all outline-none {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}"
                    type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Mot de passe(Confirmation)">
                @if ($errors->has('password_confirmation'))
                    <p class="font-thin text-red-500 mt-1 text-sm">

                        {{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            <button class="border w-full mt-5 px-2 py-2 rounded-lg bg-blue-700 text-white transition-all hover:bg-blue-800"
                type="submit">Modifier le mot de passe</button>
    </form>
    <form action="/updated-avatar" method="post" class="font-normal flex items-center justify-center w-1/2 "
        enctype="multipart/form-data">
        @csrf

        <div class="form-container h-full w-full">
            @if ($errors->has('auth_errors'))
                <div class="alert alert-danger">{{ $errors->first('auth_errors') }}</div>
            @endif
            <div class="my-3 flex flex-wrap items-center w-full">
                <input
                    class="px-2 py-2 border rounded w-full basis-3/5 focus:ring focus:ring-offset-2 transition-all outline-none {{ $errors->has('avatar') ? 'border-red-500' : '' }}"
                    type="file" name="avatar" id="avatar" placeholder="Entrer votre avatar">
                @if ($errors->has('avatar'))
                    <p class="font-thin text-red-500 mt-1 text-sm">

                        {{ $errors->first('avatar') }}</p>
                @endif
                <button class="border w-full px-2 py-2 rounded-lg bg-blue-700 text-white transition-all hover:bg-blue-800"
                    type="submit">Modifier votre avatar</button>
            </div>
    </form>
@endsection
