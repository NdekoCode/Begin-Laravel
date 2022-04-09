@extends('layout')
@section('content')
<div class="h-screen mt-5">
    <div class="flex items-center justify-center mt-6 h-4/5 rounded-xl overflow-hidden mx-20 shadow-lg w-4/5 mx-auto">
        <div class="h-full basis-1/2 w-1/2 p-3 flex flex-col justify-end text-gray-200" style="background: rgb(9,9,121);background: linear-gradient(90deg, rgba(47,92,191,.6)0%,rgba(9,9,121,0.7) 35% , rgba(11, 118, 139, 0.5) 100%) ,url({{ asset('img/femme.jpg') }}) center center / cover;">
            <div class="mb-5 px-3">
                <img src="{{ asset('img/login.svg') }}" width="150" class="-ml-5" alt="">
            <h2 class="text-5xl text-gray-200 mb-5 font-bold">Connectez-vous</h2>
            <p class="">Veuillez vous connecter pour acceder aux fonctionnalitées du site</p>
            </div>
        </div>
        
        <form action="" method="post" class="font-normal flex items-center flex-col justify-center w-1/2 ">
            {{ csrf_field() }}
            
            @if($errors->has('auth_errors'))
            <div class="bg-red-100 border border-red-300 rounded text-sm text-red-500 mb-3 px-2 py-3 w-4/5">{{ $errors->first('auth_errors') }}</div>
            @endif
            <div class="form-container h-full p-5 w-full px-14 py-3">
                <div class="mb-3">
                    <input type="email" name="email" id="email" class="px-2 py-2 border rounded w-full focus:ring focus:ring-offset-2 transition-all outline-none {{ $errors->has('email') ? 'border-red-500': '' }}" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                    <p class="font-thin text-red-500 mt-1 text-sm">
        
                        {{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="mb-3">
                    <input class="px-2 py-2 border rounded w-full focus:ring focus:ring-offset-2 transition-all outline-none {{ $errors->has('password') ? 'border-red-500': '' }}" type="password" name="password" id="password" placeholder="Mot de passe">
                    @if ($errors->has('password'))
                    <p class="font-thin text-red-500 mt-1 text-sm">
        
                        {{ $errors->first('password') }}</p>
                    @endif
                </div>
                
                <div class="mb-3">
                   <div class="flex justify-between">
                       <div class="px-3">
                        <input class="px-1 py-1 border rounded border-gray-300" type="checkbox" name="remember" id="password_confirmation" placeholder="Mot de passe(Confirmation)"> <span class="font-thin text-gray-400 text-sm">Se souvenir de moi</span>
                    </div>
                        <a href="#" class="font-thin text-blue-300 text-sm">Reinitialiser le mot de passe</a>
                   </d Se souvenir de moiiv>
                </div>
                <div class="font-thin text-sm text-gray-500">Vous n'avez pas encore de compte ? <a href="/signin" class="text-blue-300">Creer en un</a></div>
                <button class="border w-full mt-5 px-2 py-2 rounded-lg bg-blue-700 text-white transition-all hover:bg-blue-800" type="submit">Se connecter</button>
    
            </div>
        </form>
    </div>
</div>
@endsection
