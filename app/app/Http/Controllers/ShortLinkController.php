<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ShortLinkRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShortLinkController extends Controller
{
    private $shortLinkRepository;

    public function __construct(ShortLinkRepositoryInterface $shortLinkRepository)
    {
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('welcome');
    }

    /**
     * @return RedirectResponse
     */
    public function store(StoreLinkRequest $request): RedirectResponse
    {
        $data = [
            'code' => $this->generateToken(),
            'expired_date' => Carbon::now()->addHours($request->lifetime)
        ];

        $shortLink = $this->shortLinkRepository->storeLink(
            array_merge($request->all(), $data)
        );

        return redirect('/')->with('shortedLink', $shortLink->full_link);
    }

    /**
     * @return RedirectResponse
     */
    public function thirdPartyLink(Request $request): RedirectResponse
    {
        $originalLink = $this->shortLinkRepository->getOriginalLink($request->token);

        return $originalLink ? redirect()->away($originalLink) : abort(404);
    }

    private function generateToken(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($characters), 0, 8);
    }
}
