<div class="box box-fallout box-shadow">
    @if (count($persons) > 0)
    <table class="table table-borderless-header table-fallout persons">
        <thead>
        <th>Mission</th>
        <th>Name</th>
        <th></th>
        <th>Description</th>
        <th class="th-special-stat">S</th>
        <th class="th-special-stat">P</th>
        <th class="th-special-stat">E</th>
        <th class="th-special-stat">C</th>
        <th class="th-special-stat">I</th>
        <th class="th-special-stat">A</th>
        <th class="th-special-stat">L</th>
        </thead>

        <tbody>
            @foreach ($persons as $person)
            <tr class="">
                <td class="centered borderless-cell column-buttons" style="width: 120px;">
                    <!--                            <a class="btn btn-sm btn-green" href="{{ route('person.show', ['name' => str_slug($person->client_company), 'id' => $person->id]) }}">Show</a>-->
                    <!--                            <a type="button" class="btn btn-green-dark" @include('ui/popover', [
                                                   'title' => 'Choose job for this person',
                       'message' => @include("person.missions")
                                                   ])>{!! empty($person->job) ? "In village" : $person->job !!}</a>-->
                    <a type="button" class="btn btn-green-dark" 
                       tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right"
                       data-content='@include("person.missions")'>{!! empty($person->job) ? "In village" : $person->job !!}</a>
                </td>
                <td class="left column-name">
                    {{ $person->name }}
                </td>
                <td class="left borderless-cell column-image">
                    {!! $person->critterImageWrapper() !!}

                    <script type="text/javascript">
                        window.initQueue.push(function () {
                            var unit = new Unit('{!! $person->unitJson() !!}');
//                            unit.dir(DIR_RANDOM_SOUTH());
                            unit.dir(DIR_RANDOM_NORTH());
//                            unit.dir(DIR_SE);
                            unit.action(ACTION_IDLE);
//                                    unit.nextAnimate(
//                                            {action: SPEAR_UNEQUIP, dir: DIR_RANDOM_SOUTH()}, 
//                                            rand(1500, 2000)
//                                    );
//                                    unit.nextAnimate(
//                                            {action: SPEAR_EQUIP, dir: DIR_RANDOM_SOUTH()}, 
//                                            rand(500, 1500)
//                                    );
                            unit.display(true);
                            
                            // Turn around
                            unit.nextAnimate(
                                {dir: DIR_SE},
                                1100 + rand(1, 500)
                            );
//                            
//                            // Kneel to your master
                            unit.nextAnimate(
                                {action: ACTION_PICK_UP},
                                200 + rand(1, 500)
                            );
                    
                            // Equip spear
                            unit.nextAnimate(
                                {action: SPEAR_EQUIP},
                                rand(1, 200)
                            );
                    
                            // Idle spear
//                            unit.nextAnimate(
//                                {action: SPEAR_IDLE},
//                                rand(600, 1000)
//                            );
                        });
                    </script>
                </td>
                <td class="left">
                    {!! $person->descriptionAmong($persons) !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->S !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->P !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->E !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->C !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->I !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->A !!}
                </td>
                <td class="td-special-stat">
                    {!! $person->SPECIAL->L !!}
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