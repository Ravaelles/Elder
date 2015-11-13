<!-- Name Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('description', 'Description:') !!}
	{!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('image', 'Image:') !!}
	{!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Type Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('item_type', 'Item Type:') !!}
	{!! Form::select('item_type', [ 'WeaponMelee' => 'WeaponMelee', 'WeaponSmall' => 'WeaponSmall', 'WeaponBig' => 'WeaponBig', 'WeaponEnergy' => 'WeaponEnergy', 'Other' => 'Other', 'Drug' => 'Drug', 'Currency' => 'Currency' ], null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
