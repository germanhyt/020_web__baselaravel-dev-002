<?php

use App\Http\Controllers\api\ColorController;
use App\Http\Controllers\api\HiladoController;
use App\Http\Controllers\api\HiladosproveedorController;
use App\Http\Controllers\api\ProveedorController;
use App\Http\Controllers\api\TejidoController;
use App\Http\Controllers\api\TejidosHiladoController;
use App\Http\Controllers\api\TejidosproveedorController;
use App\Http\Controllers\api\TipoacabadoController;
use App\Http\Controllers\api\TipofibraController;
use App\Http\Controllers\api\TipotejidoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(
    function () {
        // AUTH
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/logoutall', [AuthController::class, 'logoutall']);


        // HILADOS
        // Route::get('/hilados',[HiladoController::class, 'index'] );
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/hilados', [HiladoController::class, 'index']);
        Route::get('/hilados/all', [HiladoController::class, 'showAll']);
        Route::get('/hilados/{id}', [HiladoController::class, 'show']);
        Route::post('/hilados', [HiladoController::class, 'store']);
        Route::put('/hilados/{id}', [HiladoController::class, 'update']);
        Route::patch('/hilados/{id}', [HiladoController::class, 'updatePartial']);
        Route::delete('/hilados/{id}', [HiladoController::class, 'destroy']);

        // HILADOSPROVEEDOR    
        Route::get('/hiladosproveedor', [HiladosproveedorController::class, 'index']);
        Route::get('/hiladosproveedor/{id}', [HiladosproveedorController::class, 'show']);
        Route::get('/hiladosproveedor/hilado/{id}', [HiladosproveedorController::class, 'showByHilado']);
        Route::post('/hiladosproveedor', [HiladosproveedorController::class, 'store']);
        Route::put('/hiladosproveedor/{id}', [HiladosproveedorController::class, 'update']);
        Route::patch('/hiladosproveedor/{id}', [HiladosproveedorController::class, 'updatePartial']);
        Route::delete('/hiladosproveedor/{id}', [HiladosproveedorController::class, 'destroy']);
        Route::post('/hiladosproveedor/array', [HiladosproveedorController::class, 'storeArray']);
        Route::put('/hiladosproveedor/array/{id}', [HiladosproveedorController::class, 'updateByHilado']);

        // TIPOFIBRA
        Route::get('/tipofibras', [TipofibraController::class, 'index']);

        // COLOR
        Route::get('/colors', [ColorController::class, 'index']);


        // PROVEEDOR
        Route::get('/proveedores', [ProveedorController::class, 'index']);

        // TEJIDOSHILADO
        Route::get('/tejidoshilado', [TejidosHiladoController::class, 'index']);
        Route::get('/tejidoshilado/{id}', [TejidosHiladoController::class, 'show']);
        Route::post('/tejidoshilado', [TejidosHiladoController::class, 'store']);
        Route::put('/tejidoshilado/{id}', [TejidosHiladoController::class, 'update']);
        Route::patch('/tejidoshilado/{id}', [TejidosHiladoController::class, 'updatePartial']);
        Route::delete('/tejidoshilado/{id}', [TejidosHiladoController::class, 'destroy']);
        Route::get('/tejidoshilado/tejido/{id}', [TejidosHiladoController::class, 'showByTejido']);
        Route::post('/tejidoshilado/array', [TejidosHiladoController::class, 'storeArray']);
        Route::put('/tejidoshilado/array/{id}', [TejidosHiladoController::class, 'updateByTejido']);


        // TEJIDO
        Route::get('/tejidos', [TejidoController::class, 'index']);
        Route::get('/tejidos/{id}', [TejidoController::class, 'show']);
        Route::post('/tejidos', [TejidoController::class, 'store']);
        Route::put('/tejidos/{id}', [TejidoController::class, 'update']);
        Route::patch('/tejidos/{id}', [TejidoController::class, 'updatePartial']);
        Route::delete('/tejidos/{id}', [TejidoController::class, 'destroy']);
        Route::post('/tejidos/upload', [TejidoController::class, 'uploadFile']);
        Route::post('/tejidos/download', [TejidoController::class, 'downloadFile']);
        // Route::post('/tejidos/download', [TejidoController::class, 'downloadFile']);


        // TIPOACABADO
        Route::get('/tipoacabados', [TipoacabadoController::class, 'index']);

        // TIPOACABADO
        Route::get('/tipotejidos', [TipotejidoController::class, 'index']);


        // TEJIDOSPROVEEDOR
        Route::get('/tejidosproveedor', [TejidosproveedorController::class, 'index']);
        Route::get('/tejidosproveedor/{id}', [TejidosproveedorController::class, 'show']);
        Route::get('/tejidosproveedor/tejido/{id}', [TejidosproveedorController::class, 'showByTejido']);
        Route::post('/tejidosproveedor', [TejidosproveedorController::class, 'store']);
        Route::put('/tejidosproveedor/{id}', [TejidosproveedorController::class, 'update']);
        Route::put('/tejidosproveedor/array/{id}', [TejidosproveedorController::class, 'updateArrayByTejido']);
        Route::patch('/tejidosproveedor/{id}', [TejidosproveedorController::class, 'updatePartial']);
        Route::post('/tejidosproveedor/array', [TejidosproveedorController::class, 'storeArray']);
        Route::delete('/tejidosproveedor/{id}', [TejidosproveedorController::class, 'destroy']);
    }
);





/***** TEST *******/

// Route::middleware('auth:sanctum')->group(
//     function () {
//         Route::get('/profile', [AuthController::class, 'profile']);
//         Route::get('/logout', [AuthController::class, 'logout']);
//         Route::get('/logoutall', [AuthController::class, 'logoutall']);
//     }
// );


// Route::post("/students", [
//     StudentController::class, 'store'
// ]);
// Route::put("/students/{id}", [
//     studentController::class, 'update'
// ]);
// Route::patch("/students/{id}", [
//     studentController::class, 'updatePartial'
// ]);
// Route::delete("students/{id}", [
//     studentController::class, 'destroy'
// ]);

Route::get("/prueba", function () {

    // Tipotejido::create([
    //     "descripcion" => "Jersey"
    // ]);

    // Tipoacabado::create([
    //     "descripcion" => "Siliconado"
    // ]);
    // return 'Campos creados';

    // Tejido::create(
    //     [
    //         "descripcion" => "Jersey",
    //         "galga" => 24,
    //         "diametro" => 30,
    //         "agujas" => 24,
    //         "ancho" => 1.5,
    //         "densidad" => 24,
    //         "densidadgw" => 24,
    //         "encogimientolargo" => 24,
    //         "encogimientoancho" => 24,
    //         "revirado" => 24,
    //         "id_tipoacabado" => 1,
    //         "id_tipotejido" => 1,
    //         "antipilling" => 24,
    //         "costo_por_kg" => 24,
    //         "ficha" => "ficha.pdf"
    //     ]
    // );
    // return 'Tejido creado';

    // Consulta de un registro
    // $tejido  = Tejido::find(1);
    // return $tejido;

    // Consulta de un registro con relaciones
    // $tejido  = Tejido::find(1);
    // return $tejido->tipotejido;

    // Consulta de un registro con relaciones
    // $tejido = Tejido::where('id', 1)
    //     ->with('tipotejido')
    //     ->with('tipoacabado')
    //     ->first();
    // return $tejido;

    // Relación Inversa
    // $tipotejido = Tipotejido::find(1);
    // return $tipotejido->tejidos;

    // test user with passport auth
    $user = User::find(1);
    $token = $user->createToken('authtoken')->accessToken;

    return $token;
});



// Route::middleware('ensuretokenisvalid', 'auth:sanctum')->group(
//     function () {
//         Route::apiResource('/students', StudentController::class);
//     }
// );
