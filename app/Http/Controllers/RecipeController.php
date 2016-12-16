<?php

namespace App\Http\Controllers;

use App\Recipe;
use Auth;
use Request;
use Hashids;

class RecipeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $recipes = Recipe::whereUserId(Auth::user()->id)->get();
        return view('backend.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $recipe    = new Recipe;
        $formAction = action('RecipeController@store');
        return view("backend.recipes.form", compact('recipe', 'formAction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->saveData();
        return redirect("admin/recipes")->with('status', 'Registro guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {
    	$decode = Hashids::decode($id)[0];
        $recipe = Recipe::find($decode);

        $formAction = action('RecipeController@update', $id);
        return view("backend/recipes/form", compact('recipe', 'formAction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
    	$decode = Hashids::decode($id)[0];
        $this->saveData($decode);
        return redirect("admin/recipes/" . $id . "/edit")->with('status', 'Registro guardado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    	$decode = Hashids::decode($id)[0];
        $recipes = Recipe::findOrFail($decode);
        $recipes->delete();
        return redirect("admin/recipes")->with('status', 'Registro borrado correctamente');
    }

    /**
     * Save the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function saveData($id = null)
    {
        $recipes          = ($id) ? Recipe::find($id) : new Recipe;
        $recipes->name    = Request::get('name');
        $recipes->description = Request::get('description');
        $recipes->image    = Request::get('image');
        $recipes->duration    = Request::get('duration');
        $recipes->level    = Request::get('level');
        $recipes->user_id = Auth::user()->id;
        $recipes->save();
    }
}
