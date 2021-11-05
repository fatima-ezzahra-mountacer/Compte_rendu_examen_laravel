<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livres = Livre::all();
        return view("index", compact("livres"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            "book_name"     =>["required", "string","min:2","max:255","unique:livres,book_name"],
            "author_name"   =>["required", "string","min:2","max:255"],
            "opinion"       =>["string", "nullable"],
            "note"          =>["required","numeric", "integer","between:0,10"],
        ],
        [
            "book_name.required"       =>"Le nom  du livre est obligatoire",
            "book_name.string"         =>"Veuillez entrer une chaine de caractère",
            "book_name.min"            =>"Veuillez entrer au minimm 2 caractères",
            "book_name.max"            =>"Veuillez entrer au maximum 255 caractères",
            "book_name.unique"         =>"ce nom existe déja",

            "author_name.required"       =>"Le nom  de l'autheur est obligatoire",
            "author_name.string"         =>"Veuillez entrer une chaine de caractère",
            "author_name.min"            =>"Veuillez entrer au minimm 2 caractères",
            "author_name.max"            =>"Veuillez entrer au maximum 255 caractères",

            "opinion.string"             =>"Veuillez entrer une chaine de caractère ",

            "note.required"              =>"la note du livre est obligatoire",
            "note.numeric"               =>"Veuillez entrer un nombre",
            "note.integer"               =>"Veuillez entrer un entier",
            "note.between"               =>"Veuillez entrer une note comprise entre 0 et 10",      
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Livre::create([
            "book_name"     =>$request->book_name,
            "author_name"   =>$request->author_name,
            "opinion"       =>$request->opinion,
            "note"          =>$request->note
        ]);

        return redirect()->route('index')->with([
            "message"  =>$request->book_name . " a été ajouté à la liste",
            "color"   =>"success"
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livre = Livre::find($id);

        if(empty($livre))
        {
            return redirect()->route('index')->with([
                "message" => "ce Livre n'existe pas",
                "color"   =>"warning"
            ]);
        }

        return view("edit", compact('livre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livre = Livre::find($id);

        if(empty($livre))
        {
            return redirect()->route('index')->with([
                "message" => "ce Livre n'existe pas",
                "color"   =>"warning"
            ]);
        }

        $validator = Validator::make($request->all(),
        [
            "book_name"     =>["required", "string","min:2","max:255",Rule::unique('livres')->ignore($livre->id)],
            "author_name"   =>["required", "string","min:2","max:255"],
            "opinion"       =>["string", "nullable"],
            "note"          =>["required","numeric", "integer","between:0,10"],
        ],
        [
            "book_name.required"       =>"Le nom  du livre est obligatoire",
            "book_name.string"         =>"Veuillez entrer une chaine de caractère",
            "book_name.min"            =>"Veuillez entrer au minimm 2 caractères",
            "book_name.max"            =>"Veuillez entrer au maximum 255 caractères",
            "book_name.unique"         =>"ce nom existe déja",

            "author_name.required"       =>"Le nom  de l'autheur est obligatoire",
            "author_name.string"         =>"Veuillez entrer une chaine de caractère",
            "author_name.min"            =>"Veuillez entrer au minimm 2 caractères",
            "author_name.max"            =>"Veuillez entrer au maximum 255 caractères",

            "opinion.string"             =>"Veuillez entrer une chaine de caractère ",

            "note.required"              =>"la note du livre est obligatoire",
            "note.numeric"               =>"Veuillez entrer un nombre",
            "note.integer"               =>"Veuillez entrer un entier",
            "note.between"               =>"Veuillez entrer une note comprise entre 0 et 10",      
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $livre->update($request->all());

        return redirect()->route('index')->with([
            "message"  =>"Les informations de " . $request->book_name . " ont été modifiéé avec succès",
            "color"   =>"success"
        ]);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livre = Livre::find($id);

        if(empty($livre))
        {
            return redirect()->route('index')->with([
                "message" => "ce Livre n'existe pas",
                "color"   =>"warning"
            ]);
        }

        $livre->delete();

        return redirect()->route('index')->with([
            "message"  =>"Votre livre a été supprimé avec succès",
            "color"    =>"success"
        ]);


        
    }
}
