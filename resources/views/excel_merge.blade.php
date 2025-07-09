@extends('layout')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Merge Excel Files</div>
        <div class="card-body">
            <form action="/merge" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="old_file" class="form-label">Upload Old Excel File</label>
                    <input class="form-control" type="file" name="old_file" id="old_file" accept=".xlsx,.xls" required>
                </div>
                <div class="mb-3">
                    <label for="new_file" class="form-label">Upload New Excel File</label>
                    <input class="form-control" type="file" name="new_file" id="new_file" accept=".xlsx,.xls" required>
                </div>
                <button type="submit" class="btn btn-primary">Merge Files</button>
            </form>
        </div>
    </div>
    @if(session('merged_file'))
        <div class="alert alert-success">
            Merge successful! <a href="/download-merged/{{ session('merged_file') }}" class="btn btn-success btn-sm">Download Master Excel</a>
        </div>
    @endif
    <a href="/" class="btn btn-secondary">Back to XML to Excel</a>
@endsection
