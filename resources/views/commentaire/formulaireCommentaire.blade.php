<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Question ou commentaire') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <h1 class="text-center">Posez votre question ou laissez un commentaire</h1>
                    <form method="post" action="{{ route('insertionCommentaire') }}">
                        @csrf
                        <div class="to_grid">
                            <label for="demandeur">Demandeur : </label>
                            <input disabled type="text" name="demandeur" value={{ Auth::user()->name }}>

                            <label for="telephone">Numéro de téléphone : </label>
                            <input type="tel" name="telephone">

                            <label for="sujet">Sujet : </label>
                            <input type="text" name="sujet">

                            <label for="produit">Produit concerné :</label>
                            <select id="produit" name="produit">
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id_produit }}">{{ $produit->produit }}</option>
                                @endforeach
                            </select>
                        </div>


                        <p>Type de message :</p>
                        <div id="type_message">
                            <input type="radio" id="question" name="choix" value="question">
                            <label for="choix">Question</label>
                            <input type="radio" id="commentaire" name="choix" value="commentaire">
                            <label for="choix">Commentaire</label>
                        </div>

                        <label for="message">Question/Commentaire : </label><br>
                        <textarea name="message" id="message"></textarea>

                        <br>
                        <input class="bouton" type="submit" value="Envoyer">


                    </form>
                    @if ($errors->any())
                        <div class="form_errors_div">
                            <p>Veuillez corriger l'erreur ou les erreurs suivante(s) :</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
