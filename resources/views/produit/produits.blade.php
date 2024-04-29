<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des produits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    @foreach ($produits as $produit)
                        <div class="flex flex-row items-center">
                            <p class="font-semibold text-lg">{{ $produit->traduction()->produit }} -
                                <a class="font-normal text-base text-sky-700 underline"
                                    href="{{ route('produit', ['id' => $produit->id_produit]) }}">{{__('En savoir plus')}}</a>
                            </p>

                            <form method="get" action="{{ route('modificationProduit') }}">
                                @csrf
                                <button type="submit" name="id_produit" value="{{ $produit->id_produit }}"
                                    class="w-5 mx-2">
                                    <img src="{{ asset('img/edit-icon.png') }}" alt="Modifier un produit" />
                                </button>
                            </form>
                            <form method="post" action="{{ route('suppressionProduit') }}">
                                @csrf
                                <button type="submit" name="id_produit" value="{{ $produit->id_produit }}"
                                    class="w-5">
                                    <img type="image" src="{{ asset('img/delete-icon.png') }}"
                                        alt="Supprimer un produit" />
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
