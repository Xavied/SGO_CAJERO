<div class="form-group">
    {{ Form::label('emp_crg', 'Cargo') }}
    {{ Form::text('emp_crg', null, ['class' => 'form-control', 'id' => 'emp_crg']) }}
</div>
<div class="form-group">
    {{ Form::label('emp_ci', 'Cédula o Pasaporte') }}
    {{ Form::text('emp_ci', null, ['class' => 'form-control', 'id' => 'emp_ci']) }}
</div>
<div class="form-group">
    {{ Form::label('emp_nom', 'Nombre') }}
    {{ Form::text('emp_nom', null, ['class' => 'form-control', 'id' => 'emp_nom']) }}
</div>
<div class="form-group">
    {{ Form::label('emp_dir', 'Dirección') }}
    {{ Form::text('emp_dir', null, ['class' => 'form-control', 'id' => 'emp_dir']) }}
</div>
<div class="form-group">
    {{ Form::label('emp_telf', 'Teléfono') }}
    {{ Form::text('emp_telf', null, ['class' => 'form-control', 'id' => 'emp_telf']) }}
</div>

<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>
