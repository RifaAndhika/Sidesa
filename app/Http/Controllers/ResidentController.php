<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;




class ResidentController extends Controller
{
   public function index()
        {
            $residents = Resident::whereHas('user', function ($query) {
                $query->where('status', 'approved');
            })->with('user')->paginate(5);

            return view('pages.resident.index', [
                'residents' => $residents,
            ]);
        }


    // public function create() {
    //     return view('pages.resident.create');

    // }

    // public function store(Request $request){

    //     $validatedData = $request->validate([
    //         'nik' => ['required','unique:residents', 'digits:16'],
    //         'name' => ['required',  'max:100'],
    //         'gender' => ['required', Rule::in(['male', 'female'])],
    //         'birth_date' => ['required', 'string'],
    //         'birth_place' => ['required', 'max:100'],
    //         'address' => ['required', 'max:800'],
    //         'religion' => ['nullable' , 'max:50'],
    //         'marital_status' => ['required' , Rule::in(['single' , 'married' , 'divorced' , 'widowed'])],
    //         'occupation' => ['nullable' , 'max:100'],
    //         'phone' => ['nullable' , 'max:15'],
    //         'status' => ['required' , Rule::in(['active' , 'moved' , 'deceased'])],
    //     ],[
    //         'nik.required' => 'NIK harus diisi',
    //         'nik.unique' => 'NIK sudah terdaftar',
    //         'nik.digits' => 'NIK harus terdiri dari 16 angka',
    //         'name.required' => 'Nama harus diisi',
    //         'gender.required' => 'Jenis kelamin harus diisi',
    //         'birth_date.required' => 'Tanggal lahir harus diisi',
    //         'birth_place.required' => 'Tempat lahir harus diisi',
    //         'address.required' => 'Alamat harus diisi',
    //         'marital_status.required' => 'Status perkawinan harus diisi',
    //         'status.required' => 'Status harus diisi',
    //     ]);


    //     Resident::create($validatedData);

    //     return redirect('/resident')->with('success' , 'Berhasil menambahkan data');
    // }

    // public function edit($id) {

    //     $resident= Resident::findOrFail($id);

    //     return view('pages.resident.edit' , [
    //         'resident' => $resident,
    //     ]);

    // }

    // public function update(Request $request, $id) {

    //     $validatedData = $request->validate([
    //         'nik' => ['required', 'digits:16'],
    //         'name' => ['required',  'max:100'],
    //         'gender' => ['required', Rule::in(['male', 'female'])],
    //         'birth_date' => ['required', 'string'],
    //         'birth_place' => ['required', 'max:100'],
    //         'address' => ['required', 'max:800'],
    //         'religion' => ['nullable' , 'max:50'],
    //         'marital_status' => ['required' , Rule::in(['single' , 'married' , 'divorced' , 'widowed'])],
    //         'occupation' => ['nullable' , 'max:100'],
    //         'phone' => ['nullable' , 'max:15'],
    //         'status' => ['required' , Rule::in(['active' , 'moved' , 'deceased'])],
    //     ]);

    //        // Cari data berdasarkan ID
    // $resident = Resident::findOrFail($id);

    // // Update data
    // $resident->update($validatedData);

    //     return redirect('/resident')->with('success' , 'Berhasil mengubah data');


    // }

    // public function destroy($id) {

    //     $resident = Resident::findOrFail($id);

    //     // Hapus data menggunakan metode delete()
    //     $resident->delete();


    //     return redirect('/resident')->with('success' , 'Berhasil Menghapus Data');

    // }
}
