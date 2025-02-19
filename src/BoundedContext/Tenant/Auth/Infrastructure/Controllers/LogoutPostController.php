<?php

namespace Core\BoundedContext\Tenant\Auth\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Tenant\Auth\{Application\Actions\LogoutUseCase,
    Domain\Contracts\AuthRepositoryContract,
};

class LogoutPostController extends AppBaseController
{
    public function __construct(private AuthRepositoryContract $authRepository){}

    /**
     * Logs out the current user and returns a confirmation message.
     *
     * @return JsonResponse The JSON response containing a confirmation message and HTTP status code.
     */
    public function __invoke(): JsonResponse
    {
        try {

            $logoutResponse = (new LogoutUseCase($this->authRepository))();

            return $this->sendSuccess($logoutResponse);

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
