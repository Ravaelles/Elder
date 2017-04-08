<div class="box box-fallout box-shadow">
    <div class="box-header">People</div>

    @if (count($persons) > 0)
    <table class="table table-borderless-header table-fallout persons tablesorter">
        <thead>
            <tr>
                <th>Task</th>
                <th>Name</th>
                <!--<th></th>-->
                <th>Personality</th>

            <th class="th-special-stat">
                <button type="button" class="btn-green-dark" @include('ui.tooltip', ['message' => 'Strength', 'location' => 'top'])>S</button>
            </th>
            <th class="th-special-stat">
                <button type="button" class="btn-green-dark" @include('ui.tooltip', ['message' => 'Agility', 'location' => 'top'])>A</button>
            </th>
            <th class="th-special-stat">
                <button type="button" class="btn-green-dark" @include('ui.tooltip', ['message' => 'Intelligence', 'location' => 'top'])>I</button>
            </th>
            <th class="th-special-stat">
                <button type="button" class="btn-green-dark" @include('ui.tooltip', ['message' => 'Charisma', 'location' => 'top'])>C</button>
            </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($persons as $person)
            @include('village.partials.person')
            @endforeach
        </tbody>
    </table>
    <!--{ !! $persons->appends(\Input::except('page'))->render() !! }-->
    @else
    All of your tribemen are extinct like damned mammoths <img src="/img/emots/sad.png" class="emoticon" />
    @endif
</div>