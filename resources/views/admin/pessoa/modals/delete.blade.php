@foreach ($pessoas as $pessoa)
    <div class="modal" id="deletePerson{{$pessoa->idUsuario}}">
        <a href="#closeall" class="closeall"><i class="fas fa-times"></i></a>
        <h3 class="title-modal">Deletar pessoa</h3>
        <form action="" method="post">
            @csrf
            <p class="text-center">Você deseja realmente deletar a pessoa: <strong>{{$pessoa->Nome}}</strong></p>
            <input type="hidden" name="id" required value="{{$pessoa->idUsuario}}">
            <a href="{{route("destroy_pessoa", $pessoa->idUsuario)}}" class="btn-del">Deletar</a>
        </form>
    </div>
@endforeach