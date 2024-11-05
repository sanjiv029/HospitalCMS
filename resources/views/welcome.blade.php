@extends('layouts.web-template')

@section('content')
    @include('web-components.alert')
    @include('web-components.banner', ['numberOfDoctors' => $numberOfDoctors, 'numberOfDepartments' => $numberOfDepartments])
    @include('web-components.steps')
    @include('web-components.departments')
    @include('web-components.doctors')
@endsection
