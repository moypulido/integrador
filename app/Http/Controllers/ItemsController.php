<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\MELI\MELISitesRepositoryInterface;

class ItemsController extends Controller
{
    protected $meliSitesRepository;

    public function __construct(MELISitesRepositoryInterface $meliSitesRepository)
    {
        $this->meliSitesRepository = $meliSitesRepository;
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $filters = $request->input('filters', []);

        $response = $this->meliSitesRepository->getItemsbyUser();

        $response = $this->handleFiltersAndSorts($response);

        dd($response);

        return view('items.index', compact('response'));
    }

    private function handleFiltersAndSorts($response)
    {
        if (is_array($response->sort)) {
            $response->sort = (object) $response->sort;
        }

        if (is_array($response->filters)) {
            $response->filters = array_map(function ($filter) {
                return (object) $filter;
            }, $response->filters);
        }

        $response->available_sorts = array_merge([$response->sort], $response->available_sorts);
        $response->available_filters = array_merge($response->filters, $response->available_filters);

        return $response;
    }

    public function create()
    {
        // Código para mostrar el formulario de creación
    }

    public function store(Request $request)
    {
        // Código para almacenar un nuevo ítem
    }

    public function show($id)
    {
        // Código para mostrar un ítem específico
    }

    public function edit($id)
    {
        // Código para mostrar el formulario de edición
    }

    public function update(Request $request, $id)
    {
        // Código para actualizar un ítem específico
    }

    public function destroy($id)
    {
        // Código para eliminar un ítem específico
    }
}
