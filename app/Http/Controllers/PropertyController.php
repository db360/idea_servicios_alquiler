<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    private function validateForms(Request $request, $isUpdate = false, $api = false) {


        $rules = [
            'title' => 'required|string|min:10|max:50',
            'description' => 'string|nullable',
            'address' => 'required|string|min:10',
            'city' => 'required|string|min:2',
            'comunidad' => 'required|string|min:2',
            'codigo_postal' => 'required|string|min:4',
        ];

        // Si no es una actualización, agregamos las reglas para 'user_id'
        if (!$isUpdate) {
            $rules['user_id'] = 'required|integer';
        }

        $messages = [
            'user_id.required' => 'La :attribute es obligatoria',
            'user_id.integer' => 'La :attribute debe de ser un número entero',
            'title.required' => 'El :attribute es obligatorio',
            'title.min' => 'El :attribute debe contener como mínimo 10 caracteres',
            'title.max' => 'El :attribute debe contener como máximo 50 caracteres',
            'title.string' => 'El :attribute debe de ser caracteres',
            'description.string' => 'La :attribute debe de estar compuesta por caracteres',
            'address.required' => 'La :attribute es obligatoria',
            'address.string' => 'La :attribute se debe de componer de caracteres',
            'address.min' => 'La :attribute no puede contener menos de :min caracteres',
        ];
                // Si la solicitud es una solicitud API, maneja los datos en formato JSON
        if ($api) {
            // Convierte los datos JSON en un array asociativo
            $data = json_decode($request->getContent(), true);
            // Crea una instancia del validador con los datos recibidos y las reglas y mensajes de error comunes
            $validator = Validator::make($data, $rules, $messages);
        } else {
            // Si la solicitud no es una solicitud API, maneja los datos de entrada como de costumbre
            // Crea una instancia del validador con los datos recibidos y las reglas y mensajes de error comunes
            $validator = Validator::make($request->all(), $rules, $messages);
        }


        $validator->setAttributeNames(['user_id'=> 'ID de usuario', 'title' => 'título', 'description'=>'descripción', 'address' => 'dirección', 'city' => 'ciudad', 'codigo_posta' => 'código postal']);

        return $validator;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($api = false)
    {
        $errors = [];

        try {
            $properties = Property::all();

        } catch (QueryException) {

            if($api) {

            return response()->json(['error' => 'Error en la conexion con la BD'], 503);

            } else {

                $errors[] = 'Error en la conexion con la BD';
                return view('properties.properties', ['errors' => $errors]);
            }

        }

        if($api) {


            if ($properties->isEmpty()) {
                // mensaje de error
                return response()->json(['error' => 'No hay propiedades disponibles'], 404);
            }

            return $properties;

        }

        if($properties->isEmpty() && $api === false) {
            $errors[] = 'No hay propiedades en la base de datos';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        return view('properties.properties', ['properties' => $properties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.newProperty');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $api = false)
    {

        if(!$api) {
            $v = $this->validateForms($request, true);
        } else {
            $v = $this->validateForms($request, true, true);
        }


        // si falla la validacion
        if($v->fails()) {
            if(!$api) {
                return redirect()->back()->withErrors($v)->withInput();
            }

            return response()->json(['error_validacion' => $v->errors()], 404);

        }

        $errors = [];

        $property = new Property();

        $property->user_id = $request->input('user_id');
        $property->title = $request->input('title');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        $property->city = $request->input('city');
        $property->comunidad = $request->input('comunidad');
        $property->codigo_postal = $request->input('codigo_postal');

        if(!$property->save()) {
            if(!$api) {
                $errors[] = "La propiedad no se pudo guardar.";
            }
            return response()->json(['error' => 'Hubo en error al guardar'], 422);

        }

            // Verificar si hubo errores al guardar
        if (!empty($errors)) {
            if(!$api) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            return response()->json(['error' => 'Hubo en error al guardar'], 404);

        }

        if(!$api) {
        // Redirigir a una ruta específica con un mensaje de éxito
        return Redirect::route('properties.show', ['id' => $property->id])->with('success', 'Propiedad creada con éxito');
        }

            return $property;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $errors = [];

        $property = Property::findOrFail(intval($id));


        if(!$property) {
            $errors[] = 'Hubo un problema al recuperar la propiedad';
            return redirect()->back()->withErrors($errors)->withInput();
        }
        return view('properties.showProperty', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::findOrFail(intval($id));

        return view('properties.editPropertyForm', ['property' => $property]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        var_dump($id);
        $v = $this->validateForms($request, true);

        if($v->fails()) {
        return redirect()->back()->withErrors($v->errors())->withInput();
        }

        $errors = [];

        try {
            $property = Property::findOrFail($id);

        } catch (ModelNotFoundException) {
            return redirect()->back()->withErrors(['error' => 'No se encontró la propiedad con ese ID'])->withInput();
        }

        $property->title = $request->input('title');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        $property->city = $request->input('city');
        $property->comunidad = $request->input('comunidad');
        $property->codigo_postal = $request->input('codigo_postal');

        if(!$property->save()) {
            $errors[] = "La propiedad no se pudo editar.";
            return redirect()->back()->withErrors($errors)->withInput();

        }

        //     // Verificar si hubo errores al guardar
        // if (!empty($errors)) {
        //     $errors[] = "No existe la propiedad con ese ID";
        //     return redirect()->back()->withErrors($errors)->withInput();
        // }

        // Redirigir a una ruta específica con un mensaje de éxito
        return redirect("/properties/$property->id")->with('success', '¡Ubicación Editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // 1. Encontrar la propiedad
            $property = Property::findOrFail((int)$id);

            // 2. Verificar si la propiedad existe y eliminarla
            if ($property->delete()) {
                // 3. Redirigir con un mensaje de éxito
                return redirect()->route('properties')->with('success', 'Propiedad eliminada con éxito.');
            } else {
                // Si la eliminación falla, redirigir con un mensaje de error
                return redirect()->route('properties.properties')->with('error', 'Hubo un problema al eliminar la propiedad.');
            }
        } catch (ModelNotFoundException $exception) {
            // Si la propiedad no se encuentra, redirigir con un mensaje de error
            return redirect()->route('properties.index')->with('error', 'La propiedad no existe.');
        }
    }
}
