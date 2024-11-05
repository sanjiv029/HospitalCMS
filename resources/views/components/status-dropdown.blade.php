<select class="form-control status-dropdown" data-id="{{ $appointment->id }}">
    @foreach($statusOptions as $status)
        <option value="{{ $status }}" {{ $appointment->status == $status ? 'selected' : '' }}>
            {{ ucfirst($status) }}
        </option>
    @endforeach
</select>

