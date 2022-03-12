<div class="modal" id="addNewPerson">
    <a href="#closeall" class="closeall"><i class="fas fa-times"></i></a>
    <h3 class="title-modal">Adicionar nova pessoa</h3>
    <form action="{{route("store_pessoa")}}" method="post">
        @csrf
        <input type="email" placeholder="email" name="email" required>
        <input type="text" placeholder="senha" name="senha" required>
        <input type="text" placeholder="confirmar senha" name="confirmar_senha" required>
        <input type="text" placeholder="nome" name="nome" required>
        <input type="number" placeholder="idade" name="idade">
        <div class="text-center">
            <input type="submit" value="Cadastrar">
        </div>
    </form>
</div>