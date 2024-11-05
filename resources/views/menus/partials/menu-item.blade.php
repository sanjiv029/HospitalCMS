@foreach ($menus as $menu)
    @if ($menu->display) <!-- Check if the menu should be displayed -->
        <div class="menu-item">
            @if ($menu->type === 'external_link')
                <a href="{{ $menu->external_link }}" class="menu-link" target="_blank">{{ $menu->title }}</a>
            @elseif ($menu->type === 'page')
                <a href="{{ route('pages.show', $menu->type_id) }}" class="menu-link">{{ $menu->title }}</a>
            @elseif ($menu->type === 'module')
                <a href="{{url($menu->module->slug)}}" class="menu-link">{{ $menu->title }}</a>
            @endif
            <div class="action-buttons">
                <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this menu?');">Delete</button>
                </form>
            </div>
        </div>

        {{-- Render child menus --}}
        @if ($menu->children->isNotEmpty())
            <div class="child-menu">
                @include('menus.partials.menu-item', ['menus' => $menu->children]) {{-- Recursive call for child menus --}}
            </div>
        @endif
    @endif
@endforeach
