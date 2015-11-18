@extends('app')

@section('htmlheader_title')
List of users
@endsection

@section('contentheader_title')
List of users
@endsection

@section('main-content')
<div class="row">
    <div class="box box-default">

        @if (count($users) > 0)
        <table class="table table-striped table-header-borderless table-hover">
            <thead>
            <th></th>
            <th>@sortablelink('name', 'Name')</th>
            <th>@sortablelink('role', 'Role')</th>
            <th>@sortablelink('email', 'Email')</th>
            <th style="width: 120px">@sortablelink('created_at', 'Registered')</th>
            <th></th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center" style="width: 120px;">
                        <!--<a class="btn btn-sm btn-custom" href="{{ route('user.show', ['id' => $user->id]) }}">Show</a>-->
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->role }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->created_at->format("Y-m-d") }}
                    </td>
                    <td>
                        <div title="{{ $user->isAdmin() ? "Can't delete admin" : "Delete" }}" >
                            <a class="btn btn-danger btn-sm {{ $user->isAdmin() ? "disabled" : "" }}" 
                               href="{{ route('user.destroy', ['id' => $user->id]) }}" 
                               onclick="return confirmDelete('Hold on!\n\nDo you really want to delete this user?\nThis operation is irreversible!')"><i class="fa fa-trash fa-lg"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->appends(\Input::except('page'))->render() !!}
        @else
        <p>No users</p>
        @endif

    </div>
</div>
@endsection