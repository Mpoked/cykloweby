<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Race;
use App\Models\RaceYear;

class Main extends BaseController
{
    protected $race;
    protected $race_year;

    public function __construct()
    {
        $this->race = new Race();
        $this->race_year = new RaceYear();
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
        $zavody = $this->race_year->where("id_race", $id)->findAll();
        $data["zavody"] = $zavody;

        echo view("Info", $data);
        
        
    }
}
