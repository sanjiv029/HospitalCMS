@extends('layouts.admin')

@section('subtitle', '')
@section('content_header_title', '')

@section('content_body')
    <div class="card mx-auto" style="max-width:800px;">
        <div class="card-header">
            <h3 class="card-title">{{ isset($menu) ? 'Edit Menu' : 'Create New Menu' }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($menu) ? route('menus.update', $menu->id) : route('menus.store') }}">
                @csrf
                @if(isset($menu))
                    @method('PUT')
                @endif

                <!-- Title -->
                <div class="form-group">
                    <label for="title" class="text-secondary">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $menu->title ?? '') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Display -->
                <div class="form-group">
                    <label for="display" class="text-secondary">Display</label>
                    <select name="display" id="display" class="form-control @error('display') is-invalid @enderror" required>
                        <option value="1" {{ old('display', $menu->display ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('display', $menu->display ?? '') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('display') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="text-secondary">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="1" {{ old('status', $menu->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $menu->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Parent Menu -->
                <div class="form-group">
                    <label for="parent_id" class="text-secondary">Parent Menu</label>
                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                        <option value="">None</option>
                        @foreach($menus as $parentMenu)
                            <option value="{{ $parentMenu->id }}" {{ old('parent_id', $menu->parent_id ?? '') == $parentMenu->id ? 'selected' : '' }}>{{ $parentMenu->title }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Type Dropdown -->
                <div class="form-group">
                    <label for="type" class="text-secondary">Type</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                        <option value="">Select Type</option>
                        <option value="module" {{ old('type', $menu->type ?? '') === 'module' ? 'selected' : '' }}>Module</option>
                        <option value="page" {{ old('type', $menu->type ?? '') === 'page' ? 'selected' : '' }}>Page</option>
                        <option value="external_link" {{ old('type', $menu->type ?? '') === 'external_link' ? 'selected' : '' }}>External Link</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Module Form -->
                <div id="module-form" class="conditional-form" style="{{ old('type', $menu->type ?? '') === 'module' ? 'display:block;' : 'display:none;' }}">
                    <div class="form-group">
                        <label for="module_id" class="text-secondary">Module Title</label>
                        <select name="module_id" id="module_id" class="form-control @error('module_id') is-invalid @enderror">
                            <option value="">Select Module</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ old('module_id', $menu->type_id ?? '') == $module->id ? 'selected' : '' }}>{{ $module->title }}</option>
                            @endforeach
                        </select>
                        @error('module_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Page Form -->
                <div id="page-form" class="conditional-form" style="{{ old('type', $menu->type ?? '') === 'page' ? 'display:block;' : 'display:none;' }}">
                    <div class="form-group">
                        <label for="page_id" class="text-secondary">Page Title</label>
                        <select name="page_id" id="page_id" class="form-control @error('page_id') is-invalid @enderror">
                            <option value="">Select Page</option>
                            @foreach($pages as $page)
                                <option value="{{ $page->id }}" {{ old('page_id', $menu->type_id ?? '') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('page_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- External Link Form -->
                <div id="external_link_form" class="conditional-form" style="{{ old('type', $menu->type ?? '') === 'external_link' ? 'display:block;' : 'display:none;' }}">
                    <div class="form-group">
                        <label for="external_link" class="text-secondary">External Link</label>
                        <input type="url" name="external_link" id="external_link" class="form-control @error('external_link') is-invalid @enderror" value="{{ old('external_link', $menu->external_link ?? '') }}">
                        @error('external_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <button type="submit" class="btn btn-primary">{{ isset($menu) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('type').addEventListener('change', function() {
            const moduleForm = document.getElementById('module-form');
            const pageForm = document.getElementById('page-form');
            const linkForm = document.getElementById('external_link_form');

            if (this.value === 'module') {
                moduleForm.style.display = 'block';
                pageForm.style.display = 'none';
                linkForm.style.display ='none';
            } else if (this.value === 'page') {
                moduleForm.style.display = 'none';
                pageForm.style.display = 'block';
                linkForm.style.display ='none';
            } else if (this.value === 'external_link') {
                moduleForm.style.display = 'none';
                pageForm.style.display = 'none';
                linkForm.style.display ='block';
            }  else {
                moduleForm.style.display = 'none';
                pageForm.style.display = 'none';
                linkForm.style.display ='none';
            }
        });
    </script>
@endsection
