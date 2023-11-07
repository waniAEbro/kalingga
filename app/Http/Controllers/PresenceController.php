<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\EmployeeExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view("presence.index", ["employees" => Employee::all(), "request" => $request->all()]);
    }

    public function show(Employee $employee): View
    {
        return view("presence.show", ["employee" => $employee]);
    }

    public function employee_in(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $tag = implode("", $tag);

            $employee = Employee::where("rfid", $tag)->first();

            if ($employee) {
                $presence = Presence::where("tag", $tag)->whereDate("created_at", Carbon::today())->where("in", true)->first();
                if ($presence) {
                    return response()->json("ok", 200);
                } else {
                    $presence = Presence::create([
                        "employee_id" => $employee->id,
                        "in" => true,
                        "out" => false,
                        "tag" => $tag
                    ]);
                    return response()->json($presence, 200);
                }
            } else {
                return response()->json("not found", 404);
            }
        }
    }

    public function employee_out(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $tag = implode("", $tag);

            $employee = Employee::where("rfid", $tag)->first();

            if ($employee) {
                $presence = Presence::where("tag", $tag)->whereDate("created_at", Carbon::today())->where("in", true)->where("out", false)->first();
                if ($presence) {
                    $presence->update([
                        "out" => true
                    ]);
                    return response()->json($presence, 200);
                } else {
                    return response()->json("ok", 200);
                }
            } else {
                return response()->json("not found", 404);
            }
        }
    }

    public function print(Employee $employee, Request $request)
    {
        $bulan = Carbon::createFromFormat("Y-m", $request->bulan);
        $pdf = Pdf::loadView('presence.print', [
            "employee" => $employee,
            "bulan" => $request->bulan
        ]);

        return $pdf->stream('presensi.pdf');
    }

    public function export(Employee $employee)
    {
        $excel = app('excel');
        return $excel->download(new EmployeeExport($employee), 'users.xlsx');
    }
}
