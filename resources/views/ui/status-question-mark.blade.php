@include('partials/ui/question-mark', [
'align' => 'left',
'message' => ("<ul>"
    . "<li><b>" . strtoupper(\App\Agreement::STATUS_CREATED) . ":</b> agreement created, but not yet sent to client"
        . "</li><li><b>" . strtoupper(\App\Agreement::STATUS_AWAITING_SIGNATURE) . ":</b> agreement sent to client and awaiting his signature"
        . "</li><li><b>" . strtoupper(\App\Agreement::STATUS_SIGNED) . ":</b> agreement has been signed by the client"
        . "</li></ul>")
        ])

        <!--. "</li><li><b>" . strtoupper(\App\Agreement::STATUS_REJECTED) . ":</b> agreement was rejected by the client"-->
        <!--. "</li><li>" . strtoupper(\App\Agreement::STATUS_CANCELED) . ": agreement was canceled by the "-->