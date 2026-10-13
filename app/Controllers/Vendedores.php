<?php

namespace App\Controllers;

use App\Models\VendedorModel;

class Vendedores extends BaseController
{
    protected VendedorModel $vendedorModel;

    public function __construct()
    {
        $this->vendedorModel = new VendedorModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gestión de vendedores',
            'vendedores' => $this->vendedorModel
                ->orderBy('id', 'DESC')
                ->findAll()
        ];

        return view('vendedores/index', $data);
    }

    public function nuevo()
    {
        return view('vendedores/nuevo', [
            'titulo' => 'Registrar vendedor'
        ]);
    }

    public function guardar()
    {
        $reglas = [
            'nombre' => 'required|min_length[2]|max_length[100]',
            'apellido' => 'required|min_length[2]|max_length[100]',
            'email' => 'permit_empty|valid_email|max_length[150]|is_unique[vendedores.email]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()
                ->withInput()
                ->with('errores', $this->validator->getErrors());
        }

        $this->vendedorModel->insert([
            'nombre' => trim($this->request->getPost('nombre')),
            'apellido' => trim($this->request->getPost('apellido')),
            'email' => trim($this->request->getPost('email')) ?: null,
            'estado' => 1
        ]);

        return redirect()->to('/vendedores')
            ->with('mensaje', 'Vendedor registrado correctamente.');
    }
}