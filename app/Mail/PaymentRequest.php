<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomImage;

class PaymentRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $credit_card;
    public $booking;
    public $room;
    public $image;
    public $stay_days;
    public function __construct(Booking $booking,Room $room,RoomImage $image,$credit_card,$stay_days)
    {
        $this->booking = $booking;
        $this->room = $room;
        $this->image = $image;
        $this->stay_days = $stay_days;
        $this->credit_card = $credit_card;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.paymentRequest');
    }
}
