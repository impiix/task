<?php

namespace AppBundle\Service;

class MailService
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $recipient;

    public function __construct(\Swift_Mailer $mailer, string $recipient)
    {
        $this->mailer = $mailer;
        $this->recipient = $recipient;
    }

    public function send()
    {
        $message = new \Swift_Message();
        $message->setTo($this->recipient);
        $message->setBody("Hey, new post has been added!", 'text\plain');
        $this->mailer->send($message);
    }
}
