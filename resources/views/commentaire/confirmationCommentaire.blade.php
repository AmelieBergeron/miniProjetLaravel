<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirmation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <h3 class="font-semibold text-lg">Merci pour votre {{ $choix }}</h3>
                    <p class="font-normal">S'il y a lieu, un agent vous appellera sous peu au numéro suivant : <span class="font-semibold">{{ $commentaire->telephone }}</span></p>
                    <p class="font-normal">De plus, un courriel de confirmation vous sera envoyé à l'adresse suivante : <span class="font-semibold">{{ Auth::user()->email }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
