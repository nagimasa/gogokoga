<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $service_name;
    private $name;
    private $kana_name;
    private $email;
    private $email_confirm;
    private $tel;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->service_name  = $inputs['service_name'];
        $this->name          = $inputs['name'];
        $this->kana_name     = $inputs['kana_name'];
        $this->email         = $inputs['email'];
        $this->email_confirm = $inputs['email_confirm'];
        $this->tel           = $inputs['tel'];
        $this->content       = $inputs['content'];
    }

    public function build()
    {
        return $this
        ->from('test@test.com')
        ->subject('お問い合わせありがとうございました')
        ->view('user.contact.mail')
        ->with([
            'service_name'  => $this->service_name,
            'name'          => $this->name,
            'kana_name'     => $this->kana_name,
            'email'         => $this->email,
            'email_confirm' => $this->email_confirm,
            'tel'           => $this->tel,
            'content'       => $this->content,
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contact Send Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
