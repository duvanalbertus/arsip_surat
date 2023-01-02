<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



use Psy\Sudo;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request) {
            $surat = Surat::where('judul', 'like', '%' . $request->cari . '%')->get();
        } else {
            $surat = Surat::all();
        }

        return view('dashboard.index', compact('surat', 'request'));

        // return view('dashboard.index',  [
        //     'surat' => Surat::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $fileName = time() . '.' . $request->file->extension();


        $validateData = $request->validate([
            'no_surat' => 'required|unique:surats',
            'category_id' => 'required',
            'judul' => 'required|unique:surats',
            'pdf' => 'required|mimes:pdf|max:2048'
        ]);

        if ($request->file('pdf')) {
            $pdf = $request->file('pdf');
            $pdf_name = $pdf->getClientOriginalName();
            $validateData['pdf'] = $request->file('pdf')->storeAs('', $pdf_name);
            // $path['pdf'] = $request->file('pdf')->storeAs($destination_path, $pdf_name);
        }




        Surat::create($validateData);

        return redirect('/dashboard')->with('success', 'Berhasil Mengarsipkan Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surat = Surat::find($id);
        return view('dashboard.show', ['surat' => $surat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data dari database
        $surat = Surat::find($id);

        // Tampilkan form edit dengan menampilkan data yang akan diedit
        return view('dashboard.edit', ['surat' => $surat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'pdf' => 'required|mimes:pdf|max:2048',
        ];

        $validateData = $request->validate($rules);

        if ($request->file('pdf')) {
            if ($request->oldPdf) {
                Storage::delete($request->oldPdf);
            }
            $pdf = $request->file('pdf');
            $pdf_name = $pdf->getClientOriginalName();
            $validateData = $request->file('pdf')->storeAs('', $pdf_name);
        }

        // Update data di database
        Surat::where('id', $id)
            ->update([
                'pdf' => $validateData,
            ]);

        // Redirect ke halaman yang sesuai
        return back()->with('berhasil', 'Update Arsip Surat Berhasil silahkan Kembali untuk melihat Arsip Surat Baru anda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $dashboard = Surat::find($id);
        if ($dashboard->pdf) {
            Storage::delete($dashboard->pdf);
        }
        $dashboard->delete();
        return redirect('/dashboard')->with('success', 'Berhasil Menghapus data');
    }

    /**
     * download the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */

    // public function download($id)
    // {
    //     $downaload = Surat::find($id);
    // }
}
