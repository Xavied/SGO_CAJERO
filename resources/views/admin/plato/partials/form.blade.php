<div class="form-group">
    {{ Form::label('plt_nom', 'Nombre del plato') }}
    {{ Form::text('plt_nom', null, ['class' => 'form-control', 'id' => 'plt_nom']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_des', 'Descripción') }}
    {{ Form::textarea('plt_des', null, ['class' => 'form-control', 'id' => 'plt_des']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_tipo', 'Tipo') }}
	{{ Form::select('plt_tipo', array('Aperitivo' => 'Aperitivo', 'Sopa' => 'Sopa',
										'Plato_Fuerte' => 'Plato Fuerte', 'Ensalada' => 'Ensalada', 'Marisco' => 'Marisco',
										'Bebida' => 'Bebida', 'Postre' => 'Postre', 'promocion' => 'Promoción'
										),['class' => 'form-control', 'id' => 'plt_tipo']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_pvp', 'PVP') }}
    {{ Form::text('plt_pvp', null, ['class' => 'form-control', 'id' => 'plt_pvp']) }}
</div>
<div class="form-group">
    {{ Form::label('plt_visbl', 'Visible: ') }}
	<label>
		{{ Form::radio('plt_visbl', true) }} Si
	</label>
	<label>
		{{ Form::radio('plt_visbl', false) }} No
	</label>
</div>
<div class="form-group">
    {{ Form::label('plt_iva', 'IVA: ') }}
	<label>
		{{ Form::radio('plt_iva', 'true') }} Si
	</label>
	<label>
		{{ Form::radio('plt_iva', 'false') }} No
	</label>
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>
