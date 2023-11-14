<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Models\Organisation\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.adminkeu.links');
    }

    public function main()
    {
        $links = Link::orderBy('position')->get();

        return view('Pages.main', [
            'links' => $links
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'iTitle' => 'string|max:64',
            'iLink' => 'url'
        ]);

        $lastPosition = Link::max('position') + 1;

        Link::create([
            'title' => $request->iTitle,
            'link' => $request->iLink,
            'position' => $lastPosition
        ]);

        return redirect('admin/links');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'iTitle' => 'string|max:64',
            'iLink' => 'url'
        ]);

        $link = Link::findOrFail($id);

        $link->update([
            'title' => $request->iTitle,
            'link' => $request->iLink,
        ]);

        return redirect('admin/links');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect('admin/links');
    }
}
