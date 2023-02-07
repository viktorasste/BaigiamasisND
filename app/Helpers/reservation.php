<?php

if (! function_exists('get_reservation_total_price')) {
    function getReservationTotalPrice(App\Models\Reservation $reservation)
    {
        $start = new \Carbon\Carbon($reservation->dateFrom);
        $end = new \Carbon\Carbon($reservation->dateTo);
        $days = $start->diffInDays($end);

        return $days * $reservation->price;
    }
}
