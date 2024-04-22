<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $title = 'Perpus | Dashboard';
    // menampilkan dashboard dan query data yg ditampilkan
    public function index()
    {
        return view('dashboard.dashboard', [
            'title' => $this->title,
            'count_user_bookings' => Booking::where('user_id', auth()->user()->id)->count(),
            'count_wait_bookings' => Booking::where('status', 'Waiting')->count(),
            'count_user_denda' => Booking::where([
                'user_id' => auth()->user()->id,
                'isDenda' => 1
            ])->count(),
            'count_user_active_booking' => Booking::where([
                'user_id' => auth()->user()->id,
                'status' => 'Approved'
            ])->count(),
            'count_bookings' => Booking::count(),
            'count_denda' => Booking::where([
                // 'user_id' => auth()->user()->id,
                'isDenda' => 1
            ])->count(),
            'count_active_booking' => Booking::where([
                // 'user_id' => auth()->user()->id,
                'status' => 'Approved'
            ])->count(),
            'latest_user_bookings' => Booking::latest()->where('user_id', auth()->user()->id)->take(5)->get(),
            'latest_bookings' => Booking::latest()->take(5)->get()
        ]);
    }
}
