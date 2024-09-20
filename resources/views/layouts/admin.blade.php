@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop
@push('css')
    @vite('resources/css/app.css')
    @vite('resources/sass/style.scss')
@endpush

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#department_id').select2({
                placeholder: 'Select a Department',
                allowClear: true
            });
        });
    </script>
@endpush
@push('css')
    <style>
        /* Customize the Select2 dropdown height and text alignment */
        .select2-container .select2-selection--single {
            height: 38px; /* Adjust the height to match your form fields */
            padding: 6px 12px; /* Add some padding for better spacing */
            font-size: 16px; /* Adjust the font size */
        }

        /* Align the placeholder text better */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d; /* Placeholder text color */
            line-height: 38px; /* Vertically center the text */
        }

        /* Adjust the dropdown arrow icon position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px; /* Make sure it aligns with the select box */
            right: 10px; /* Adjust the right position */
        }

        /* Adjust the dropdown menu items */
        .select2-dropdown {
            font-size: 16px; /* Adjust the font size */
        }
    </style>
@endpush

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    {{-- <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong> --}}
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
    {{--    TODO Replace with local or npm version --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add your common script logic here...
        });
    </script>
@endpush

{{-- Add common CSS customizations --}}

@push('css')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush
