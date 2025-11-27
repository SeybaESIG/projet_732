<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Throwable $e) {
            return $this->sendFailureResponse($request, 'Impossible de se connecter avec Google.');
        }

        $user = $this->findOrCreateLocalUser($googleUser);
        Auth::login($user);

        return $this->sendSuccessResponse($request);
    }

    protected function findOrCreateLocalUser($googleUser): User
    {
        $user = User::where('google_id', $googleUser->getId())->first();

        if (! $user && $googleUser->getEmail()) {
            $user = User::where('email', $googleUser->getEmail())->first();
        }

        $payload = $googleUser->user ?? [];
        $givenName = data_get($payload, 'given_name');
        $familyName = data_get($payload, 'family_name');

        if (! $user) {
            $user = User::create([
                'username' => $this->generateUniqueUsername($googleUser->getEmail() ?? $googleUser->getId()),
                'nom' => $familyName ?: ($googleUser->getName() ? Str::afterLast($googleUser->getName(), ' ') : 'Inconnu'),
                'prenom' => $givenName ?: ($googleUser->getName() ? Str::before($googleUser->getName(), ' ') : 'Utilisateur'),
                'email' => $googleUser->getEmail(),
                'date_inscription' => now(),
            ]);
        }

        $user->fill([
            'google_id' => $googleUser->getId(),
            'google_avatar_url' => $googleUser->getAvatar(),
            'google_access_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'google_token_expires_at' => $googleUser->expiresIn ? now()->addSeconds($googleUser->expiresIn) : null,
        ])->save();

        return $user;
    }

    protected function generateUniqueUsername(?string $seed): ?string
    {
        if (blank($seed)) {
            $seed = (string) Str::uuid();
        }

        $base = Str::limit(Str::slug($seed, '_'), 25, '');
        if ($base === '') {
            $base = 'user';
        }

        $username = $base;
        $suffix = 1;

        while (User::where('username', $username)->exists()) {
            $username = Str::limit($base . '_' . $suffix, 30, '');
            $suffix++;
        }

        return $username;
    }

    protected function sendFailureResponse(Request $request, string $message): RedirectResponse
    {
        $target = $this->intendedLoginRoute($request);

        return redirect($target)->with('error', $message);
    }

    protected function sendSuccessResponse(Request $request): RedirectResponse
    {
        $target = $request->session()->pull('url.intended', '/');

        return redirect($target ?: '/')->with('status', 'Connecté avec Google.');
    }

    protected function intendedLoginRoute(Request $request): string
    {
        if (app('router')->has('login')) {
            return route('login');
        }

        return $request->headers->get('referer') ?: '/';
    }
}
