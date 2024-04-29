<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des catégories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    @foreach ($categories as $categorie)
                    <div>
                    <p class="font-semibold text-lg">Catégorie - {{ $categorie->traduction()->categorie }} </p>
                    <p> <strong>Description : </strong> {{ $categorie->traduction()->description }}</p>
                    <a class="font-normal text-base text-sky-700 underline" href="{{
                    route('produitsCategorie', ['id' => $categorie->id_categorie]) }}">Voir le(s) produit(s) de cette catégorie</a></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
