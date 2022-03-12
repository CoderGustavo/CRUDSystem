@extends('../app')
@section("title", "login")

@section("content")
    <div class="container">
        <form action="{{route("login")}}" method="post" class="card-center">
            <h1>Login</h1>
            @csrf
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
            <div>
                <input type="submit" value="Acessar">
            </div>
            <a href="{{route("registerPage")}}">Ainda não possui conta? registre-se aqui!</a>
        </form>
    </div>
@endsection