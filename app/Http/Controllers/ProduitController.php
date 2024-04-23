<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProduitResource;
use Illuminate\Database\QueryException;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('produit/produits', [
            // D’autres paramètres peuvent être passés à la vue en les séparant par une virgule.
            'produits' => Produit::All()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->routeIs('insertionProduitApi')) {
            $validation = Validator::make($request->all(), [
                'id_categorie' => 'required|regex:/^[1-9]\d*$/',
                'produit' => 'required',
                'description' => 'required|max:250',
                'prix' => 'required|regex:/^\d+\.\d\d$/'
            ], [
                'id_categorie.required' => 'Veuillez entrer l\'identifiant de la catégorie.',
                'id_categorie.regex' => 'L\'identifiant de la catégorie doit être un nombre supérieur à 0.',
                'produit.required' => 'Veuillez entrer un nom pour le produit.',
                'description.required' => 'Veuillez inscrire une description pour le produit.',
                'description.max' => 'Votre description de produit ne peut pas dépasser 250 caractères.',
                'prix.required' => 'Veuillez inscrire un prix pour le produit.',
                'prix.regex' => 'Le prix doit être un montant valide avec un point comme délimitateur.'
            ]);
            if ($validation->fails()) {
                // On répond à la requête de Postman en plaçant toutes les erreurs qui ont pu survenir dans
                // un conteneur JSON avec un code HTTP 400.
                return response()->json(['ERREUR' => $validation->errors()], 400);
            }
            $contenuDecode = $validation->validated();
            // Rendu ici, les données ont été validées et décodées dans le tableau associatif $contenuDecode.
            // Il faut alors procéder à l’insertion du produit en BD.

            try {
                Produit::create([
                    'id_categorie' => $contenuDecode['id_categorie'],
                    'produit' => $contenuDecode['produit'],
                    'description' => $contenuDecode['description'],
                    'prix' => $contenuDecode['prix']
                ]);
            } catch (QueryException $erreur) {
                report($erreur);
                return response()->json(['ERREUR' => 'Le produit n\'a pas été ajouté.'], 500);
            }

            return response()->json(['SUCCÈS' => 'Le produit a bien été ajouté.'], 200);
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request, int $id)
    {
        if ($request->routeIs('produit')) {
            $produit = Produit::find($id);
            //$produit = Produit::findOrFail($idProduit);   //finorfail fait automatiquement le if + abort(404)

            if (is_null($produit))
                return abort(404); // Redirige automatiquement vers la page "404 – Not found".

            return view('produit/produit', [
                'produit' => $produit
            ]);
        } else if ($request->routeIs('produitsCategorie')) {

            $produits = Produit::where('id_categorie', $id)->get();

            if (empty($produits))
                return abort(404);  //si le array est vide #MARCHE PAS


            return view('produit/produitsCategorie', [
                //'produits' => Produit::all()->where('id_categorie', $id)
                //'produits' => $prods
                'produits' =>  $produits
            ]);
        } else if ($request->routeIs('produitApi')) {
            $produit = Produit::find($id);
            if (empty($produit))
                return response()->json(['ERREUR' => 'Le produit demandé est introuvable.'], 400);
            return new ProduitResource($produit);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->input('id_produit');

        $produit = Produit::find($id);
        //$produit = Produit::find($id);

        return view('produit/formulaireProduit', [
            'produit' => $produit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //echo 'CommentaireController > store() :)';

        $validation = Validator::make($request->all(), [
            'produit' => 'required',
            'description' => 'required',
            'prix' => 'required|regex:/^[\d.^][^,]+$/',
        ], [
            'produit.required' => 'Veuillez entrer le nom du produit.',
            'description.required' => 'Veuillez entrer la description du produit.',
            'prix.required' => 'Veuillez entrer le prix du produit.',
            'prix.regex' => 'Le prix doit être constitué uniquement de nombres, avec un point (.) pour les décimales.'
        ]);

        if ($validation->fails())
            return back()->withErrors($validation->errors())->withInput();

        $contenuFormulaire = $validation->validated();

        $produit = Produit::find($id);

        $produit->produit = $contenuFormulaire['produit'];
        $produit->description = $contenuFormulaire['description'];
        $produit->prix = $contenuFormulaire['prix'];

        if ($produit->save())
            session()->flash('succes', 'La modification du produit a bien fonctionné.');
        else
            session()->flash('erreur', 'La modification du produit n\'a pas fonctionné.');

        return redirect()->route('produits');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // On peut utiliser la méthode "input()" sur une requête pour récupérer une valeur, peu
        // importe si cette valeur a été transmise en GET ou en POST.
        $id = $request->input('id_produit');

        // La méthode "destroy()" du modèle Produit.php supprime le produit en BD possédant l’ID
        // fourni. Elle retourne "true" si la suppression a réussi ou "false" si elle a échoué.
        if (Produit::destroy($id))
            return back()->with('succes', 'La suppression du produit a bien fonctionné.');
        // La méthode "back()" permet de retourner sur la page précédente (soit la page des
        // produits) et la méthode « with() » permet d’inscrire dans la session PHP une clé
        // ("succes" ou "erreur" dans ce cas-ci) suivie d’un message personnalisé.
        return back()->with('erreur', 'La suppression du produit n\'a pas fonctionné.');
    }
}
