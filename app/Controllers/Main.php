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
        $stages = $this->stage
            ->where('id_race_year', $raceYearId)
            ->orderBy('number', 'ASC')
            ->findAll();
    
        // Mapování ID na název typu etapy
        $typeMap = [
            1 => 'Rovina',
            2 => 'Kopce, dojezd rovina',
            3 => 'Kopce, dojezd do kopce',
            4 => 'Hory, dojezd rovina',
            5 => 'Hory, dojezd do kopce',
            6 => 'Neznámý'
        ];
    
        // Přidáme název typu k etapám
        foreach ($stages as &$stage) {
            $id = (int)$stage['parcour_type'];
            $stage['parcour_type_text'] = $typeMap[$id] ?? 'Neznámý';
        }
    
        $data['stages'] = $stages;
    
        echo view("stages", $data);
}
}