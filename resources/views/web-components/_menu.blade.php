@foreach($menus as $menu)
    @if ($menu->display)
        {{-- Parent menu item --}}
        <div class="nav-item {{ $menu->children->isNotEmpty() ? 'dropdown' : '' }}">
            <a href="{{ $menu->external_link ?: url($menu->page->slug ?? $menu->module->slug ?? '') }}"
               class="nav-link text-dark underline-effect">
                {{ $menu->title }}
            </a>
            {{-- Display dropdown menu only if there are child items --}}
            @if ($menu->children->isNotEmpty())
                            <div class="dropdown-menu">
                                <ul class="dropdown-submenu">
                                        @include('web-components._menu', ['menus' => $menu->children])
                                </ul>
                            </div>
            @endif
        </div>
    @endif
@endforeach
