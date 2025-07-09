@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card shadow-lg border-0 rounded-4 mb-5">
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(90deg, #4f8cff 0%, #6fc3ff 100%); box-shadow: 0 2px 8px rgba(79,140,255,0.13);">
                    <h3 class="mb-0 d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                          <path d="M13 1H4a1 1 0 0 0-1 1v2h1V2a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-2v1h2a2 2 0 0 0 2-2V2a2 2 0 0 0-2-1z"/>
                          <path d="M11 3H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm1 11a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v9z"/>
                        </svg>
                        Merge Excel Files
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form action="/merge" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label for="old_file" class="form-label fw-semibold">Upload <span class="text-primary">Old Excel File</span></label>
                            <input class="form-control form-control-lg rounded-3 shadow-sm" type="file" name="old_file" id="old_file" accept=".xlsx,.xls" required>
                            <div class="invalid-feedback">Please select the old Excel file.</div>
                        </div>
                        <div class="mb-4">
                            <label for="new_file" class="form-label fw-semibold">Upload <span class="text-primary">New Excel File</span></label>
                            <input class="form-control form-control-lg rounded-3 shadow-sm" type="file" name="new_file" id="new_file" accept=".xlsx,.xls" required>
                            <div class="invalid-feedback">Please select the new Excel file.</div>
                        </div>
                        <button type="submit" class="btn btn-gradient-blue btn-lg px-5 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                              <path d="M11.534 7h-6.07a.5.5 0 0 0-.492.41l-.5 4a.5.5 0 0 0 .492.59h6.07a.5.5 0 0 0 .492-.59l-.5-4a.5.5 0 0 0-.492-.41zm-6.07 1h6.07l.5 4h-6.07l-.5-4z"/>
                              <path d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 1 0-.908-.418A6 6 0 1 0 8 2v1z"/>
                            </svg>
                            Merge Files
                        </button>
                    </form>
                </div>
            </div>
            @if(session('merged_file'))
                <div class="alert alert-success d-flex align-items-center gap-3 shadow-sm rounded-3 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 6.03 7.97a.75.75 0 1 0-1.06 1.06l1.5 1.5z"/>
                    </svg>
                    <span>Merge successful!</span>
                    <a href="/download-merged/{{ session('merged_file') }}" class="btn btn-success btn-lg rounded-pill px-4 py-2 ms-auto d-flex align-items-center gap-2 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                          <path d="M.5 9.9V13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V9.9a.5.5 0 0 0-1 0V13a.5.5 0 0 1-.5.5h-13A.5.5 0 0 1 1 13V9.9a.5.5 0 0 0-1 0z"/>
                          <path d="M7.646 10.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.293V2.5a.5.5 0 0 0-1 0v6.793L5.354 7.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        Download Master Excel
                    </a>
                </div>
            @endif
            <div class="d-flex justify-content-center mt-4">
                <a href="/" class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                    </svg>
                    Back to XML to Excel
                </a>
            </div>
        </div>
    </div>

    <style>
        .btn-gradient-blue {
            background: linear-gradient(90deg, #4f8cff 0%, #6fc3ff 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .btn-gradient-blue:hover, .btn-gradient-blue:focus {
            background: linear-gradient(90deg, #3576e6 0%, #63b3ed 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(79,140,255,0.18);
        }
    </style>
@endsection