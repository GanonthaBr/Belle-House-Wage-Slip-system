<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class WageSlipController extends Controller
{
    public function list()
    {
        $wageslips = WageSlip::all();
        return view('list', ['wageslips' => $wageslips]);
    }
    public function create()
    {
        return view('form');
    }

    public function downloadPDF(Request $request, $id)
    {
        try {
            ini_set('max_execution_time', 10000);

            $wageslipData = WageSlip::find($id); // Assuming you have an WageSlip model
            if (!$wageslipData) {
                abort(404);
            }
            //get image path
            $imagePath = public_path('images/logo.png');
            $image = "data:image/png;base64," . base64_encode(file_get_contents($imagePath));

            $data = ['wageslip' => $wageslipData, 'image' => $image];
            $pdf = PDF::loadView('pdf.bulletin_salaire', $data);

            // Generate filename with employee name and date
            $employeeName = str_replace(' ', '_', $wageslipData->nom_employee);
            $date = Carbon::parse($wageslipData->date_de_paie)->format('Y_m_d');
            $period = $wageslipData->periode_de_paie;
            $filename = "Bulletin_de_salaire_{$employeeName}_{$period}.pdf";
            // dd(Carbon::now()->startOfMonth()->format('Y_m_d_H_i_s'));
            return $pdf->download($filename);
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->route('home')->with('error', 'Une erreur est survenue lors du telechargement');
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'matricule' => 'required',
                'salaire_de_base' => 'required',
                'heures_supplementaires' => 'nullable',
                'prime_de_salissure' => 'nullable',
                'prime_annuelle' => 'nullable',
                'avance_sur_salaire' => 'nullable',
                'assurance_maladie' => 'nullable',
                'assurance_accident_de_travail' => 'nullable',
                'nationalite' => 'nullable',
                'nom_employee' => 'nullable',
                'add_employee' => 'nullable',
                'periode_de_paie' => 'nullable',
                'date_de_paie' => 'nullable',
                'date_de_debut' => 'nullable',
                'date_de_fin' => 'nullable',
                'emploi' => 'nullable',
                'anciennete' => 'nullable',
                'taxe' => 'nullable',
                'employee_phone' => 'nullable',

            ]);
            // Fetch the last wage slip for this current employee
            $lastWageSlip = WageSlip::where('matricule', request('matricule'))->orderBy('date_de_fin', 'desc')->first();
            if ($lastWageSlip) {
                //calculate the new date based on the last wage slip
                $dateDeDebut = Carbon::parse($lastWageSlip->date_de_fin)->addDay();
                $dateDeFin = $dateDeDebut->copy()->endOfMonth();
                $periodeDePaie = $dateDeDebut->format('F Y');
                $dateDePaie = Carbon::now();
            } else {
                //set default date if no previous wage slip exists
                $dateDeDebut = Carbon::now()->startOfMonth();
                $dateDeFin = $dateDeDebut->copy()->endOfMonth();
                $periodeDePaie = $dateDeDebut->format('F Y');
                $dateDePaie = Carbon::now();
            }
            //set default value 0 for heures_supplementaires, prime_de_salissure, prime_annuelle, avance_sur_salaire, assurance_maladie, assurance_accident_de_travail
            $heures_supplementaires = request('heures_supplementaires') ?? 0;
            $prime_de_salissure = request('prime_de_salissure') ?? 0;
            $prime_annuelle = request('prime_annuelle') ?? 0;
            $avance_sur_salaire = request('avance_sur_salaire') ?? 0;
            $assurance_maladie = request('assurance_maladie') ?? 0;
            $assurance_accident_de_travail = request('assurance_accident_de_travail') ?? 0;

            // Set charges de Famille 
            $charges = request('assurance_accident_de_travail');
            if ($charges == 0) {
                $assurance_maladie = 0;
            } elseif ($charges == 1) {
                $assurance_maladie = 5;
            } elseif ($charges == 2) {
                $assurance_maladie = 10;
            } elseif ($charges == 3) {
                $assurance_maladie = 12;
            } elseif ($charges == 4) {
                $assurance_maladie = 13;
            } elseif ($charges == 5) {
                $assurance_maladie = 14;
            } elseif ($charges == 6) {
                $assurance_maladie = 15;
            } elseif ($charges == 7) {
                $assurance_maladie = 30;
            }
            //if $heures_supplementaires is less than 10, set it to 0
            if ($heures_supplementaires < 10) {
                $heures_supplementaires = 0;
            }
            // Set tax rate based on salary range
            $salaireDeBase = request('salaire_de_base');
            if ($salaireDeBase <= 25000) {
                $taxe = 1;
            } elseif ($salaireDeBase <= 50000) {
                $taxe = 2;
            } elseif ($salaireDeBase <= 100000) {
                $taxe = 6;
            } elseif ($salaireDeBase <= 150000) {
                $taxe = 13;
            } elseif ($salaireDeBase <= 300000) {
                $taxe = 25;
            } elseif ($salaireDeBase <= 400000) {
                $taxe = 30;
            } elseif ($salaireDeBase <= 700000) {
                $taxe = 32;
            } elseif ($salaireDeBase <= 1000000) {
                $taxe = 34;
            } else {
                $taxe = 35;
            }
            //create an item
            $wageslip = WageSlip::create([
                'matricule' => request('matricule'),
                'salaire_de_base' => request('salaire_de_base'),
                'heures_supplementaires' => $heures_supplementaires,
                'prime_de_salissure' => $prime_de_salissure,
                'prime_annuelle' => $prime_annuelle,
                'avance_sur_salaire' => $avance_sur_salaire,
                'assurance_maladie' => $assurance_maladie,
                'assurance_accident_de_travail' => $assurance_accident_de_travail,
                'nationalite' => request('nationalite'),
                'nom_employee' => request('nom_employee'),
                'add_employee' => request('add_employee'),
                'periode_de_paie' => $periodeDePaie,
                'date_de_paie' => $dateDePaie,
                'date_de_debut' => $dateDeDebut,
                'date_de_fin' => $dateDeFin,
                'emploi' => request('emploi'),
                'anciennete' => request('anciennete'),
                'taxe' => $taxe,
                'employee_phone' => request('employee_phone'),
            ]);
            return redirect()->route('wageslip-show', ['id' => $wageslip->id]);
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->route('home')->with('error', value: $e,);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'matricule' => 'required',
                'salaire_de_base' => 'required',
                'heures_supplementaires' => 'nullable',
                'prime_de_salissure' => 'nullable',
                'prime_annuelle' => 'nullable',
                'avance_sur_salaire' => 'nullable',
                'assurance_maladie' => 'nullable',
                'assurance_accident_de_travail' => 'nullable',
                'nationalite' => 'nullable',
                'nom_employee' => 'required | string',
                'add_employee' => 'nullable',
                'emploi' => 'nullable',
                'anciennete' => 'nullable',
                'taxe' => 'nullable',
                'employee_phone' => 'nullable',
            ]);
            // dd($request->all());
            // Fetch the last wage slip for this current employee
            $lastWageSlip = WageSlip::where('matricule', request('matricule'))->orderBy('date_de_fin', 'desc')->first();
            if ($lastWageSlip) {
                //calculate the new date based on the last wage slip
                $dateDeDebut = Carbon::parse($lastWageSlip->date_de_fin)->addDay();
                $dateDeFin = $dateDeDebut->copy()->endOfMonth();
                $periodeDePaie = $dateDeFin->format('F Y');
                $dateDePaie = Carbon::now();
            } else {
                //set default date if no previous wage slip exists
                $dateDeDebut = Carbon::now()->startOfMonth();
                $dateDeFin = $dateDeDebut->copy()->endOfMonth();
                $periodeDePaie = $dateDeDebut->format('F Y');
                $dateDePaie = Carbon::now();
            }
            //set default value 0 for heures_supplementaires, prime_de_salissure, prime_annuelle, avance_sur_salaire, assurance_maladie, assurance_accident_de_travail
            $heures_supplementaires = request('heures_supplementaires') ?? 0;
            $prime_de_salissure = request('prime_de_salissure') ?? 0;
            $prime_annuelle = request('prime_annuelle') ?? 0;
            $avance_sur_salaire = request('avance_sur_salaire') ?? 0;
            $assurance_maladie = request('assurance_maladie') ?? 0;
            $assurance_accident_de_travail = request('assurance_accident_de_travail') ?? 0;
            // Set charges de Famille 
            $charges = request('assurance_accident_de_travail');
            if ($charges == 0) {
                $assurance_maladie = 0;
            } elseif ($charges == 1) {
                $assurance_maladie = 5;
            } elseif ($charges == 2) {
                $assurance_maladie = 10;
            } elseif ($charges == 3) {
                $assurance_maladie = 12;
            } elseif ($charges == 4) {
                $assurance_maladie = 13;
            } elseif ($charges == 5) {
                $assurance_maladie = 14;
            } elseif ($charges == 6) {
                $assurance_maladie = 15;
            } elseif ($charges == 7) {
                $assurance_maladie = 30;
            }
            //if $heures_supplementaires is less than 10, set it to 0
            $heures_supplementaires = request('heures_supplementaires') ?? 0;
            if ($heures_supplementaires < 10) {
                $heures_supplementaires = 0;
            }
            // Set tax rate based on salary range
            $salaireDeBase = request('salaire_de_base');
            if ($salaireDeBase <= 25000) {
                $taxe = 1;
            } elseif ($salaireDeBase <= 50000) {
                $taxe = 2;
            } elseif ($salaireDeBase <= 100000) {
                $taxe = 6;
            } elseif ($salaireDeBase <= 150000) {
                $taxe = 13;
            } elseif ($salaireDeBase <= 300000) {
                $taxe = 25;
            } elseif ($salaireDeBase <= 400000) {
                $taxe = 30;
            } elseif ($salaireDeBase <= 700000) {
                $taxe = 32;
            } elseif ($salaireDeBase <= 1000000) {
                $taxe = 34;
            } else {
                $taxe = 35;
            }
            //update an item
            $wageslip = WageSlip::findOrFail($id);
            $wageslip->update([
                'matricule' => request('matricule'),
                'salaire_de_base' => request('salaire_de_base'),
                'heures_supplementaires' => request('heures_supplementaires'),
                'prime_de_salissure' => request('prime_de_salissure'),
                'prime_annuelle' => request('prime_annuelle'),
                'avance_sur_salaire' => request('avance_sur_salaire'),
                'assurance_maladie' => request('assurance_maladie'),
                'assurance_accident_de_travail' => request('assurance_accident_de_travail'),
                'nationalite' => request('nationalite'),
                'nom_employee' => request('nom_employee'),
                'add_employee' => request('add_employee'),
                'periode_de_paie' => $periodeDePaie,
                'date_de_paie' => $dateDePaie,
                'date_de_debut' => $dateDeDebut,
                'date_de_fin' => $dateDeFin,
                'emploi' => request('emploi'),
                'anciennete' => request('anciennete'),
                'taxe' => $taxe,
                'employee_phone' => request('employee_phone'),
            ]);
            return redirect()->route('list', ['id' => $wageslip->id])->with('message', 'Ce bulletin a ete mis a jour avec succes!',);
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->route('home')->with('error', 'Une erreur est survenue',);
        }
    }
    //edit
    public function edit($id)
    {
        $wageslip = WageSlip::find($id);
        if (!$wageslip) {
            abort(404);
        }
        return view('edit', compact('wageslip'));
    }
    public function show($id)
    {
        $wageslip = WageSlip::find($id);
        if (!$wageslip) {
            abort(404);
        }
        return view('details', compact('wageslip'));
    }
    //delete
    public function destroy($id)
    {
        $wageslip = WageSlip::find($id);
        if (!$wageslip) {
            abort(404);
        }
        $wageslip->delete();
        return redirect()->route('list')->with('message', "L'élément a été supprimé avec succès");
    }
}
