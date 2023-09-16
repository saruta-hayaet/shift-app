<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::all();
        $shifts = Shift::with(['employee', 'morningProject', 'afternoonProject'])->get();

        $startDate = Carbon::now()->startOfMonth(); // 月初を取得
        $endDate = $startDate->copy()->addWeek()->subDay(); // 月初から1週間後の日を取得

            // 月初から1週間の日付リストを作成
        $dates = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->copy();
        }


    return view('shift.index', compact('employees', 'shifts', 'dates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $projects = Project::all();

        $startDate = Carbon::now()->startOfMonth(); // 月初を取得
        $endDate = $startDate->copy()->addWeek()->subDay(); // 月初から1週間後の日を取得

            // 月初から1週間の日付リストを作成
        $dates = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->copy();
        }


        return view('shift.create', compact('employees','projects','dates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $startDate = Carbon::now()->startOfMonth();

        foreach ($request->input('morning_shift') as $employee_id => $shifts) {
            foreach ($shifts as $index => $morning_project_id) {
                $shift_date = $startDate->copy()->addDays($index);
                Shift::create([
                    'employee_id' => $employee_id,
                    'morning_project_id' => $morning_project_id,
                    'afternoon_project_id' => $request->input("afternoon_shift.{$employee_id}.{$index}"),
                    'shift_date' => $shift_date,
                ]);
            }
        }

        return redirect()->route('shift');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        $employees = Employee::all();
        $projects = Project::all();

        $shifts = Shift::with(['morningProject', 'afternoonProject', 'employee'])->get();

        $startDate = Carbon::now()->startOfMonth(); // 月初を取得
        $endDate = $startDate->copy()->addWeek()->subDay(); // 月初から1週間後の日を取得

            // 月初から1週間の日付リストを作成
        $dates = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->copy();
        }


        return view('shift.edit', compact('employees','projects','dates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        // $startDate = Carbon::now()->startOfMonth();
        // $shift = Shift::all();

        // foreach ($request->input('morning_shift') as $employee_id => $shifts) {
        //     foreach ($shifts as $index => $morning_project_id) {
        //         $shift_date = $startDate->copy()->addDays($index);
        //         $shift->morning_project_id = $morning_project_id;
        //         $shift->save();
        //         // update([
        //         //     'employee_id' => $employee_id,
        //         //     'morning_project_id' => $morning_project_id,
        //         //     'afternoon_project_id' => $request->input("afternoon_shift.{$employee_id}.{$index}"),
        //         //     'shift_date' => $shift_date,
        //         // ]);
        //     }
        // }

        // return redirect()->route('shift');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
