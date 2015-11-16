@extends('app')

@section('htmlheader_title')
- Home
@endsection

@section('contentheader_title')
@breadcrumbs('wasteland', 'Wasteland', 'village', 'Village', 'Home')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-fallout">
            {!! \App\Helpers\Image::gifFor(\App\Critter::WARRIOR_M, \App\Critter::ACTION_WALK, \App\Critter::DIR_E) !!}
            {!! \App\Helpers\Image::gifFor(\App\Critter::WARRIOR_M, \App\Critter::ACTION_HAND_COMBAT, \App\Critter::DIR_W) !!}

            @if (count($persons) > 0)
            <table class="table table-header-borderless agreements">
                <thead>
                <th>Name</th>
                <th>Strength</th>
                <th>Perception</th>
                <th></th>
            </thead>

                <tbody>
                    @foreach ($persons as $person)
                    <tr class="">
                        <td class="text-center" style="width: 120px;">
                            <a class="btn btn-sm btn-custom" href="{{ route('person.show', ['name' => str_slug($person->client_company), 'id' => $person->id]) }}">Show</a>
                        </td>
                        <td>
                            {{ $person->SPECIAL->strength }}
                        </td>
                        <td>
                            {{ $person->SPECIAL->perception }}
                        </td>
                        <td>
                            {{ $person->SPECIAL->endurance }}
                        </td>
                        <td>
                            {{ $person->SPECIAL->charisma }}
                        </td>
                        <td>
                            {{ $person->SPECIAL->intelligence }}
                        </td>
                        <td>
                            {{ $person->SPECIAL->agility }}
                        </td>
                        <td>
                            {{ $person->SPECIAL->luck }}
                        </td>
                        <td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--{ !! $persons->appends(\Input::except('page'))->render() !! }-->
            @else
            All of your tribemen are extinct like damned mammuts <img src="/img/emots/sad.png" class="emoticon" />
            @endif
        </div>
    </div>
</div>
@endsection
