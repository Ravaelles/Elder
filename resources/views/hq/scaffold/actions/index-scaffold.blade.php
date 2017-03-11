@extends(config('scaffold.layout'))

<?php
// =========================================================================
if (!empty($scaffoldedObjects)) {
    $isAnyActionButton = count($rawObjects[0]->getScaffoldOption('actions')) < 4;
} else {
    $isCreateActionAllowed = false;
}
// =========================================================================
?>

@section('html-title')
@if ($model->getScaffoldOption('title') !== null)
{!! $model->getScaffoldOption('title') !!}
@else
{!! $modelName !!}s
@endif
@endsection

@section('hq-navbar')
@if ($model->getScaffoldOption('actions.create') !== false)
<a class="btn btn-success pull-right button-add" 
   href="{{ route(config('scaffold.route-base-name') . '.create', ['scaffold' => $modelName]) }}">
    <i class="fa fa-2x fa-plus-circle"></i> <span>Create</span>
</a>
@endif
@endsection

@section('content')
<div class="col-md-12">

    @if (count($scaffoldedObjects) == 0)
    <div class="gray center mtm" style="font-size: 20px">
        No objects
    </div>
    @else
    <table class="hq-table scaffold-table">
        <thead>
            <tr>
                @include('hq.scaffold.partials.list-fields')

                @if ($isAnyActionButton)
                <th class="text-right"></th>
                @endif
            </tr>
        </thead>

        <tbody>
            <?php
            $counter = 0;
            ?>
            @foreach ($scaffoldedObjects as $scaffoldedObject)
            <?php
            $rawObject = $rawObjects[$counter++];
            ?>
            <tr>
                <!--@ include('hq.scaffold.partials.list-object', ['mode' => 'index'])-->
                @include('hq.scaffold.partials.display-object', ['mode' => 'list'])

                @if ($isAnyActionButton)
                <!-- ACTIONS -->
                <td class="text-right">

                    @if ($rawObject->getScaffoldOption('actions.show') !== false && $rawObject->getScaffoldOption('actions.view') !== false)
                    <a class="btn btn-xs btn-primary" 
                       href="{{ route(config('scaffold.route-base-name') . '.show', 
                                   ['id' => $rawObject->getId(), 'scaffolded' => $modelName]) }}">
                        <i class="fa fa-eye"></i> <span>View</span>
                    </a>
                    @endif

                    @if ($rawObject->getScaffoldOption('actions.edit') !== false)
                    <a class="btn btn-xs btn-warning" 
                       href="{{ route(config('scaffold.route-base-name') . '.edit', 
                                   ['id' => $rawObject->getId(), 'scaffolded' => $modelName]) }}">
                        <i class="fa fa-pencil-square-o"></i> <span>Edit</span>
                    </a>
                    @endif

                    @if ($rawObject->getScaffoldOption('actions.delete') !== false)
                    <form action="{{ route(config('scaffold.route-base-name') . '.destroy', 
                                ['id' => $rawObject->getId(), 'scaffolded' => $modelName]) }}" 
                                method="POST" style="display: inline;" onsubmit="if (confirm('Delete? Are you sure?')) {
                                      return true;
                                  } else {
                                      return false;
                                  }
                                  ;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i> <span>Delete</span>
                        </button>
                    </form>
                    @endif

                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {!! $rawObjects->appends(['scaffold' => $modelName])->render() !!}

</div>
</div>

@if (count($rawObjects) > 0)
<!--{ { $rawObjects->links() }}-->
@endif
@endsection