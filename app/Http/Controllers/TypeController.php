<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'LP | Book Categories';
    public function index()
    {
        return view('dashboard.types.index', [
            'categories' => Type::latest()->get(),
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.types.create', [
            'title' => $this->title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'desc' => ['required'],
        ]);

        Type::create($validatedData);
        return redirect('dashboard/types')->with('success', 'Category successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('dashboard.types.show', [
            'type' => $type,
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('dashboard.types.edit', [
            'title' => $this->title,
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'desc' => ['required'],
        ]);

        Type::where('id', $type->id)->update($validatedData);
        return redirect('dashboard/types')->with('successEdit', 'Category successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        Type::destroy($type->id);
        return redirect('/dashboard/types')->with('successDelete', 'Category has been deleted!');
    }
}
