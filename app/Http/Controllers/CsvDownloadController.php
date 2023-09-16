<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvDownloadController extends Controller
{
    public function downloadCsv(Request $request)
    {

        $employeeNames = $request->input('csvemployeeNames'); // これは配列です
        $dates = $request->input('csvDate'); // これも配列です
        $projectName = $request->projectName;
        $safeProjectName = str_replace(['/', '\\', '"', ':', '*', '?', '<', '>', '|'], '_', $projectName); // これらの特殊文字を "_" に置き換える

        $csvData = [];

        foreach($dates as $index => $date) {
            $csvData[] = [
                'date' => $date,
                'employeeName' => $employeeNames[$index] ?? null // インデックスが存在しない可能性があるため、nullをデフォルト値として使用
            ];
        }

        $csvHeader = ['日付', '担当者'];

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $safeProjectName . '.csv"',
        ]);

        return $response;
    }
}
