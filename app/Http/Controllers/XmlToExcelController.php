<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// class XmlToExcelController extends Controller
// {
//     public function index()
//     {
//         return view('xml_upload');
//     }

//     public function convert(Request $request)
//     {
//         $request->validate([
//             'xml_file' => 'required|file|mimes:xml',
//         ]);

//         // Handle XML to Excel conversion
//         $xml = simplexml_load_file($request->file('xml_file')->getRealPath());
//         if (!$xml) {
//             return back()->withErrors(['xml_file' => 'Invalid XML file.']);
//         }

//         $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
//         $sheet = $spreadsheet->getActiveSheet();

//         // Convert XML to array and write to Excel
//         // Write headers
//         $sheet->setCellValue('A1', 'id_name');
//         $sheet->setCellValue('B1', 'value');
//         $row = 2;

//         foreach ($xml->string as $string) {
//             $idName = (string) $string['name'];
//             $value = (string) $string;
//             $sheet->setCellValue('A' . $row, $idName);
//             $sheet->setCellValue('B' . $row, $value);
//             $row++;
//         }

//         $filename = 'converted_' . time() . '.xlsx';
//         $path = storage_path('app/public/' . $filename);
//         $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
//         $writer->save($path);

//         return back()->with('excel_file', $filename);
//     }

//     public function download($filename)
//     {
//         $path = storage_path('app/public/' . $filename);
//         if (!file_exists($path)) {
//             abort(404);
//         }
//         return response()->download($path, $filename);
//     }


// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class XmlToExcelController extends Controller
{
    public function index()
    {
        return view('xml_upload');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml',
        ]);

        $xmlFile = $request->file('xml_file')->getRealPath();

        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = false;
        $dom->load($xmlFile);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Value');
        $row = 2;

        // Recursive function to extract name/value pairs and handle comments
        $extract = function ($node) use (&$extract, &$sheet, &$row) {
            if ($node->nodeType === XML_COMMENT_NODE) {
                $commentText = strtoupper(trim($node->nodeValue));
                $sheet->setCellValue('A' . $row, $commentText);
                $sheet->mergeCells("A{$row}:B{$row}");
                $sheet->getStyle("A{$row}")->getFont()->setBold(true);
                $sheet->getStyle("A{$row}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFF59D'); // Light yellow
                $row++;
            } elseif ($node->nodeType === XML_ELEMENT_NODE) {
                $children = [];
                foreach ($node->childNodes as $child) {
                    if ($child->nodeType === XML_ELEMENT_NODE || $child->nodeType === XML_COMMENT_NODE) {
                        $children[] = $child;
                    }
                }
                $hasElementChildren = count(array_filter($children, function($c) { return $c->nodeType === XML_ELEMENT_NODE; })) > 0;
                if (!$hasElementChildren && trim($node->textContent) !== '') {
                    // Use 'name' attribute if present, else tag name
                    $name = $node->getAttribute('name') ?: $node->nodeName;
                    $sheet->setCellValue('A' . $row, $name);
                    $sheet->setCellValue('B' . $row, trim($node->textContent));
                    $row++;
                } else {
                    foreach ($children as $child) {
                        $extract($child);
                    }
                }
            }
        };
        $root = $dom->documentElement;
        $extract($root);




        foreach (range('A', 'B') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'converted_' . time() . '.xlsx';
        $path = storage_path('app/public/' . $filename);
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return back()->with('excel_file', $filename);
    }

    public function download($filename)
    {
        $path = storage_path('app/public/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->download($path, $filename);
    }
}

