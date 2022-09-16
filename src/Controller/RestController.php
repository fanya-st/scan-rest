<?php


namespace App\Controller;


use App\Auth\Command\AuthUser;
use App\Auth\Command\ChangePassword;
use App\Auth\Command\ConfirmByEmail;
use App\Auth\Command\CreateConfirmToken;
use App\Auth\Command\CreateRefreshToken;
use App\Auth\Command\CreateToken;
use App\Auth\Command\SignInUser;
use App\Helpers\Http;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swift_SmtpTransport;

class RestController
{
    private ContainerInterface $container;
    private \Swift_SmtpTransport $mail;

    // constructor receives container instance
    public function __construct(ContainerInterface $container,Swift_SmtpTransport $mail)
    {
        $this->container = $container;

        $mail->setUsername('your username');
        $mail->setPassword('your password');

        $this->mail = $mail;
    }

    public function test(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return Http::json($response,'Hello');
    }
    public function signByEmail(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data=$request->getParsedBody();

        $user=SignInUser::signByEmail($data['email'],$data['password']);
        $token=CreateToken::create($user->id,$this->container);
        $refresh=CreateRefreshToken::create($user->id,$this->container);
        CreateConfirmToken::create($user,$this->container,$this->mail);

        return Http::json($response,['refresh'=>$refresh,'token'=>$token]);
    }

    public function login(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data=$request->getParsedBody();

        $user=AuthUser::auth($data['email'],$data['password']);
        $token=CreateToken::create($user->id,$this->container);
        $refresh=CreateRefreshToken::create($user->id,$this->container);

        return Http::json($response,['refresh'=>$refresh,'token'=>$token]);
    }

    public function confirmByEmail(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $user=ConfirmByEmail::confirm($args['token']);
        $token=CreateToken::create($user->id,$this->container);
        $refresh=CreateRefreshToken::create($user->id,$this->container);

        return Http::json($response,['refresh'=>$refresh,'token'=>$token]);
    }

    public function changePassword(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data=$request->getParsedBody();
        //если токен истек то выкинет исключение
        $token=JWT::decode($data['token'],new Key($this->container->get('jwt-secret'),'HS256'));
        if(ChangePassword::change($token->user_id,$data['old_password'],$data['new_password']))
        {
            $user=User::findOne($token->user_id);
            $token=CreateToken::create($user->id,$this->container);
            $refresh=CreateRefreshToken::create($user->id,$this->container);
        }

        return Http::json($response,['refresh'=>$refresh,'token'=>$token]);
    }
}