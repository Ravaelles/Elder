{!! BootForm::open([
'model' => $user, 
'update' => 'user.password',
'id' => 'change-pass-form'
]) !!}

<div class="box-body">

    {!! BootForm::hidden('redirect_url', $request->url()) !!}
    <!--{!! BootForm::password('current_password', 'Current password') !!}-->
    {!! BootForm::password('password', 'New password', ['autocomplete' => 'false']) !!}
    {!! BootForm::password('password_confirmation', 'Repeat password', ['autocomplete' => 'false']) !!}
</div><!-- /.box-body -->
<div class="box-footer">
    <a href="/home" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Change password</button>
</div><!-- /.box-footer -->

{!! BootForm::close() !!}

<script type="text/javascript">
    window.initQueue.push(function() {
        $("#change-pass-form").submit(function() {
            showPleaseWait();
        });
    });
</script>