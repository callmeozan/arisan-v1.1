<?php

namespace App\Controllers;
use App\Models\GrupModel;

class GrupController extends BaseController
{
    protected $grupModel;

    public function __construct()
    {
        $this->grupModel = new GrupModel();
    }

    public function index()
    {
        $data['title'] = 'Dashboard ArisanKuyy';
        $data['groups'] = $this->grupModel->findAll();
        return view('dashboard', $data);
    }
}
