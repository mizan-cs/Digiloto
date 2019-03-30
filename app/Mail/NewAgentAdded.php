<?php

namespace App\Mail;

use App\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewAgentAdded extends Mailable
{
    use Queueable, SerializesModels;
    public $agent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $agent = $this->agent;
        return $this->markdown('emails.agent.new_agent_added', compact('agent'));
    }
}
