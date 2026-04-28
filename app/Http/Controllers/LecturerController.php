<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    $lecturers = Lecturer::latest();
    $keyword  = request('keyword');
    if($keyword) {
        $lecturers->where('name', 'like', '%'. $keyword . '%');
    }

    $department_id  = request('department_id');
    if($department_id) {
        $lecturers->where('department_id', $department_id);
    }
    
        return view('lecturer.index', [
            'title' => 'Lecturer',
            'departments' => Department::latest()->get(),
            'lecturers' =>  $lecturers->Paginate(5)->withQueryString(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lecturer.create', [
            'title' => 'lecturer',
            'departments' => Department::latest()->get(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => 'required|max:255',
        'department_id' => 'required|exists:departments,id',

         ],[
            'name.required' => 'nama wajib di isi',
            'name.max' => 'nama tidak boleh lebih dari: max karakter',
            'department_id.required' => 'Program Studi tidak boleh kosong',
            'department_id.exists' => 'nim : Program Studi yang dipilih tidak ditemukan',
            
    ]);
  
    lecturer ::create($validated);
    return to_route('lecturer.index')->withSuccess('Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(lecturer $lecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lecturer $lecturer)
    {
        return view('lecturer.edit', [
            'title' => 'Edit Lecturer',
            'departments' => Department::latest()->get(),
            'lecturer' => $lecturer,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lecturer $lecturer)
    {
         $validated = $request->validate([
        'name' => 'required|max:255',
        'department_id' => 'required|exists:departments,id',

         ],[
            'name.required' => 'nama wajib di isi',
            'name.max' => 'nama tidak boleh lebih dari: max karakter',
            'department_id.required' => 'Program Studi tidak boleh kosong',
            'department_id.exists' => 'nim : Program Studi yang dipilih tidak ditemukan',
            
    ]);
  
    $lecturer->update($validated);
    return to_route('lecturer.index')->with('update', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lecturer $lecturer)
    {
         $lecturer->delete();
    return to_route('lecturer.index')->withSuccess('Data berhasil dihapus');
    }
}
