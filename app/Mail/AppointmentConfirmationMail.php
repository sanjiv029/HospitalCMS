<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $patient;

    public function __construct($appointment, $patient)
    {
        $this->appointment = $appointment;
        $this->patient = $patient;
    }

    public function envelope()
    {
        return new Envelope(
            subject: "Appointment Confirmation Mail",
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.appointment_confirmation',
        );
    }
}
