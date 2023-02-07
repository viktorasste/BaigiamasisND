<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Stroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function list()
    {
        $user = Auth::user();

        return view('reservations')->with([
                                              'reservations' => $user->reservations
                                          ]);
    }

    public function submit(Request $request, $id)
    {
        $user = Auth::user();
        $stroller = Stroller::whereId($id)->first();
        $request->validate([
                               'dates' => 'required',
                           ]);
        try {
            DB::beginTransaction();
            $dates = explode(' - ', $request->dates);
            $dateFrom = $dates[0];
            $dateTo = $dates[1];

            $createStroller = Reservation::create([
                                                      'dateFrom' => new \DateTime($dateFrom),
                                                      'dateTo' => new \DateTime($dateTo),
                                                      'price' => $stroller->price,
                                                      'stroller_id' => $stroller->id,
                                                      'user_id' => $user->id
                                                  ]);

            if (!$createStroller) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving data');
            }

            DB::commit();
            return redirect()->route('index')->with('success', 'Reservation submited Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function cancel(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->canceledDate = now();
        $reservation->status = 'canceled';
        $reservation->save();

        return redirect()->route('reservation.list')
            ->with('success', 'Reservation canceled successfully');
    }
}
