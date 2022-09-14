<?php


namespace App\Controller;


use App\Auth\Command\AuthUser;
use App\Auth\Command\ConfirmByEmail;
use App\Auth\Command\CreateRefreshToken;
use App\Auth\Command\CreateToken;
use App\Auth\Command\SignInUser;
use App\Helpers\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RestController
{
    private ContainerInterface $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function test(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        ;
        // your code to access items in the container... $this->container->get('');

        return Http::json($response,User::query()->where('email','=','tech@alprint.org')->getModel()->get());
    }
    public function signByEmail(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data=$request->getParsedBody();

        $user=SignInUser::signByEmail($data['email'],$data['password']);
        $token=CreateToken::create($user->id,$this->container);
        $refresh=CreateRefreshToken::create($user->id,$this->container);

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
        $data=$request->getParsedBody();

        $user=ConfirmByEmail::confirm($data['token']);
        $token=CreateToken::create($user->id,$this->container);
        $refresh=CreateRefreshToken::create($user->id,$this->container);

        return Http::json($response,['refresh'=>$refresh,'token'=>$token]);
    }
}