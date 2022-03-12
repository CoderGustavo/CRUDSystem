@extends('admin.layout.app')
@section("title", "Lista de pessoas")

@section('content')
    @include('admin.pessoa.modals.create')
    @include('admin.pessoa.modals.update')
    @include('admin.pessoa.modals.delete')
    <main class="container">
        <h1>Lista de pessoas</h1>
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
        <table>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Idade</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pessoas as $pessoa)
                    <tr>
                        <td>{{$pessoa->idUsuario}}</td>
                        <td>{{$pessoa->Nome}}</td>
                        <td>{{$pessoa->Email}}</td>
                        <td>{{$pessoa->Idade}}</td>
                        <td class="actions">
                            <a href="#editPerson{{$pessoa->idUsuario}}" class="openmodal"><i class="fas fa-edit"></i></a>
                            <a href="#deletePerson{{$pessoa->idUsuario}}" class="openmodal"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection