<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::join("tb_usuario", "tb_usuario.idUsuario", "tb_pessoa.idUsuario")->get();
        return view("admin.pessoa.read", compact("pessoas"));
    }


    public function store(Request $request)
    {
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
                        return back();
                    } catch (Throwable $th) {
                        DB::rollBack();
                        dd($th->getMessage());
                    }
                }else{
                    return back()->with("error", "Tem certeza que está pessoa está realmente viva? Confere a idade!");
                }
            }else{
                return back()->with("error", "senhas não conferem!");
            }
        }else{
            return back()->with("error", "já existe está conta!");
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "id" => "required",
            "email" => "email|required|min:7",
            "nome" => "required|min:3"
        ]);

        $user = Usuario::find($request->id);

        if($user){
            try {
                DB::beginTransaction();
                    Usuario::find($request->id)->update(["Email"=>$request->email]);
                    Pessoa::where("idUsuario", $request->id)->update(["idUsuario"=> $user->idUsuario, "Nome"=>$request->nome, "Idade"=>$request->idade]);
                DB::commit();
                return back();
            } catch (Throwable $th) {
                DB::rollBack();
                return dd($th->getMessage());
            }
        }
    }

    public function destroy($id)
    {

        $user = Usuario::find($id);

        if($user && $user->idUsuario != Auth::user()->idUsuario){
            try {
                $pessoa = Pessoa::where("idUsuario", $user->idUsuario)->delete();
                Usuario::destroy($id);
                return back();
            } catch (Throwable $th) {
                dd($th->getMessage());
            }
        }else{
            return back()->with("error", "usuario não existe ou está é sua conta!");
        }
    }
}
