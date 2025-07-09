@extends('layout')

@section('content')
    <div class="mb-4 p-4 bg-light rounded shadow-sm">
        <h2 class="mb-3">Welcome to the XML & Excel File Converter</h2>
        <p class="lead">Easily convert your XML files to Excel or merge two Excel files with highlighted changes.</p>
        <ul>
            <li><strong>Convert XML to Excel:</strong> Upload any XML file and get a structured Excel sheet.</li>
            <li><strong>Merge Excel Files:</strong> Combine two Excel files and highlight all new rows from the second file.</li>
        </ul>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-lg border-0 floating-effect">
                <div class="card-header bg-primary text-white rounded-top-4">Convert XML to Excel</div>
                <div class="card-body rounded-4">
                    <form action="/convert" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="xml_file" class="form-label">Upload XML File</label>
                            <input class="form-control" type="file" name="xml_file" id="xml_file" accept=".xml" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Convert to Excel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-lg border-0 floating-effect">
                <div class="card-header bg-success text-white rounded-top-4">Merge Two Excel Files</div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <p class="text-center">Go to the Excel Merge page to combine two Excel files and highlight new data.</p>
                    <a href="/merge" class="btn btn-success">Go to Excel Merge</a>

                </div>
            </div>
        </div>
    </div>
    @if(session('excel_file'))
        <div class="alert alert-success">
            Conversion successful! <a href="/download/{{ session('excel_file') }}" class="btn btn-success btn-sm">Download Excel</a>
        </div>
    @endif

<style>
    .floating-effect {
        box-shadow: 0 8px 32px rgba(79,140,255,0.13), 0 1.5px 4px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s;
    }
    .floating-effect:hover {
        box-shadow: 0 16px 48px rgba(79,140,255,0.18), 0 3px 12px rgba(0,0,0,0.07);
    }
</style>

<style>
    .floating-effect {
        box-shadow: 0 8px 32px rgba(79,140,255,0.13), 0 1.5px 4px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s;
    }
    .floating-effect:hover {
        box-shadow: 0 16px 48px rgba(79,140,255,0.18), 0 3px 12px rgba(0,0,0,0.07);
    }
</style>
@endsection
