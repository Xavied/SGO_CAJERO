<div class="form-group">
    {{ Form::label('plt_nom', 'Nombre del plato') }}
    {{ Form::text('plt_nom', null, ['class' => 'form-control', 'id' => 'plt_nom']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_des', 'Descripción') }}
    {{ Form::text('plt_des', null, ['class' => 'form-control', 'id' => 'plt_des']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_tipo', 'Tipo') }}
    {{ Form::text('plt_tipo', null, ['class' => 'form-control', 'id' => 'plt_tipo']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_pvp', 'PVP') }}
    {{ Form::text('plt_pvp', null, ['class' => 'form-control', 'id' => 'plt_pvp']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_iva', 'IVA') }}
    {{ Form::text('plt_iva', null, ['class' => 'form-control', 'id' => 'plt_iva']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_visbl', 'Visible') }}
    {{ Form::text('plt_visbl', null, ['class' => 'form-control', 'id' => 'plt_visbl']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>
