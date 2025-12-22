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

        // si tiene una categoría padre
        if ($request->parent_id != '00') {
            $reglas['parent_id'] = 'exists:categories,id';
        }

        $mensajes = [
            'category_name.required' => 'Debes teclear el nombre de la nueva categoría.',
            'category_name.max' => 'El nombre de la nueva categoría es muy largo.',
            'parent_id.exists' => 'La categoría padre seleccionada no existe.',
        ];

        $request->validate($reglas, $mensajes);

        // para evitar ataques XSS, reemplaza < y > por -
        $request['category_name'] = str_replace(['<', '>'], '-', $request->category_name);
        $request['category_description'] = str_replace(['<', '>'], '-', $request->category_description);

        $nuevaCategoria = new Category;
        $nuevaCategoria->category_name = $request->category_name;
        $nuevaCategoria->category_description = $request->category_description;
        if ($request->parent_id != '00')
        {
            $nuevaCategoria->parent_id = $request->parent_id;
        }
        $nuevaCategoria->save();

        return view('categories.creada')
            ->with([
                'category' => $nuevaCategoria->category_name
            ]);
    }

    public function edit($id){

        // todas las categorias
        $categorias = Collection::hierarchy(Category::class, 'category_name', 'N', '&nbsp;', 4);

        // categoria actual y sus hijas
        $categoriaActualConHijas = Collection::hierarchy(Category::class, 'category_name', 'N', '&nbsp;', 4, $id);

        // las disponibles serán todas quitando la actual y las hijas
        $disponibles = $categorias->filter(function ($cat) use ($categoriaActualConHijas){
            if($categoriaActualConHijas->contains('id',$cat->id) === false ){
                return $cat;
            }
        });


        $idDisponibles = $disponibles->pluck('id')->toArray();
        $idDisponibles = implode(',',$idDisponibles);

        $categoriaEnEdicion = Category::find($id);

        return view('categories.editar')
            ->with([
                'categoriasDisponibles' => $disponibles,
                'actual' => $categoriaEnEdicion,
                'disponibles' => $idDisponibles
            ]);

    }

    public function update(Request $request)
    {
        $reglas = [
            'category_name' => 'required|max:255',
            'parent_id' => 'nullable|in:'.$request->idsDisponibles
        ];

        $mensajes = [
            'category_name.required' => 'Debes teclear el nombre de la nueva categoría.',
            'category_name.max' => 'El nombre de la nueva categoría es muy largo.',
            'parent_id.in' => 'La categoría padre seleccionada no está disponible.',
        ];

        $request->validate($reglas, $mensajes);

        $actualizacion = Category::find($request->id);
        $actualizacion->category_name = $request->category_name;
        $actualizacion->category_description = $request->category_description;
        $actualizacion->parent_id = $request->parent_id ?: null;
        $actualizacion->save();

        return redirect()->route('categories.list',['type' => 'N']);
    }

    public function previous_delete($id)
    {

        $category = Category::find($id);

        return view('categories.confirm_delete')
            ->with([
                'categoria' => $category,
                'id' => $id
            ]);

    }

    public function delete($id){

        $categoriasEliminar = Collection::hierarchy(Category::class,'category_name','N','',0, $id);

        $categoriasEliminar = $categoriasEliminar->map(function ($cat){
            $cat->delete();
            return $cat;
        });

        return view('categories.borradas')
            ->with([
                'eliminadas' => $categoriasEliminar,
                'id' => $id
            ]);
    }

}
