<?php

namespace App\Http\Controllers;

use App\DataTables\PagesDataTable;
use App\Models\Page;
use App\Models\Doctor;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PagesDataTable $dataTables)
    {
        return $dataTables->render('common.index', [
            'resourceName' => 'Pages',
            'resourceRoute' => 'pages',
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.form'); // Return the create form view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'slug' => 'required|string|unique:pages,slug',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size as needed
        ]);

        $page = new Page();
        $page->title = $request->title;
        $page->date = $request->date;
        $page->slug = $request->slug;
        $page->content = $request->content;

        // Handle image upload
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('images/pages', 'public'); // Store image in public disk
            $page->img = $path;
        }

        $page->save(); // Save the page to the database

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return \Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view('pages.form', compact('page')); // Return the edit form view
    }

    public function show($id)
    {
        // Retrieve the page by ID
        $page = Page::findOrFail($id);

        // Return the view with the page data
        return view('pages.show', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'slug' => 'required|string|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $page->title = $request->title;
        $page->date = $request->date;
        $page->slug = $request->slug;
        $page->content = $request->content;

        // Handle image upload
        if ($request->hasFile('img')) {
            // Delete old image if it exists
            if ($page->img) {
                Storage::disk('public')->delete($page->img);
            }
            $path = $request->file('img')->store('images/pages', 'public');
            $page->img = $path;
        }

        $page->save(); // Update the page in the database

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Page $page)
    {
        // Delete image from storage if it exists
        if ($page->img) {
            Storage::disk('public')->delete($page->img);
        }

        $page->delete(); // Delete the page from the database

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }

    public function aboutUs()
    {
        return view('pages.about-us',);
    }

    public function doctor() {
        $doctors = Doctor::all();
        return view('pages.doctor',compact('doctors'));
    }

}
