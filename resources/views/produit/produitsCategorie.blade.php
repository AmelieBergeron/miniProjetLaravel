<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les produits de la catégorie ' . $produits[0]->categorie->categorie ) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($produits as $produit)

                <div class="p-6 text-gray-900 space-y-4">
                    <h3 class="font-semibold text-lg">Produit - {{ $produit->traduction()->produit }}</h3>
                    <p class="font-normal"><span class="font-semibold">Catégorie :</span>
                        {{ $produit->categorie->traduction()->categorie }}</p>
                    <p class="font-normal"><span class="font-semibold">Description :</span>
                        {{ $produit->traduction()->description }}</p>
                    <p class="font-normal"><span class="font-semibold">Prix :</span>
                        {{ $produit->prix }} $</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
