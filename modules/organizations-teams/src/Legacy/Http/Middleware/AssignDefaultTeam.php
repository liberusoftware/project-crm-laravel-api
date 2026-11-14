<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssignDefaultTeam
{
    public function handle(Request $request, Closure $next)
    {
        if (! (auth()->user()?->currentTeam) && auth()->check()) {
            $user = auth()->user();
            $defaultTeam = $user->currentTeam ?? $user->ownedTeams()->first();
            if (! $defaultTeam) {
                $defaultTeam = $user->ownedTeams()->create([
                    'name' => $user->name."'s Team",
                    'personal_team' => true,
                ]);
                $user->current_team_id = $defaultTeam->id;
                $user->save();
            }
            \Liberu\Foundation\Tenancy\TenantContext::set((int) $defaultTeam->getKey());
        }

        return $next($request);
    }
}
