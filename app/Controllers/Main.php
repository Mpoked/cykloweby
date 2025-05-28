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
            'zavody' => $this->race_year->select('race_year.*, uci_tour_type.name, COUNT(*) as pocet')
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
        $stages = $this->stage->select('stage.*, cyklo_parcour_type.name as parcour_type_text')
            ->join('cyklo_parcour_type', 'cyklo_parcour_type.id = stage.parcour_type', 'left')
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
    // Validace vstupů bez `after_or_equal`
    $validace = $this->validate([
        'id_zavodu' => 'required|numeric',
        'real_name' => 'required|max_length[255]',
        'year' => 'required|numeric|min_length[4]|max_length[4]',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'country' => 'required|max_length[2]|alpha',
        'uci_tour' => 'required|numeric',
        'logo' => 'max_size[logo,2048]|is_image[logo]' // Logo je nepovinné
    ]);

    if (!$validace) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // Ruční kontrola, že end_date není před start_date
    $start = strtotime($this->request->getPost('start_date'));
    $end = strtotime($this->request->getPost('end_date'));

    if ($end < $start) {
        return redirect()->back()
            ->withInput()
            ->with('errors', ['end_date' => 'Datum konce musí být stejné nebo pozdější než datum začátku.']);
    }

    // Zpracování obrázku
    $logo = $this->request->getFile('logo');
    $noveJmeno = null;

    if ($logo && $logo->isValid() && !$logo->hasMoved()) {
        $noveJmeno = $logo->getRandomName();
        $logo->move(ROOTPATH . 'obrazky/logo', $noveJmeno);

        if (!$logo->hasMoved()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nepodařilo se uložit logo.');
        }
    }

    // Příprava dat
    $data = [
        'id_race' => $this->request->getPost('id_zavodu'),
        'real_name' => $this->request->getPost('real_name'),
        'year' => $this->request->getPost('year'),
        'start_date' => $this->request->getPost('start_date'),
        'end_date' => $this->request->getPost('end_date'),
        'country' => strtoupper($this->request->getPost('country')),
        'uci_tour' => $this->request->getPost('uci_tour'),
        'logo' => $noveJmeno
    ];

    try {
        $this->race_year->insert($data);
    } catch (\Exception $e) {
        if ($noveJmeno && file_exists(ROOTPATH . 'obrazky/logo/' . $noveJmeno)) {
            unlink(ROOTPATH . 'obrazky/logo/' . $noveJmeno);
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Chyba při ukládání do databáze: ' . $e->getMessage());
    }

    return redirect()->to('/zavod/info/' . $this->request->getPost('id_zavodu'))
        ->with('uspech', 'Ročník byl úspěšně přidán');
}
}