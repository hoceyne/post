<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $post = Post::with(["author"])->find($id);
        $user_id = $request->user()->id;
        if ($post->user_id == $user_id) {
            return $next($request);
        } else {
            abort(403, "cannot access this route");
        }
    }
}
