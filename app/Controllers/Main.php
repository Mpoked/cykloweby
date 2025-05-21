<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Race;
use App\Models\RaceYear;
use App\Models\Stage;

class Main extends BaseController
{
    protected $race;
    protected $race_year;
    protected $stage;

    public function __construct()
    {
        $this->race = new Race();
        $this->race_year = new RaceYear();
        $this->stage = new Stage();
    }

    public function index()
    {
        // Počet záznamů na stránku
        $data['races'] = $this->race->paginate(15);
        $data['pager'] = $this->race->pager;

        echo view('index', $data);
    }

    public function info($id)
    {
        // Zobrazí ročníky daného závodu
        $zavody = $this->race_year->where("id_race", $id)->findAll();
        $data["zavody"] = $zavody;

        echo view("info", $data);
    }

    public function stages($raceYearId)
    {
        // Načti etapy podle ID ročníku závodu
        $stages = $this->stage
            ->where('id_race_year', $raceYearId)
            ->orderBy('number', 'ASC')
            ->findAll();

        $data['stages'] = $stages;

        echo view("stages", $data);
    }
}