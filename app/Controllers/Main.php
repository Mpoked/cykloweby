<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function __construct()
    {
        $this->typkomponent = new typkomponent();
        $this->komponent = new komponent();
    }

    public function index()
    {
        $index = $this->race->findAll();
        $data['race'] = $index;
        echo view("index", $data);
    }
}
