<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Relaciones multinivel</a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <!-- Inicio -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
                </li>

                <!-- Dropdown Gestionar Categorías -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownShoppings" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownShoppings">
                        <li>
                            <a class="dropdown-item" href="{{ route('categories.list',['type'=>'N']) }}">Listado por niveles</a>
                            <a class="dropdown-item" href="{{ route('categories.list',['type'=>'A']) }}">Listado alfabético</a>
                            <a class="dropdown-item" href="#">Nueva categoría</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>