<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("employee.index", ["employee" => Employee::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("employee.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) :RedirectResponse
    {
        Employee::create([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name,
            'rfid' => $request->rfid,
        ]);

        return redirect("/employee");
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee) :View
    {
        return view("employee.edit", ["employee" => Employee::find($employee->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee) :RedirectResponse
    {
        $employee->update([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name,
            'rfid' => $request->rfid,
        ]);

        return redirect("/employee");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee) :RedirectResponse
    {
        $employee->delete();
        return redirect("/employee");
    }
}
