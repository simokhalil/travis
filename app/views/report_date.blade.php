@extends('default')

@section('content')
<div class="tree">

    <?php
    $currentMonth="";
    $currentDay="";
    $currentHour="";
    $currentYear="";
    echo '<ul>';
    foreach($data['events'] as $e ){

        if((date_parse($e->Date)['month'] != $currentMonth || date_parse($e->Date)['year'] != $currentYear || date_parse($e->Date)['day'] != $currentDay || $currentHour != date_parse($e->Heure)['hour']) && $currentHour !="" ) {

            echo '</ul>';
            echo '</li>';
        }

        if((date_parse($e->Date)['month'] != $currentMonth || date_parse($e->Date)['year'] != $currentYear || date_parse($e->Date)['day'] != $currentDay) && $currentDay!="" ) {
            echo '</ul>';
            echo '</li>';
        }
        if((date_parse($e->Date)['month'] != $currentMonth || date_parse($e->Date)['year'] != $currentYear) && $currentMonth !="") {
            echo '</ul>';
            echo '</li>';

        }

        if(date_parse($e->Date)['month'] != $currentMonth || date_parse($e->Date)['year'] != $currentYear) {

            echo '<li>';
            echo '<span><i class="icon-calendar"></i> ' . date_parse($e->Date)['month'] . '/' . date_parse($e->Date)['year'] . '</span>';
            echo '<ul>';
        }

        if(date_parse($e->Date)['month'] != $currentMonth || date_parse($e->Date)['year'] != $currentYear || date_parse($e->Date)['day'] != $currentDay ) {
            echo '<li>';
            echo '<span class="badge badge-success"><i class="icon-minus-sign"></i> ' . date_parse($e->Date)['day'] . '/' . date_parse($e->Date)['month'] . '/' . date_parse($e->Date)['year'] . '</span>';
            echo '<ul>';
        }

        if(date_parse($e->Date)['month'] != $currentMonth || date_parse($e->Date)['year'] != $currentYear || date_parse($e->Date)['day'] != $currentDay || $currentHour != date_parse($e->Heure)['hour'] ) {
            echo '<li>';
            echo '<span><i class="icon-time"></i>' . date_parse($e->Heure)['hour'] . 'h</span>';
            echo '<ul>';
        }
        echo '<li>';
        echo '<span><i class="icon-time"></i>' . $e->Heure . ': '. $e->Titre.' </span>';
        echo '<li>';


        $currentYear = date_parse($e->Date)['year'];
        $currentMonth = date_parse($e->Date)['month'];
        $currentDay = date_parse($e->Date)['day'];
        $currentHour = date_parse($e->Heure)['hour'];

    }
    echo '</ul>';
    ?>
</div>
@endsection


@section('scripts')
<script>
    $(function () {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
    });
</script>
@endsection