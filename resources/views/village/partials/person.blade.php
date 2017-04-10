<tr class="">
    <td class="centered borderless-cell column-buttons" style="width: 120px;">
        <!--        <a type="button" class="btn btn-green-dark" 
                   tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right"
                   data-content='@include("village.partials.jobs")'>
                    {!! $person->getJobToString() !!}
                </a>-->
        <a class="btn btn-green-dark" 
           data-toggle="popover" data-title="" data-placement="right"
           data-content='@include("village.partials.jobs")'>
            Test me
        </a>

        <button type="button" class="btn btn-primary rmodal"></button>

        <a class="btn btn-custom rmodal" href="{{ route('person.job.assign-explore', ['id' => $person->getId())]) }}">
            The Grand Functionality
        </a>
    </td>
    <td class="left column-name">
        {{ $person->name }}
    </td>
    <!--<td class="left borderless-cell column-image">-->
    <?php // {!! $person->unitImageWrapper() !!} ?>

<!--                    <script type="text/javascript">
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
                    </script>-->
    <!--</td>-->
    <td class="left">
        {!! $person->descriptionAmong($persons) !!}
    </td>
    <td class="td-special-stat">
        {!! $person->getS() !!}
    </td>
    <td class="td-special-stat">
        {!! $person->getA() !!}
    </td>
    <td class="td-special-stat">
        {!! $person->getI() !!}
    </td>
    <td class="td-special-stat">
        {!! $person->getC() !!}
    </td>
</tr>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
//        $('*:not[data-title!=""]').webuiPopover();
    });
</script>
@endpush