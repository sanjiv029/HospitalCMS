@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($department) ? 'Edit Department' : 'Create New department' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}" method="POST">
                @csrf
                @if(isset($department))
                    @method('PUT')
                @endif
{{-- for error --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                 </ul>
           </div>
         @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $department->name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $department->code ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $department->description ?? '') }}" required>
                </div>


                <button type="submit" class="btn btn-primary">{{ isset($department) ? 'Update' : 'Create' }}</button>
               <a href="{{route ('departments.index')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
