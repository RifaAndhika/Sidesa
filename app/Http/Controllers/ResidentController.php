<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::all();

        return view('pages.resident.index', [
            'residents' => $residents,
        ]);
    }


    public function create() {
        return view('pages.resident.create');
        
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'name' => ['required',  'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:800'],
            'religion' => ['nullable' , 'max:50'],
            'marital_status' => ['required' , Rule::in(['single' , 'married' , 'divorced' , 'widowed'])],
            'occupation' => ['nullable' , 'max:100'],
            'phone' => ['nullable' , 'max:15'],
            'status' => ['required' , Rule::in(['active' , 'moved' , 'deceased'])],
        ]);

        
        Resident::create($validatedData);

        return redirect('/resident')->with('success' , 'Berhasil menambahkan data');
    }

    public function edit($id) {

        $residents = Resident::findOrFail($id);
        
        return view('pages.resident.edit' , [
            'resident' => $residents,
        ]);
        
    }

    public function update(Request $request, $id) {

        $validated = $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'name' => ['required',  'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:800'],
            'religion' => ['nullable' , 'max:50'],
            'marital_status' => ['required' , Rule::in(['single' , 'married' , 'divorced' , 'widowed'])],
            'occupation' => ['nullable' , 'max:100'],
            'phone' => ['nullable' , 'max:15'],
            'status' => ['required' , Rule::in(['active' , 'moved' , 'deceased'])],
        ]);

        
        Resident::findOrFile($id)->update($request->validate());

        return redirect('/resident')->with('success' , 'Berhasil mengubah data');

        
    }

    public function destroy($id) {

        $residents = Resident::findOrFail($id);
        $residents->delete();
        
        return redirect('/resident')->with('success' , 'Berhasil Menghapus Data');
        
    }
}
