<?php



namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Add this line to import the Controller class

/**
 * @OA\Server(url="http://localhost:8000")
 */
class UserController extends Controller
{
    //

    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    /**
     * @OA\Get(
     *      path="/api/users",
     *      tags={"User"},
     *      summary="Get all users",
     *      description="Get all users",
     *      @OA\Response(
     *          response=200,
     *          description="All users",
     *          @OA\JsonContent( ref="#/components/schemas/UserResource")
     *      )
     * ) 
     */
    public function index()
    {
        $data = $this->userRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(UserResource::collection($data), '', 200);
    }
}
