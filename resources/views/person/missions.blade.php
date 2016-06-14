<div class="popover-title">Choose job for this person</div>

<div class="" style="width: 300px;">
    <div style="margin-bottom: 20px; text-align: center;">
        Choose job:
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-4"><button type="button" class="btn btn-green-dark" 
                                          @include('ui.tooltip', ['message' => 'Will stay in band, gather food and water that can be found nearby. Will also fight if band gets attacked.'])
                                          >In band</button></div>
            <div class="col-sm-4"><button type="button" class="btn btn-green-dark"
                                          @include('ui.tooltip', ['message' => 'Will scout new areas or scavenge in search of useful junk'])
                                          >Explore</button></div>
            <div class="col-sm-4"><button type="button" class="btn btn-green-dark"
                                          @include('ui.tooltip', ['message' => 'Learn to craft new items and produce them'])
                                          >Craft</button></div>
        </div>
        <div class="row">
        </div>
    </div>
</div>