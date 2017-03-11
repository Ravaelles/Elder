@extends(config('scaffold.layout'))

@section('html-title')
Choose model to scaffold
@endsection

@section('content')
<div class="page-header clearfix">
    <h4>
        Showing models possible to scaffold
    </h4>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th>Model</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($models as $file => $modelName)
                <tr>
                    <td>
                        <a class="btn btn-primary btn-app-blue"
                           href="{{ route(config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}"
                           >{{ $modelName }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection