<div class="" style="width: 300px;">
    <div style="margin-bottom: 20px; text-align: center;">
        Choose job:
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <a data-href="{!! route('person.assign-job.idle', ['id' => $person->getId()]) !!}" class="btn btn-green-dark ajax-button-status" 
                   @include('ui.tooltip', ['message' => 'Will stay in band, gather food and water that can be found nearby. Will also fight if band gets attacked.'])>
                   In village
            </a>
            <!--                <a href="{!! route('person.assign-job.idle', ['id' => $person->getId()]) !!}" class="btn btn-green-dark ajax-button-status" 
                               @include('ui.tooltip', ['message' => 'Will stay in band, gather food and water that can be found nearby. Will also fight if band gets attacked.'])>
                        In village
                            </a>-->
            </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-green-dark"
                    @include('ui.tooltip', ['message' => 'Will scout new areas or scavenge in search of useful junk'])>
                    Explore
        </button>
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-green-dark"
                    @include('ui.tooltip', ['message' => 'Learn to craft new items and produce them'])>
                    Craft
        </button>
        </div>
        </div>
        <div class="row">
        </div>
    </div>
</div>