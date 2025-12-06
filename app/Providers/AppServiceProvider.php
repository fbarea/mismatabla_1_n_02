<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Collection::macro('hierarchy', function ($model, $order_field, $order_type, $indent_sign, $indent_number, $main_item = 0) {

            // Obtenemos las categorias principales
            if ($main_item == 0) {
                $categorias = $model::whereNull('parent_id')
                    ->orderBy($order_field, 'asc')
                    ->orderBy('id', 'asc')
                    ->get();
            } else {
                $categorias = $model::where('id', $main_item)->get();
            }

            if ($categorias->count() > 0) {
                $nivel = 1;
                $categorias = $categorias->map(function($cat) use ($nivel) {
                    $cat->nivel = $nivel;
                    return $cat;
                });

                do {
                    $totalCatsPrevias = $categorias->count();
                    $ordenadas = new Collection;
                    $ordenadas = $categorias->map(function ($cat) use ($nivel, $model, $order_field) {
                        if ($cat->nivel < $nivel) {
                            return collect([$cat]);
                        }
                        $dependientes = $model::where('parent_id', '=', $cat->id)
                            ->whereColumn('id', '!=', 'parent_id')
                            ->orderBy($order_field)
                            ->get();
                        $dependientes = $dependientes->map(function($dep) use ($nivel) {
                            $dep->nivel = $nivel + 1;
                            return $dep;
                        });
                        $dependientes->prepend($cat);
                        return $dependientes;
                    });
                    $categorias = new Collection;
                    $ordenadas->map(function ($col) use($categorias) {
                        $col->map(function ($item) use($categorias) {
                            $categorias->push($item);
                        });
                    });
                    $nivel ++;
                    $totalAgregadas = $categorias->count() - $totalCatsPrevias;
                } while ($totalAgregadas > 0);

                if ($order_type == 'A') {
                    $categorias = $categorias->sortBy($order_field);
                } else {
                    $categorias = $categorias->map(function ($cat) use($indent_sign, $indent_number) {
                        $espaciado = str_repeat($indent_sign, ($cat->nivel - 1) * $indent_number);
                        $cat->category_name = $espaciado.$cat->category_name;
                        return $cat;
                    });
                }
            }
            return $categorias;

        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
