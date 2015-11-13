<table class="table">
    <thead>
    <th>Name</th>
			<th>Description</th>
			<th>Base Value</th>
			<th>Image</th>
			<th>Dmg Low</th>
			<th>Dmg Hi</th>
			<th>Item Type</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($itemTypes as $itemType)
        <tr>
            <td>{!! $itemType->name !!}</td>
			<td>{!! $itemType->description !!}</td>
			<td>{!! $itemType->base_value !!}</td>
			<td>{!! $itemType->image !!}</td>
			<td>{!! $itemType->dmg_low !!}</td>
			<td>{!! $itemType->dmg_hi !!}</td>
			<td>{!! $itemType->item_type !!}</td>
            <td>
                <a href="{!! route('itemTypes.edit', [$itemType->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('itemTypes.delete', [$itemType->id]) !!}" onclick="return confirm('Are you sure wants to delete this ItemType?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
