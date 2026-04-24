<?php

namespace App\Http\Middleware;

use App\Models\Visite;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    // Routes à ignorer
    protected array $except = [
        'admin/*',
        'api/*',
        'otp/*',
        'login',
        'logout',
        'password/*',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return $next($request);
            }
        }
        // Enregistrer une visite
        if ($this->shouldSkip($request)) {
            return $next($request);
        }

        $ip = $request->ip();

        // Vérifier si cette IP a déjà visité aujourd'hui
        $isUnique = !Visite::where('ip_address', $ip)
            ->whereDate('created_at', today())
            ->exists();

        
        $agent   = $this->parseUserAgent($request->userAgent());

        Visite::create([
            'ip_address' => $ip,
            'url'        => $request->fullUrl(),
            'page_title' => null,
            'user_agent' => $request->userAgent(),
            'device'     => $agent['device'],
            'browser'    => $agent['browser'],
            'os'         => $agent['os'],
            'referer'    => $request->headers->get('referer'),
            'user_id'    => auth()->user()?->id,
            'is_unique'  => $isUnique,
        ]);

        return $next($request);
    }

    protected function shouldSkip(Request $request): bool
    {
        
        $botPatterns = ['bot', 'crawl', 'spider', 'slurp', 'lighthouse'];
        $userAgent   = strtolower($request->userAgent() ?? '');

        foreach ($botPatterns as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return true;
            }
        }

        // Ignorer les routes exclues
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        // Ignorer les requêtes AJAX / assets
        if ($request->ajax() || $request->expectsJson()) {
            return true;
        }

        return false;
    }

    protected function parseUserAgent(?string $ua): array
    {
        $ua = strtolower($ua ?? '');

        // Device
        $device = 'desktop';
        if (preg_match('/mobile|android|iphone/i', $ua))  $device = 'mobile';
        elseif (preg_match('/tablet|ipad/i', $ua))        $device = 'tablet';

        // Browser
        $browser = 'Autre';
        if (str_contains($ua, 'chrome') && !str_contains($ua, 'edg'))  $browser = 'Chrome';
        elseif (str_contains($ua, 'firefox'))                           $browser = 'Firefox';
        elseif (str_contains($ua, 'safari') && !str_contains($ua, 'chrome')) $browser = 'Safari';
        elseif (str_contains($ua, 'edg'))                               $browser = 'Edge';
        elseif (str_contains($ua, 'opera') || str_contains($ua, 'opr')) $browser = 'Opera';

        // OS
        $os = 'Autre';
        if (str_contains($ua, 'windows'))     $os = 'Windows';
        elseif (str_contains($ua, 'mac'))     $os = 'macOS';
        elseif (str_contains($ua, 'linux'))   $os = 'Linux';
        elseif (str_contains($ua, 'android')) $os = 'Android';
        elseif (str_contains($ua, 'iphone') || str_contains($ua, 'ipad')) $os = 'iOS';

        return compact('device', 'browser', 'os');
    }
}
