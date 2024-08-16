<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::all();
        return view('admin.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tmp_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
        ]);

        Customer::create([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'tmp_lahir' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('customer.index')->with('success', 'Data customer berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tmp_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'tmp_lahir' => $request->tmp_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('customer.index')->with('success', 'Data customer berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Data customer berhasil dihapus');
    }
}
