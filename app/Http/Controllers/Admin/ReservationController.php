<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Stroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function list()
    {
        $reservations = Reservation::select()->get();

        return view('admin.reservations.list')->with([
                                                        'reservations' => $reservations
                                                    ]);
    }


    public function approve(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->canceledDate = null;
        $reservation->status = 'approved';
        $reservation->save();

        return redirect()->route('reservation')
            ->with('success', 'Reservation approved successfully');
    }

    public function cancel(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->canceledDate = now();
        $reservation->status = 'canceled';
        $reservation->save();

        return redirect()->route('reservation')
            ->with('success', 'Reservation canceled successfully');
    }
    public function view(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        return view('admin.reservations.view')->with([
                                                         'reservation' => $reservation
                                                     ]);
    }
}
