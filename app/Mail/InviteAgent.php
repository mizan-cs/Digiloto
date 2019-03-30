<?php

namespace App\Mail;

use App\Agent;
use App\Invite;
use App\Organizer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteAgent extends Mailable
{
    use Queueable, SerializesModels;
    public $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invite = $this->invite;
        //dd($invite->organizer->title);
        return $this->from('support@digilotto.com')
                    ->markdown('emails.agent.invite', compact('invite'));
    }
}
