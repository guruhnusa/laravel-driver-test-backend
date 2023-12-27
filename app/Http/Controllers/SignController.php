<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSignsRequest;
use App\Models\Sign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\New_;

class SignController extends Controller
{
    public function index()
    {
        $signs = Sign::paginate(10);
        return view('pages.signs.index', compact('signs'));
    }

    public function create()
    {
        return view('pages.signs.create');
    }

    //store
    public function store(StoreSignsRequest $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/signs', $filename);
        $data = $request->all();
        $sign = new Sign;
        $sign->title = $request->title;
        $sign->category = $request->category;
        $sign->description = $request->description;
        $sign->image = $filename;
        $sign->save();

        return redirect()->route('signs.index')->with('success', 'Sign created successfully.');
    }

    public function edit($id)
    {
        $sign = Sign::findOrFail($id);
        return view('pages.signs.edit', compact('sign'));
    }

    public function update(Request $request, $id)
    {
        $sign = Sign::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/signs', $filename);
            $data['image'] = $filename;
            Storage::delete('public/signs/' . $sign->image);
        }
        $sign->update($data);
        return redirect()->route('signs.index')->with('success', 'Sign updated successfully.');
    }

    public function destroy($id)
    {
        $sign = Sign::findOrFail($id);
        Storage::delete('public/signs/' . $sign->image);
        $sign->delete();
        return redirect()->route('signs.index')->with('success', 'Sign deleted successfully.');
    }
}
