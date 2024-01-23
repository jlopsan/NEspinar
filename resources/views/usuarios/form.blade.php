@extends("layouts.master")

@section("title", "Inserción de usuarios")

@section("header", "Inserción de usuarios")

@section("content")
@isset($usuarios)
<form action="{{ route('usuarios.update', ['usuario' => $usuarios->id]) }}" method="POST">
    @method("PUT")
    @else
    <form action="{{ route('usuarios.store') }}" method="POST">
        @endisset
        @csrf
        <div class="container-fluid">
            Nombre :<input class="form-control mb-3" type="text" name="name" value="{{$usuarios->name ?? '' }}">
            Correo:<input class="form-control mb-3" type="email" name="email" value="{{$usuarios->email ?? '' }}">
            Contraseña:<input class="form-control mb-3" type="password" name="password" value="{{$usuarios->password ?? '' }}">
            Tipo:
            <select class="form-select mb-3" name='type'>
                <option @if (isset($usuarios) && $usuarios->type == 'SuperAdmin')  selected @endif value='SuperAdmin'>Super Admin</option>
                <option @if (isset($usuarios) && $usuarios->type == 'Admin') selected @endif value='Admin'>Admin</option>
                <option @if (isset($usuarios) && $usuarios->type == 'Basico') selected @endif value='Basico'>Basico</option>
            </select>


            <input class="btn btn-dark center" type="submit" value="Enviar">
        </div>
    </form>
    @endsection