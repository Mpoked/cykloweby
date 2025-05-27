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
    $data = [
        'zavody' => $this->race_year->select('race_year.*, uci_tour_type.name, COUNT(stage.id) as pocet')
            ->join("uci_tour_type", "uci_tour_type.id = race_year.uci_tour", "left")
            ->join("stage", "race_year.id = stage.id_race_year", "left")
            ->where("id_race", $id)
            ->groupBy("race_year.id")
            ->findAll(),
        'id_zavodu' => $id
    ];
    
    echo view("info", $data);
}

public function stages($raceYearId)
{
    $stages = $this->stage->select('stage.*, uci_tour_type.name as parcour_type_text')
        ->join('uci_tour_type', 'uci_tour_type.id = stage.parcour_type', 'left')
        ->where('id_race_year', $raceYearId)
        ->orderBy('number', 'ASC')
        ->findAll();

    $data['stages'] = $stages;
    echo view("stages", $data);
}
public function pridej_rocnik_form($id_zavodu)
{
    $data = [
        'id_zavodu' => $id_zavodu,
        'kategorie' => $this->uci_tour_type->findAll()
    ];
    
    return view('pridej_rocnik', $data);
}

public function pridej_rocnik()
{
    $validace = \Config\Services::validation();
    $validace->setRules([
        'id_zavodu' => 'required|numeric',
        'real_name' => 'required|max_length[255]',
        'year' => 'required|numeric|min_length[4]|max_length[4]',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'country' => 'required|max_length[2]',
        'uci_tour' => 'required|numeric',
        'logo' => 'uploaded[logo]|max_size[logo,2048]|is_image[logo]'
    ]);

    if (!$validace->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validace->getErrors());
    }

    $logo = $this->request->getFile('logo');
    $noveJmeno = $logo->getRandomName();
    $logo->move(ROOTPATH . 'public/obrazky/logo', $noveJmeno);

    $data = [
        'id_race' => $this->request->getPost('id_zavodu'),
        'real_name' => $this->request->getPost('real_name'),
        'year' => $this->request->getPost('year'),
        'start_date' => $this->request->getPost('start_date'),
        'end_date' => $this->request->getPost('end_date'),
        'country' => strtolower($this->request->getPost('country')),
        'uci_tour' => $this->request->getPost('uci_tour'),
        'logo' => $noveJmeno
    ];

    $this->race_year->insert($data);

    return redirect()->to('/zavod/info/' . $this->request->getPost('id_zavodu'))
        ->with('zprava', 'Ročník byl úspěšně přidán');
}
}