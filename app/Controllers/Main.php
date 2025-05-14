<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Race;

class Main extends BaseController
{
    var $race;
    public function __construct()
    {
        $this->race = new race();
        
    }

    public function index()
    {
        $races = $this->race->findAll(); // Vrací pole objektů
        $data['races'] = $races;
    
        echo view("index", $data);
    }
}
