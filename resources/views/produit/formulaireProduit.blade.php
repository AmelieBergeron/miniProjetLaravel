<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modification d\'un produit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <form id="modif_prod" method="post" action="{{ route('enregistrementProduit', ['id' => $produit->id_produit]) }}">
                        @csrf
                        <div class="to_grid">
                            <label for="demandeur">Produit </label>
                            <input type="text" name="produit" value="{{ $produit->produit }}">

                            <label for="telephone">Description </label>
                            <input type="tel" name="description" value="{{ $produit->description }}">

                            <label for="sujet">Prix </label>
                            <input type="text" name="prix" value="{{ $produit->prix }}">
                        </div>
                        <br>
                        <input type="hidden" name="id_produit" value="{{ $produit->id_produit }}" />
                        <button class="bouton">Modifier</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
