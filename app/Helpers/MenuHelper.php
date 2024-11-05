<?php
namespace App\Helpers;

class MenuHelper
{
    public static function renderMenu($menus)
    {
        $html = '<ul class="navbar-nav main-nav">';
        foreach ($menus as $menu) {
            if ($menu->display) {
                $hasChildren = $menu->children->isNotEmpty();
                $html .= '<li class="nav-item' . ($hasChildren ? ' dropdown' : '') . '">';
                $html .= '<a href="' . ($menu->external_link ?: url($menu->page->slug ?? $menu->module->slug ?? '')) . '" class="nav-link text-dark underline-effect'  . '"' . ($hasChildren ? ' role="button" aria-expanded="false"' : '') . '>';
                $html .= $menu->title;
                $html .= '</a>';

                if ($hasChildren) {
                    $html .= '<ul class="dropdown-menu">';
                    // Recursive call to render children
                    $html .= self::renderMenu($menu->children);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }
        $html .= '</ul>';

        return $html;
    }
}
