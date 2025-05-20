<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Decharge;

class DechargeController extends Controller
{
    //PDF
    public function dechargepdf($id)
    {
        try {
            ini_set('max_execution_time', 3000);
            $dechargeData = Decharge::find($id); // Assuming you have an Invoice model
            if (!$dechargeData) {
                abort(404);
            }
            //get image path
            $imagePath = public_path('images/logo.png');
            $image = "data:image/png;base64," . base64_encode(file_get_contents($imagePath));
            $data = ['decharge' => $dechargeData, 'image' => $image];
            $pdf = PDF::loadView('pdf.decharge', $data);
            $date = \Carbon\Carbon::parse($dechargeData->created_at)->format('Y_m_d');
            $name = str_replace(' ', '_', $dechargeData->client_name);
            $filename = "Decharge_{$name}_{$date}.pdf";
            return $pdf->download($filename);
        } catch (\Throwable $e) {
            // return redirect()->route('home')->with('error', $e->getMessage());
            return redirect()->route('home')->with('error', 'Une erreur est survenue');
        }
    }
    //store
    public function dechargestore(Request $request)
    {
        try {
            $request->validate([
                'name' => 'nullable',
                'client_name' => 'nullable',
                'amout_received' => 'nullable',
                'motif' => 'nullable',
                'number' => 'nullable',
            ]);
            $lastDechargeNumber = 0;
            //get the last added invoice and retrieve its number
            $lastdecharge = Decharge::latest()->first();

            if ($lastdecharge) {
                $lastDechargeNumber = $lastdecharge->number;
            } else {
                $lastDechargeNumber = 7;
            }
            // $lastDechargeNumber = $lastdecharge ? $lastdecharge->number : 0;
            $number = $lastDechargeNumber + 1;
            $decharge = Decharge::create([
                'name' => request('name'),
                'client_name' => request('client_name'),
                'amout_received' => request('amout_received'),
                'motif' => request('motif'),
                'number' => $number,
            ]);
            return redirect()->route('dechargeshow', ['id' => $decharge->id]);
            // return redirect()->route('decharge')->with('message', "L'élément a été ajouté avec succès");
        } catch (\Throwable $e) {
            return redirect()->route('home')->with('error', 'Une erreur est survenue',);
        }
    }
    //create
    public function createdecharge()
    {
        return view('dechargeform');
    }
    //show
    public function dechargeshow($id)
    {
        $decharge = Decharge::find($id);
        if (!$decharge) {
            abort(404);
        }
        return view('decharge', compact('decharge'));
    }
    //edit
    public function editdecharge($id)
    {
        $decharge = Decharge::find($id);
        if (!$decharge) {
            abort(404);
        }
        return view('editdecharge', compact('decharge'));
    }
    //update
    public function updatedecharge(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'nullable',
                'client_name' => 'nullable',
                'amout_received' => 'nullable',
                'motif' => 'nullable',
                'number' => 'nullable',
            ]);
            $decharge = Decharge::find($id);
            $decharge->update([
                'name' => request('name'),
                'client_name' => request('client_name'),
                'amout_received' => request('amout_received'),
                'motif' => request('motif'),
            ]);
            return redirect()->route('dechargeshow', ['id' => $decharge->id]);
        } catch (\Throwable $e) {
            return redirect()->route('home')->with('error', 'Une erreur est survenue',);
        }
    }
    // delete
    public function deletedecharge($id)
    {
        $decharge = Decharge::find($id);
        if (!$decharge) {
            abort(404);
        }
        $decharge->delete();
        return redirect()->route('home')->with('message', "L'élément a été supprimé avec succès");
    }
}
