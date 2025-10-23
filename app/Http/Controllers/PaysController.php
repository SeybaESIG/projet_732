<?php
namespace App\Http\Controllers;

use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaysController extends Controller
{
    public function index()
    {
        return Pays::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code_iso_pays' => ['required', 'string', 'size:2', Rule::unique('tb_pays', 'code_iso_pays')],
            'name' => ['required', 'string', Rule::unique('tb_pays', 'name')],
        ]);

        $pays = Pays::create($data);
        return response()->json($pays, 201);
    }

    public function show($id)
    {
        $pays = Pays::findOrFail($id);
        return response()->json($pays);
    }

    public function update(Request $request, $id)
    {
        $pays = Pays::findOrFail($id);

        $data = $request->validate([
            'code_iso_pays' => ['sometimes', 'string', 'size:2', Rule::unique('tb_pays', 'code_iso_pays')->ignore($pays->getKey(), $pays->getKeyName())],
            'name' => ['sometimes', 'string', Rule::unique('tb_pays', 'name')->ignore($pays->getKey(), $pays->getKeyName())],
        ]);

        $pays->update($data);
        return response()->json($pays);
    }

    public function destroy($id)
    {
        $pays = Pays::findOrFail($id);
        $pays->delete();
        return response()->json(null, 204);
    }
}
