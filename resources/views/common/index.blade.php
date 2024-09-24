@extends('layouts.admin')
@section('subtitle', $resourceName)
@section('content_header_title', $resourceName)

@section('content_body')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route($resourceRoute .'.create') }}">Create</a>
        </div>

       {{-- Success Message --}}
        @if(session('Success'))
            <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #e2f7e1; color: #155724;">
                  <strong>Success!</strong> {{ session('Success') }}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>
             </div>
        @endif


        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@stop

@push('js')
    @vite('resources/js/app.js')
    {{ $dataTable->scripts() }}
    <script>
        // Hide the success message after 3 seconds
        setTimeout(function() {
            var message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000);
        // Fetch doctors for a department when the doctor count link is clicked
        $(document).on('click', '.doctor-count', function () {
            var departmentId = $(this).data('id');

            // Fetch the doctors for the department
            $.ajax({
                url: '/admin/departments/' + departmentId + '/admin/doctors',
                type: 'GET',
                success: function (data) {
                    // You can now display the doctors in a modal, separate DataTable, or any other UI component
                    console.log(data); // Handle displaying the data as needed
                },
                error: function () {
                    alert('Error retrieving doctors.');
                }
            });
        });
    </script>
@endpush
