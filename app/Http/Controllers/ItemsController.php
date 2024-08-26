<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\MELI\MELIUserRepositoryInterface;

class ItemsController extends Controller
{
    protected $meliuserRepository;

    public function __construct(MELIUserRepositoryInterface $meliuserRepository)
    {
        $this->meliuserRepository = $meliuserRepository;
    }

    public function index(Request $request)
    {
        $orders = $request->input('order');
        $filters = $request->input('filters', []);
        $search = $request->input('search');

        $response = $this->meliuserRepository->getItems($orders, $filters);

        // dd($response);

        return view('items.index', compact('response'));
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
