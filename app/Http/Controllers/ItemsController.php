<?php

namespace App\Http\Controllers;

use App\Interfaces\MELI\MELIItemsRepositoryInterface;
use App\Interfaces\MELI\MELIUserRepositoryInterface;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    protected $meliuserRepository;
    protected $meliItemsRepository;

    public function __construct(
        MELIUserRepositoryInterface $meliuserRepository,
        MELIItemsRepositoryInterface $meliItemsRepository
    ) {
        $this->meliuserRepository = $meliuserRepository;
        $this->meliItemsRepository = $meliItemsRepository;
    }

    public function index(Request $request)
    {
        $orders = $request->input('order');
        $filters = $request->input('filters', []);
        $limit = $request->input('limit', 5);
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        // dd(request()->all());

        if ($search) {
            $response = $this->meliuserRepository->getItems($sort = null, $filters = [],  $limit = 1, $offset = 0);
            $response->results = collect($search);
        } else {
            $response = $this->meliuserRepository->getItems($sort = $orders, $filters,  $limit = 5, $offset);
        }

        return view('items.index', compact('response', 'page', 'limit'));
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
        $response = $this->meliItemsRepository->getItem($id);

        if (empty($response)) {
            return redirect()->route('items.index')->with('error', 'Item not found');
        }

        return view('items.show', compact('response'));
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
