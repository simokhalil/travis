@extends('default')

@section('title')
    Détails des forums
@endsection

@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <a href="#">Forums</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Détails</a></li>
    </ul>

    <h1>Liste des foums et des messages</h1>
    <div class="tree well">
        <ul>
            @foreach($data['forums'] as $forum)
                <li>
                    <span><i class="icon-folder-open"></i>Forum {{$forum}}</span> <a href=""></a>
                    <ul>
                        <?php $i = 0; ?>
                        @foreach($data['sujetsForum'] as $sujetForum)


                            @if($sujetForum==$forum)

                                <li>

                                    <span><i class="icon-minus-sign"></i> Sujet  {{$data['sujetSujet'][$i]}}</span> <a
                                            href="">Par user : {{$data['sujetUser'][$i]}} le {{$data['sujetDate'][$i]}}
                                        à {{$data['sujetHeure'][$i]}} </a>
                                    <ul>
                                        <?php $j = 0; ?>
                                        @foreach($data['msgSujet'] as $msgSujet)


                                            @if($msgSujet==$data['sujetSujet'][$i])

                                                <li>
                                                    <span><i class="icon-leaf"></i> Message {{$data['msgMsg'][$j]}} </span>
                                                    <a href="">{{$data['msgUser'][$j]}} a {{$data['msgTitre'][$j]}}
                                                        le {{$data['msgDate'][$i]}} à {{$data['msgHeure'][$i]}} </a>
                                                </li>
                                                <?php $j++;?>
                                            @endif

                                        @endforeach
                                    </ul>
                                </li>


                                <?php $i++;?>
                            @endif

                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').parent('li.parent_li').find(' > ul > li').hide();
            $('.tree li.parent_li > span').attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
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