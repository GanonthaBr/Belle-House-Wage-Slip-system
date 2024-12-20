<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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
            $date = \Carbon\Carbon::parse($wageslipData->date_de_paie)->format('Y_m_d');
            $filename = "Bulletin_de_salaire_{$employeeName}_{$date}.pdf";

            return $pdf->download($filename);
        } catch (\Throwable $e) {
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
            ]);

            //create an item
            $wageslip = WageSlip::create([
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
                'periode_de_paie' => request('periode_de_paie'),
                'date_de_paie' => request('date_de_paie'),
                'date_de_debut' => request('date_de_debut'),
                'date_de_fin' => request('date_de_fin'),
                'emploi' => request('emploi'),
                'anciennete' => request('anciennete'),
                'taxe' => request('taxe'),
            ]);
            return redirect()->route('show', ['id' => $wageslip->id]);
        } catch (\Throwable $e) {
            print($e);
            return redirect()->route('home')->with('error', 'Une erreur est survenue!',);
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
                'nom_employee' => 'nullable',
                'add_employee' => 'nullable',
                'periode_de_paie' => 'nullable',
                'date_de_paie' => 'nullable',
                'date_de_debut' => 'nullable',
                'date_de_fin' => 'nullable',
                'emploi' => 'nullable',
                'anciennete' => 'nullable',
                'taxe' => 'nullable',
            ]);
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
                'periode_de_paie' => request('periode_de_paie'),
                'date_de_paie' => request('date_de_paie'),
                'date_de_debut' => request('date_de_debut'),
                'date_de_fin' => request('date_de_fin'),
                'emploi' => request('emploi'),
                'anciennete' => request('anciennete'),
                'taxe' => request('taxe'),
            ]);
            return redirect()->route('show', ['id' => $wageslip->id])->with('message', 'Ce bulletin a ete mis a jour avec succes!',);
        } catch (\Throwable $e) {
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
