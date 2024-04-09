<?php

namespace App\Mail;

//use App\Http\Controllers\CommentaireController as ControllersCommentaireController;
use App\Models\Commentaire;
//use App\Models\CommentaireController;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ConfirmationCommentaire extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected Commentaire $commentaire, protected String $choix)
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
       // var_dump($this->commentaire->sujet);

        return new Envelope(
            from: new Address(Auth::user()->email, Auth::user()->name),
            replyTo: [
                new Address('ameber22@gmail.com', 'Amélie Bergeron'),
            ],
            subject: 'Votre '. $this->choix . ' a bien été ' . (($this->choix === "question") ? 'reçue' : 'reçu'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'courriel.confirmationCourriel',
            with: [
                'choix' => $this->choix,
                'sujet' => $this->commentaire->sujet,
                'messages' => $this->commentaire->message,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
