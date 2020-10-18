<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
    </head>


    <h2>Formulario de contacto</h2>
    <form action={{route('contact')}} method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nombre</label>
            <input name="name" type="text">
        </div>
        <div class="form-group">
            <label for="name">mensaje</label>
            <input name="msg" type="text">
        </div>
        <div class="form-group">
            <button type="submit" id='btn-contact' class="btn">Enviar</button>
        </div>
    </form>
</html>
