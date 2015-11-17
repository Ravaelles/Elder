{!! BootForm::open([
'model' => $user, 
'update' => 'user'
]) !!}

<div class="box-body">
    {!! BootForm::text('name', 'Full name', null, ['disabled' => 'disabled']) !!}
    {!! BootForm::text('email', 'Email', null, ['disabled' => 'disabled']) !!}
</div><!-- /.box-body -->
<div class="box-footer">
    <a href="/home" class="btn btn-green-dark">Go back</a>
</div><!-- /.box-footer -->

{!! BootForm::close() !!}