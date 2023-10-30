<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("customers.index", ["customers" => Customer::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'code' => 'required',

        ], [
            'name.required' => 'Name tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'phone.required' => 'Nomor Telepon tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        Customer::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "code" => $request->code,
        ]);

        return redirect("/customers");
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): View
    {
        return view("customers.show", ["customers" => Customer::find($customer->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view("customers.edit", ["customers" => Customer::find($customer->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'code' => 'required',

        ], [
            'name.required' => 'Name tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'phone.required' => 'Nomor Telepon tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        $customer->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "code" => $request->code,
        ]);

        return redirect("/customers");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect("/customers");
    }

    public function storeapi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'code' => 'required',

        ], [
            'name.required' => 'Name tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'phone.required' => 'Nomor Telepon tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        Customer::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "code" => $request->code,
        ]);

        return response()->json($request->all(), 200);
    }
}
