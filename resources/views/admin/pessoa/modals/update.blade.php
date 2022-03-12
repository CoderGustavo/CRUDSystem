@foreach ($pessoas as $pessoa)
    <div class="modal" id="editPerson{{$pessoa->idUsuario}}">
        <a href="#closeall" class="closeall"><i class="fas fa-times"></i></a>
        <h3 class="title-modal">Editar pessoa</h3>
        <form action="{{route("update_pessoa")}}" method="post">
            @csrf
            <input type="hidden" name="id" required value="{{$pessoa->idUsuario}}">
            <input type="email" placeholder="email" name="email" required value="{{$pessoa->Email}}">
            <input type="text" placeholder="nome" name="nome" required value="{{$pessoa->Nome}}">
            <input type="number" placeholder="idade" name="idade" value="{{$pessoa->Idade}}">
            <p class="text-center">
                <input type="submit" value="Atualizar informações">
            </p>
        </form>
    </div>
@endforeach