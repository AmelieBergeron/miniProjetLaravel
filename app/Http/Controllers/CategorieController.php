<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

use App\Http\Resources\CategorieResource;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->routeIs('categoriesApi')) {
            return CategorieResource::collection(Categorie::All());
        } else if ($request->routeIs('categories')) {
            return view('categorie/categories', [
                // D’autres paramètres peuvent être passés à la vue en les séparant par une virgule.
                'categories' => Categorie::All()
            ]);
        }
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
        if ($request->routeIs('insertionCategorieApi')) {
            $validation = Validator::make($request->all(), [
                'categorie' => 'required',
                'description' => 'required|max:250',
            ], [
                'categorie.required' => 'Veuillez entrer un nom pour la catégorie.',
                'description.required' => 'Veuillez inscrire une description pour la catégorie.',
                'description.max' => 'Votre description de catégorie ne peut pas dépasser 250 caractères.',
            ]);
            if ($validation->fails()) {
                // On répond à la requête de Postman en plaçant toutes les erreurs qui ont pu survenir dans
                // un conteneur JSON avec un code HTTP 400.
                return response()->json(['ERREUR' => $validation->errors()], 400);
            }
            $contenuDecode = $validation->validated();

            try {
                Categorie::create([
                    'categorie' => $contenuDecode['categorie'],
                    'description' => $contenuDecode['description'],
                ]);
            } catch (QueryException $erreur) {
                report($erreur);
                return response()->json(['ERREUR' => 'La catégorie n\'a pas été ajoutée.'], 500);
            }
            return response()->json(['SUCCÈS' => 'La catégorie a bien été ajoutée.'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
