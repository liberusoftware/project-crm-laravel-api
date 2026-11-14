<?php

declare(strict_types=1);

namespace App\Support;

class TenantContext extends \Liberu\Foundation\Tenancy\TenantContext {    public static function currentId(): ?int
    {
        return app(TenantState::class)->teamId;
    }
}
