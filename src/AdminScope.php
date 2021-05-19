<?php

namespace Microservices;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;


class AdminScope
{
    /** @var UserService */
    private $userService;

    /**
     * OrderController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->userService->isAdmin()) {
            return $next($request);
        }

        throw new AuthenticationException;
    }
}
