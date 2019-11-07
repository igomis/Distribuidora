<h3><img src='img/cesta.png' alt='Cesta' width='24' height='21'>Comanda</h3>
<hr />
@if (!empty($productosCar))
    @foreach ($productosCar as $productoCar)
        <form  method = 'POST'>
            <input type="text" style="width: 5em" disabled  value="{{$productoCar->name}}" />
            <input name = 'cod' type='hidden'  value = '{{$productoCar->id}}'>
            <input name = 'unidades' type='number' min = '1' value = "{{ $_SESSION['order'][$productoCar->id] }}" style="width: 3em">
            <input type = 'submit' style="width: 2em" name='actualizar' value='OK'>
            <input type = 'submit' style="width: 2em"  name='eliminar' value='X'>
        </form>
    @endforeach
    <form id='vaciar' action='deleteOrder.php' method='post'>
        <input type='submit' name='empty' class='boton' value='Buidar'  />
    </form>
    <form id='comprar' action='processOrder.php' method='post'>
        <input type='submit' name='buy' class='boton' value='Processar'  />
    </form>
@else
    <p>Buida</p>
@endif
