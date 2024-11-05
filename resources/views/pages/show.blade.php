@extends('layouts.app') <!-- or whatever layout you're using -->

@section('content')
<div class="container">
    <h1 class="mt-4">{{ $page->title }}</h1>
    <div class="mt-3">
        {!! $page->content !!}
    </div>
    <div class="mt-3">
        @if(isset($page) && $page->img)
            <p >Current Image:</p>
            <img src="{{ asset('storage/' . $page->img) }}" alt="Page Image" style="max-width: 200px; max-height: 200px;">
        @endif
    </div>
    <a href="{{ route('pages.index') }}" class="btn btn-secondary mt-4">Back to Pages</a>
</div>
@endsection
