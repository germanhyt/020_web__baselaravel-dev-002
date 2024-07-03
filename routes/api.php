<?php

use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\UserController;
use App\Models\Tejido;
use App\Models\Tipoacabado;
use App\Models\Tipotejido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(
    function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/logoutall', [AuthController::class, 'logoutall']);
        Route::get('/users', [UserController::class, 'index']);
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
