@extends('default')

@section('content')
<div class="tree">
    <ul>
        <li>
            <span><i class="icon-calendar"></i> 2013, Week 2</span>
            <ul>
                <li>
                    <span class="badge badge-success"><i class="icon-minus-sign"></i> Monday, January 7: 8.00 hours</span>
                    <ul>
                        <li>
                            <a href=""><span><i class="icon-time"></i> 8.00</span> &ndash; Changed CSS to accomodate...</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="badge badge-success"><i class="icon-minus-sign"></i> Tuesday, January 8: 8.00 hours</span>
                    <ul>
                        <li>
                            <span><i class="icon-time"></i> 6.00</span> &ndash; <a href="">Altered code...</a>
                        </li>
                        <li>
                            <span><i class="icon-time"></i> 2.00</span> &ndash; <a href="">Simplified our approach to...</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="badge badge-warning"><i class="icon-minus-sign"></i> Wednesday, January 9: 6.00 hours</span>
                    <ul>
                        <li>
                            <a href=""><span><i class="icon-time"></i> 3.00</span> &ndash; Fixed bug caused by...</a>
                        </li>
                        <li>
                            <a href=""><span><i class="icon-time"></i> 3.00</span> &ndash; Comitting latest code to Git...</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="badge badge-important"><i class="icon-minus-sign"></i> Wednesday, January 9: 4.00 hours</span>
                    <ul>
                        <li>
                            <a href=""><span><i class="icon-time"></i> 2.00</span> &ndash; Create component that...</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <span><i class="icon-calendar"></i> 2013, Week 3</span>
            <ul>
                <li>
                    <span class="badge badge-success"><i class="icon-minus-sign"></i> Monday, January 14: 8.00 hours</span>
                    <ul>
                        <li>
                            <span><i class="icon-time"></i> 7.75</span> &ndash; <a href="">Writing documentation...</a>
                        </li>
                        <li>
                            <span><i class="icon-time"></i> 0.25</span> &ndash; <a href="">Reverting code back to...</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <?php
    $currentMonth="";
    $currentDay="";
    $currentHour="";
        foreach($data['events'] as $e ){
            if(date_parse($e->Date)['month'] != $currentMonth && $currentMonth !="") {
                $currentDay="";

                echo '</li>';
                echo '</ul>';
            }

            if(date_parse($e->Date)['month'] != $currentMonth) {
                echo '<ul>';
                echo '<li>';
                echo '<span><i class="icon-calendar"></i> ' . date_parse($e->Date)['month'] . '/' . date_parse($e->Date)['year'] . '</span>';
            }

            if(date_parse($e->Date)['day'] != $currentDay && date_parse($e->Date)['month'] == $currentMonth && $currentDay != ""){
                echo '</li>';
                echo '</ul>';
            }
            if(date_parse($e->Date)['day'] != $currentDay && date_parse($e->Date)['month'] == $currentMonth){
                echo '<ul>';
                echo '<li>';
                echo '<span class="badge badge-success"><i class="icon-minus-sign"></i> '.date_parse($e->Date)['day'].'/'.date_parse($e->Date)['month'].'/'.date_parse($e->Date)['year'].'</span>';


            }
            $currentDay=date_parse($e->Date)['day'];


            $currentMonth=date_parse($e->Date)['month'];
        }
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