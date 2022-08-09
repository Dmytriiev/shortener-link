<?php

namespace App\Repositories\Interfaces;

use App\Models\ShortLink;

interface ShortLinkRepositoryInterface
{
    public function getOriginalLink(string $code): ?string;
    public function storeLink(array $data): ShortLink;
}
