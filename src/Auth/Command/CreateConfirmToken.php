<?php


namespace App\Auth\Command;


use App\Models\User;
use App\Models\UserConfirmToken;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;
use Swift_Mailer;
use Swift_Message;

class CreateConfirmToken
{
    public static function create(User $user, ContainerInterface $container, \Swift_SmtpTransport $mail): void
    {
        $conf = [
            "iss" => "scan",
            "aud" => "scan",
            "iat" => new \DateTimeImmutable(),
            "user_uuid" => $user->id,
        ];
        $confirm=new UserConfirmToken();
        $confirm->user_id=$user->id;
        $confirm->token=JWT::encode($conf,$container->get('jwt-secret'),'HS256');
        $confirm->save();

        //Отправка почты с кодом подтверждения
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($mail);

        // Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo([$user->email => 'A name'])
            ->setBody('/sign-confirm-email/'.$confirm->token);
        //
        // Send the message
        $mailer->send($message);
    }
}