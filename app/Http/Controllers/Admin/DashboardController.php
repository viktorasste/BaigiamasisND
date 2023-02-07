<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        $reservations = Reservation::select('price', 'created_at', 'dateFrom', 'dateTo')->get();
        $newReservations = Reservation::where(['status' => 'new'])->get();
        $approvedReservations = Reservation::where(['status' => 'approved'])->get();
        $canceledReservations = Reservation::where(['status' => 'canceled'])->get();

        $thisMonth = 0;
        $lastMonth = 0;
        $thisYear = 0;
        $lastYear = 0;
        foreach ($reservations as $reservation) {
            $createdAt = new \DateTime($reservation->created_at);
            if ($createdAt->format('Y') === (new \DateTime())->format('Y')) {
                $thisYear += $this->getReservationTotalPrice($reservation);
            }
            if ($createdAt->format('Y') === (new \DateTime('-1 year'))->format('Y')) {
                $lastYear += $this->getReservationTotalPrice($reservation);
            }
            if ($createdAt->format('Y-m') === (new \DateTime())->format('Y-m')) {
                $thisMonth += $this->getReservationTotalPrice($reservation);
            }
            if ($createdAt->format('Y-m') === (new \DateTime('-1 month'))->format('Y-m')) {
                $lastMonth += $this->getReservationTotalPrice($reservation);
            }
        }

        return view('admin.admin')->with([
                                             'newReservations' => $newReservations,
                                             'approvedReservations' => $approvedReservations,
                                             'countApproved' => count($approvedReservations),
                                             'countNew' => count($newReservations),
                                             'countCanceled' => count($canceledReservations),
                                             'thisMonthTotal' => $thisMonth,
                                             'lastMonthTotal' => $lastMonth,
                                             'thisYearTotal' => $thisYear,
                                             'lastYearTotal' => $lastYear,
                                         ]);
    }

    private function getReservationTotalPrice(Reservation $reservation)
    {
        $start = new \Carbon\Carbon($reservation->dateFrom);
        $end = new \Carbon\Carbon($reservation->dateTo);
        $days = $start->diffInDays($end);

        return $days * $reservation->price;
    }
}
