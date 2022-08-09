<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ShortLinkRepositoryInterface;
use Closure;

class LogLink
{
    private $shortLinkRepository;

    public function __construct(ShortLinkRepositoryInterface $shortLinkRepository)
    {
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->shortLinkRepository->incrementHit($request->token);

        return $next($request);
    }
}
