<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UsuarioController extends Controller
{
    public function loginPage()
    {
        return view("login.login");
    }

    public function login(Request $request){
        $user = Usuario::where("email", $request->email)->first();
        if($user){
            if(Hash::check($request->senha, $user->Senha)){
                // dd("certo");
                if(Auth::attempt(['Email' => $request->email, 'Senha' => "$request->senha"])){
                    return redirect()->route("list_pessoa");
                }else{
                    return back()->with(["error" => "credenciais incorretas"]);
                }
            }else{
                return back()->with(["error" => "credenciais incorretas"]);
            }
        }else{
            return back()->with(["error" => "Não existe um usuário com este e-mail!"]);
        }
    }

    public function registerPage(){
        return view("login.register");
    }

    public function register(Request $request){
        $this->validate($request, [
            "email" => "email|required|min:7",
            "senha" => "required|min:8",
            "confirmar_senha" => "required|min:8",
            "nome" => "required|min:3"
        ]);

        $user = Usuario::where("Email", $request->email)->first();
        
        if(!$user){
            if($request->senha === $request->confirmar_senha){
                if($request->idade < 200){
                    $password = Hash::make($request->senha);
                    try {
                        DB::beginTransaction();
                        $user = Usuario::create(["Email"=>$request->email,"Senha"=>$password]);
                        Pessoa::create(["idUsuario"=> $user->idUsuario, "Nome"=>$request->nome, "Idade"=>$request->idade]);
                        DB::commit();
                        return redirect()->route("loginPage");
                    } catch (Throwable $th) {
                        DB::rollBack();
                        return back()->with(["error" => "Algo aconteceu! tente novamente daqui alguns segundos!"]);
                    }
                }else{
                    return back()->with(["error" => "Tem certeza que você está realmente vivo? olha essa idade ai amigo!"]);
                }
            }else{
                return back()->with("senhas não conferem!");
            }
        }else{
            return back()->with("já existe está conta!");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
}
