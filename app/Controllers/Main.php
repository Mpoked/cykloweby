<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Race;

class Main extends BaseController
{
    protected $race;

    public function __construct()
    {
        $this->race = new Race();
    }

    public function index()
    {
        // Počet záznamů na stránku

        // Načti závody s použitím paginace
        $data['races'] = $this->race->paginate(15);

        // Přidej pager do dat
        $data['pager'] = $this->race->pager;

        // Zobraz view
        echo view('index', $data);
    }

    public function info($id)
    {
        
        
    }
}
