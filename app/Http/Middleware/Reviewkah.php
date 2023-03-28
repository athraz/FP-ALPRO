<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\User;

class Reviewkah
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $reviewId = $request->route('reviews_id');
            $review = Review::find($reviewId);
            if ($review) {
                $userId = $review->user->id;
                if (Auth::user()->role === 'admin' || Auth::user()->id === $userId) {
                    return $next($request);
                } else {
                    return redirect('review')->withErrors('Unauthorized access!');
                }
            } else {
                return redirect('review')->withErrors('Review not found!');
            }
        }
        return redirect()->route('sesi')->withErrors('Please login first!');
    }
}

