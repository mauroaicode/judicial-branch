<?php

namespace Core\BoundedContext\Tenant\Auth\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Tenant\Auth\Application\Actions\LoginUseCase;
use Core\BoundedContext\Tenant\Auth\Domain\Contracts\AuthRepositoryContract;
use Core\BoundedContext\Tenant\Auth\Infrastructure\{FormRequest\AuthRequest};

class LoginPostController extends AppBaseController
{

    public function __construct(private AuthRepositoryContract $authRepository){}

    /**
     * Handles login requests and responds with a JSON response.
     *
     * @param AuthRequest $request The login request.
     * @return JsonResponse A successful or error JSON response.
     */
    public function __invoke(AuthRequest $request): JsonResponse
    {
        try {

            $authenticatedResponse = (new LoginUseCase(
                $this->authRepository,
            ))(
                $request->get('email'),
                $request->get('password')
            );

            return $this->sendSuccess($authenticatedResponse->toArray());

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
