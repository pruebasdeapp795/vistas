<?php

namespace App\Http\Controllers;

use App\Models\Capacitante;
use Illuminate\Http\Request;

class CapacitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capacitantes = Capacitante::all();
        return response()->json(['data' => $capacitantes], Response::HTTP_OK);
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
        $validator = Validator::make($request->all(), [
            'cedula' => 'required|unique:capacitantes',
            'nombre_completo' => 'required',
            'primer_nombre' => 'nullable|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'nullable|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255|unique:capacitantes',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:50',
            'otros_datos' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $capacitante = Capacitante::create($request->all());

        return response()->json(['data' => $capacitante], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Capacitante $capacitante)
    {
        return response()->json(['data' => $capacitante], Response::HTTP_OK);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Capacitante $capacitante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capacitante $capacitante)
    {
        //
    }

    public function obtenerPorCedula($cedula)
    {
        $capacitante = Capacitante::where('cedula', $cedula)->first();

        if ($capacitante) {
            return response()->json(['data' => $capacitante], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Capacitante no encontrado'], Response::HTTP_NOT_FOUND);
    }

    public function generarQr(Capacitante $capacitante)
    {
        $qrCode = QrCode::format('svg')->size(200)->generate($capacitante->cedula);
        $fileName = 'qr_' . Str::slug($capacitante->cedula) . '.svg';
        Storage::disk('public')->put('qrcodes/' . $fileName, $qrCode);

        $capacitante->qr_code = 'qrcodes/' . $fileName;
        $capacitante->save();

        return response()->json(['data' => ['qr_code_url' => asset('storage/qrcodes/' . $capacitante->qr_code)]], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capacitante $capacitante)
    {
        $capacitante->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
