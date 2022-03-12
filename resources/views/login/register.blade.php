@extends('../app')
@section("title", "cadastro")

@section("content")
    <div class="container">
        <form action="{{route("register")}}" method="post" class="card-center">
            @csrf
            <h1>Cadastro</h1>
            @if($errors->any())
                <ul class="error_view">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>    
                    @endforeach
                </ul>
            @endif
            @if(session("error"))
                <div class="error_view">
                    {{session("error")}}
                </div>
            @endif
            <input type="email" placeholder="email" name="email" required>
            <input type="text" placeholder="senha" name="senha" required>
            <input type="text" placeholder="confirmar senha" name="confirmar_senha" required>
            <input type="text" placeholder="nome" name="nome" required>
            <input type="number" placeholder="idade" name="idade">
            <input type="submit" value="Cadastrar">
            <a href="{{route("loginPage")}}">Já possui conta? logue-se</a>
        </form>
    </div>
@endsection