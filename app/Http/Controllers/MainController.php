<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function list($type){

        $categorias = Collection::hierarchy(Category::class,'category_name',$type,'&nbsp;',4);

        return view('categories.listado')
            ->with([
                'categorias'=>$categorias,
                'type'=>$type
            ]);
    }

    public function create(){

        $categoriasActuales = Collection::hierarchy(Category::class, 'category_name', 'N', '&nbsp;', 4);

        return view('categories.nueva')
            ->with([
                'categorias'=>$categoriasActuales
            ]);
    }

    public function store(Request $request){
        
        $reglas = [
            'category_name' => 'required|max:255'
        ];
        if ($request->parent_id != '00') {
            $reglas['parent_id'] = 'exists:categories,id';
        }

        $mensajes = [
            'category_name.required' => 'Debes teclear el nombre de la nueva categoría.',
            'category_name.max' => 'El nombre de la nueva categoría es muy largo.',
            'parent_id.exists' => 'La categoría padre seleccionada no existe.',
        ];

        $request->validate($reglas, $mensajes);

        $request->category_name = str_replace(['<', '>'], '-', $request->category_name);
        $request->category_description = str_replace(['<', '>'], '-', $request->category_description);

        $nuevaCategoria = new Category;
        $nuevaCategoria->category_name = $request->category_name;
        $nuevaCategoria->category_description = $request->category_description;
        if ($request->parent_id != '00')
        {
            $nuevaCategoria->parent_id = $request->parent_id;
        }
        $nuevaCategoria->save();

        if ($request->parent_id == '00')
        {
            $nuevaCategoria->parent_id = $nuevaCategoria->id;
            $nuevaCategoria->save();
        }

        return view('categories.creada')
            ->with([
                'category' => $nuevaCategoria->category_name
            ]);
    }


}
