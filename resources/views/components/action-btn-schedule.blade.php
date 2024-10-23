
@if (isset($buttons['edit']) && $buttons['edit'])
    <a href="{{ url($url . $schedule->id . '/edit') }}" class="edit btn btn-warning btn-sm" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
@endif

@if (isset($buttons['delete']) && $buttons['delete'])
    <form method="post" action="{{ url($url . $schedule->id) }}" style="display: inline;">
        @csrf
        @method('delete')
        <button class="delete btn btn-danger btn-sm" type="submit" title="Delete">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
@endif

@if (isset($buttons['download']) && $buttons['download'])
    <a href="{{ url($url . $schedule->id . '/csv') }}" class="edit btn btn-success btn-sm" title="Download CSV">
        <i class="fas fa-download"></i>
    </a>
@endif
