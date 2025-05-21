<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Race;
use App\Models\RaceYear;
use App\Models\Stage;
use App\Models\UciTourType;

class Main extends BaseController
{
    protected $race;
    protected $race_year;
    protected $stage;
    protected $uci_tour_type;

    public function __construct()
    {
        $this->race = new Race();
        $this->race_year = new RaceYear();
        $this->stage = new Stage();
        $this->uci_tour_type = new UciTourType();
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
        $zavody = $this->race_year->join("uci_tour_type", "uci_tour_type.id = race_year.uci_tour", "inner")->where("id_race", $id)->findAll();
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