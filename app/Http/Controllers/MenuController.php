<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\MenusDataTable;
use App\Models\Menu;
use App\Models\Module;
use App\Models\Page;

class MenuController extends Controller
{

    public function index ( MenusDataTable $dataTables){
        return $dataTables->render('menus.index');
    }

    public function create()
    {
        $modules = Module::all();
        $pages = Page::all();
        $menus = Menu::all();
        return view('menus.form', compact('menus', 'modules', 'pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'display' => 'required|boolean',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:menus,id',
            'type' => 'required|in:module,page,external_link',
            'module_id' => 'nullable|exists:modules,id',
            'page_id' => 'nullable|exists:pages,id',
            'external_link' => 'nullable|url',
        ]);

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->display = $request->display;
        $menu->status = $request->status;
        $menu->parent_id = $request->parent_id;

        if ($request->type === 'module') {
            $menu->type = 'module';
            $menu->type_id = $request->module_id;
        } elseif ($request->type === 'page') {
            $menu->type = 'page';
            $menu->type_id = $request->page_id;
        } elseif ($request->type === 'external_link') {
            $menu->type = 'external_link';
            $menu->external_link = $request->external_link;
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::all();
        $modules = Module::all();
        $pages = Page::all();
        return view('menus.form', compact('menu', 'menus', 'modules', 'pages'));
    }

    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'display' => 'required|boolean',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:menus,id',
            'type' => 'required|in:module,page,external_link',
            'module_id' => 'nullable|exists:modules,id',
            'page_id' => 'nullable|exists:pages,id',
            'external_link' => 'nullable|url',
        ]);

        $menu->title = $request->title;
        $menu->display = $request->display;
        $menu->status = $request->status;
        $menu->parent_id = $request->parent_id;

        if ($request->type === 'module') {
            $menu->type = 'module';
            $menu->type_id = $request->module_id;
        } elseif ($request->type === 'page') {
            $menu->type = 'page';
            $menu->type_id = $request->page_id;
        } elseif ($request->type === 'external_link') {
            $menu->type = 'external_link';
            $menu->external_link = $request->external_link;
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function showMenu()
    {
        $menus = Menu::with('children')->where('parent_id', null)->get();
        return view('menus.show-menu', compact('menus'));
    }


}
