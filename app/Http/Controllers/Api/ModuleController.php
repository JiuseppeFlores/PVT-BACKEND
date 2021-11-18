<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pvt/module",
     *     tags={"MÓDULO"},
     *     summary="LISTADO DE MÓDULOS",
     *     operationId="getModules",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Nombre del módulo",
     *         required=false, 
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *         type="json"
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     *
     * Get list of users.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $query = Module::query();
        if ($request->has('name')) $query = $query->where('display_name', 'like','%'.$request->name.'%');

        return [
            'message' => 'Realizado con éxito',
            'payload' => [
                'modules' => $query->get(),
            ]
         ];
    }

    /**
     * @OA\Get(
     *     path="/api/pvt/module/{module}",
     *     tags={"MÓDULO"},
     *     summary="DETALLE DEL MÓDULO",
     *     operationId="getModule",
     *     @OA\Parameter(
     *         name="module",
     *         in="path",
     *         description="",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format = "int64"
     *         )
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            type="json"
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     *
     * Get user
     *
     * @param Request $request
     * @return void
     */

    public function show(Module $module)
    {
        return [
            'message' => 'Realizado con éxito',
            'payload' => [
                'module' => $module
            ]
         ];
    }

   /**
     * @OA\Get(
     *     path="/api/pvt/module/{module}/role",
     *     tags={"MÓDULO"},
     *     summary="LISTADO DE ROLES DEACUERDO AL MODULO SOLICITADO",
     *     operationId="getRolesByModule",
     *     @OA\Parameter(
     *         name="module",
     *         in="path",
     *         description="",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format = "int64"
     *         )
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            type="json"
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     *
     * Get user
     *
     * @param Request $request
     * @return void
     */
    public function get_roles(Module $module)
    {
        return [
            'message' => 'Realizado con éxito',
            'payload' => [
                'roles' => $module->roles()->get()
            ]
         ];
    }
}
