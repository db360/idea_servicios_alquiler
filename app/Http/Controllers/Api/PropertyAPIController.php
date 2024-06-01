<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;

class PropertyAPIController extends Controller
{
    protected $propertyController;
    public function __construct(PropertyController $propertyController) {
        $this->propertyController = $propertyController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->propertyController->index(true);
        return $result;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $result = $this->propertyController->store($request, true);
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->propertyController->show($id, true);
        return $result;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->propertyController->update($request, true, $id);
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->propertyController->destroy( $id, true);
        return $result;
    }
}
