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
                    <a type="button" class="btn btn-green-dark" 
                       tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right"
                       data-content='@include("person.missions")'>{!! empty($person->job) ? "In village" : $person->job !!}</a>
                </td>
                <td class="left column-name">
                    {{ $person->name }}
                </td>
                <td class="left borderless-cell column-image">
                    {!! $person->unitImageWrapper() !!}

                    <script type="text/javascript">
                        window.initQueue.push(function () {
                            var unit = new Unit('{!! $person->unitJson() !!}');
                            unit.dir(DIR_RANDOM_NORTH());
                            unit.action(ACTION_IDLE);
                            unit.display(true);
                            
                            // Turn around
                            var turnBackDelay = rand(390, 800);
                            unit.animation(
                                {dir: DIR_SE},
                                turnBackDelay
                            );
                            
                            // Kneel before yo' masta'
                            var kneelDelay = rand(10, 100);
                            unit.animation(
                                {action: ACTION_PICK_UP},
                                kneelDelay
                            );
                    
                            // Equip spear
                            unit.animation(
                                {action: SPEAR_EQUIP},
                                rand(1, 300 - kneelDelay)
                            );
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