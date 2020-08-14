@extends('master/layout')
@section('title', 'Free online ocr reader')

@section('content')
<div class="jumbotron">
    <h1>Free Online OCR</h1>
    <form method="POST" class="row mt-4" enctype="multipart/form-data">
        <div class="col-sm">
            <div class="form-group">
                <label for="uploader">Step 1 : Choose image</label>
                <input type="file" name="file" class="form-control-file" id="uploader">
                <small class="text-secondary">max size 15mb</small>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-group">
                <label style="display: block;" for="btnUpload">Step 2 : Click to start</label>
                <input type="submit" class="btn btn-primary" id="btnUpload">
            </div>
        </div>
    </form>

    @if (\phpngaos\Bootstrap\Session::get('error_message') != null)
    <div class="row">
        <div class="col-sm">
            <div class="alert alert-danger">{{ \phpngaos\Bootstrap\Session::getFlash('error_message') }}</div>
        </div>
    </div>
    @endif

</div>

@if (\phpngaos\Bootstrap\Session::get('reader_result') != null)
<div class="row">
    <div class="col-sm">
        <h3>Result :</h3>
        <textarea rows="6" style="width: 100%;">{{ \phpngaos\Bootstrap\Session::getFlash('reader_result') }}</textarea>
        <small class="text-secondary">*We do not save the images you upload.</small>
    </div>
</div>
@endif

@endsection