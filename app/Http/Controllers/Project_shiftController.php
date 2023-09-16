<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Shift;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Project_shiftController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('project-shift.index', compact('projects'));
    }

    public function show(Request $request)
    {

        $projectId = $request->select;
        $selectedMonth = $request->month;

        $selectedMonth = request()->input('month'); // 例としてリクエストから月を取得
        $selectedMonth = preg_replace('/[^0-9]/', '', $selectedMonth);

        $year = 2023; // 2023年を例としています

        $startOfMonth = Carbon::create($year, $selectedMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $dates = [];

        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $datesWithDayNames[] = [
                'date' => $date->toDateString(),
                'dayName' => $date->dayName
            ];
        }



        $shifts = Shift::with(['morningProject', 'afternoonProject', 'employee'])
            ->whereMonth('shift_date', $selectedMonth)
            ->where(function ($query) use ($projectId) {
                $query->where('morning_project_id', $projectId)
                        ->orWhere('afternoon_project_id', $projectId);
            })
            ->get();

            foreach($shifts as $shift) {
                $morningProjectTitle = $shift->morningProject ? $shift->morningProject->title : null;
                $afternoonProjectTitle = $shift->afternoonProject ? $shift->afternoonProject->title : null;

                // ... ここで $morningProjectTitle と $afternoonProjectTitle を使用して処理 ...
            }


        $dataExists = !$shifts->isEmpty();

        $projectName = "";
        if($dataExists){
            $project = Project::find($projectId);
            $projectName = $project->title;
        }

        return view('project-shift.show', compact('shifts','projectId','dataExists','datesWithDayNames','projectName'));
    }
}
