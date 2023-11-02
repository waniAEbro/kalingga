<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("presence.index", ["presences" => Presence::all(), "employees" => Employee::all()]);
    }

    public function employee_in(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $presences = Presence::where("tag", $tag)->get();

            if ($presences->count() == 0) {
                return response()->json("ok", 200);
            } else {
                $employee = Employee::where("tag", $tag)->first();

                if ($employee) {
                    $presence = Presence::create([
                        "employee_id" => $tag,
                        "in" => true,
                        "out" => false,
                        "present" => 0,
                    ]);

                    Http::withHeaders([
                        'Content-Type' => 'application/json'
                    ])->withBasicAuth(env("VITE_ABLY_PUBLIC_KEY"), env("VITE_ABLY_SECRET_KEY"))
                        ->post('https://rest.ably.io/channels/channel-in/messages', [
                            'name' => 'publish',
                            'data' => [
                                "employee" => $employee->name,
                                "tag" => $tag
                            ]
                        ]);

                    return response()->json($presence, 200);
                } else {
                    return response()->json("not found", 404);
                }
            }
        }
    }

    public function employee_out(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $presences = Presence::where("tag", $tag)->get();

            if ($presences->count() == 0) {
                return response()->json("ok", 200);
            } else {
                $employee = Employee::where("tag", $tag)->first();

                if ($employee) {
                    $presence = Presence::create([
                        "employee_id" => $tag,
                        "in" => true,
                        "out" => false,
                        "present" => 0,
                    ]);

                    Http::withHeaders([
                        'Content-Type' => 'application/json'
                    ])->withBasicAuth(env("VITE_ABLY_PUBLIC_KEY"), env("VITE_ABLY_SECRET_KEY"))
                        ->post('https://rest.ably.io/channels/channel-in/messages', [
                            'name' => 'publish',
                            'data' => [
                                "employee" => $employee->name,
                                "tag" => $tag
                            ]
                        ]);

                    return response()->json($presence, 200);
                } else {
                    return response()->json("not found", 404);
                }
            }

        }
    }
}
