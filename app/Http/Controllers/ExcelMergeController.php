<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExcelMergeController extends Controller
{
    // Show the merge form
    public function index()
    {
        return view('excel_merge');
    }

    // Handle merging of two Excel files (stub)
    public function merge(Request $request)
    {
        $request->validate([
            'old_file' => 'required|file|mimes:xlsx,xls',
            'new_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $oldPath = $request->file('old_file')->getRealPath();
        $newPath = $request->file('new_file')->getRealPath();

        $oldSpreadsheet = IOFactory::load($oldPath);
        $newSpreadsheet = IOFactory::load($newPath);

        $oldSheet = $oldSpreadsheet->getActiveSheet();
        $newSheet = $newSpreadsheet->getActiveSheet();

        $mergedSpreadsheet = new Spreadsheet();
        $mergedSheet = $mergedSpreadsheet->getActiveSheet();
        $mergedSheet->setTitle('Master');

        // Collect old and new data
        $oldData = $oldSheet->toArray();
        $newData = $newSheet->toArray();

        // Write all old data (including header)
        $mergedSheet->fromArray($oldData, null, 'A1');
        $oldCount = count($oldData);
        // Write all new data (excluding header) after old data
        for ($i = 1; $i < count($newData); $i++) { // skip header
            $mergedSheet->fromArray([$newData[$i]], null, 'A' . ($oldCount + $i));
            // Highlight the appended row
            $colCount = count($newData[$i]);
            $colEnd = chr(ord('A') + $colCount - 1);
            $mergedSheet->getStyle("A" . ($oldCount + $i) . ":$colEnd" . ($oldCount + $i))
                ->getFill()->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFFFFF00'); // Yellow
        }


        // Add placeholder log sheet
        $logRows = [['Log', 'Details'], ['No changes logged']];
        $logSheet = $mergedSpreadsheet->createSheet();
        $logSheet->setTitle('Merged Log');
        $logSheet->fromArray($logRows, null, 'A1');

        // Save merged file
        $filename = 'merged_' . time() . '.xlsx';
        $path = storage_path('app/public/' . $filename);

        $writer = new Xlsx($mergedSpreadsheet);
        $writer->save($path);

        return back()->with('merged_file', $filename);
    }

    // Download the merged file (stub)
    public function download($filename)
    {
        $path = storage_path('app/public/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->download($path, $filename);
    }
}
