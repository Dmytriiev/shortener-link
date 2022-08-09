<?php
namespace App\Repositories;

use App\Models\ShortLink;
use App\Repositories\Interfaces\ShortLinkRepositoryInterface;

class ShortLinkRepository implements ShortLinkRepositoryInterface
{
    public function getOriginalLink(string $code): ?string
    {
        $shortLink = ShortLink::availability()->where('code', $code)->first();

        return $shortLink->link ?? null;
    }

    public function storeLink(array $data): ShortLink
    {
        return ShortLink::updateOrCreate([
            'link' => $data['link'],
        ], $data);
    }

    public function incrementHit(string $code): void
    {
        ShortLink::where('code', $code)->increment('hits');
    }
}
