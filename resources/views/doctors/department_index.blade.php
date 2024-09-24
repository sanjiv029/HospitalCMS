@extends('layouts.admin')
@section('subtitle', '')
@section('content_header_title', 'Doctors in Department')

@section('content')
<div class="card mt mt-2">
    <div class="card-body">


    <table id="doctors-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date of Birth (A.D)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>
                    {{ $doctor->name }}
                    </td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($doctor->date_of_birth_ad)->format('Y-m-d') }}</td>
                    <td>{{ $doctor->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</div>
<a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#doctors-table').DataTable();
    });
</script>
@endsection
