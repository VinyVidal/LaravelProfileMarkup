@extends('templates/page/profile', ['user' => $user])

@section('title')
    {{ $user->fullName }}
@endsection

@section('inner-content')
    <h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Atividade Recente</h4>
    <div class="px-0 px-md-3 py-2">
        <div class="post border p-3">
            <div class="post-header">
                <div class="post-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div><div class="post-author link-body-underline font-weight-bold"> User FullName </div>
                <div class="post-header-info text-muted font-sm">7 h</div>
            </div><!--post-header-->

            <div class="clear"></div>

            <div class="post-content">
                <div class="post-description mt-2"> This is test </div>
                <div class="post-media mt-1 text-center"><img src="{{ asset('img/default-avatar.png') }}" alt="" class="img-fluid"></div>
            </div><!--post-content-->
            
            <div class="post-footer text-center mt-3 p-2 border-top border-bottom">
                <span class="post-likes clickable-lgray"><i class="far fa-thumbs-up fa-2x"></i> 100</span>
                {{-- <span class="mx-5"></span> --}}
                <a data-toggle="collapse" href="#collapsePost1" class="text-body">
                    <span class="post-comments-info clickable-lgray"><i class="far fa-comment fa-2x"></i> 5</span>
                </a>
                <div class="collapse mt-4 text-left" id="collapsePost1">
                    <div class="post-comment border-bottom pb-2">
                        <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                        <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                        <div class="post-comment-content font-sm">Comentário aleatório</div>
                        <div class="clear"></div>
                    </div><!--post-comment-->

                    <div class="post-comment mt-2 border-bottom pb-2">
                        <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                        <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                        <div class="post-comment-content font-sm">Comentário aleatório</div>
                        
                        <div class="clear"></div>
                    </div><!--post-comment-->

                    <div class="post-comment mt-2">
                        <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                        <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                        <div class="post-comment-content font-sm">Comentário aleatório</div>
                        <div class="clear"></div>
                    </div><!--post-comment-->
                </div><!-- collapse -->
            </div><!--post-footer-->
        </div><!--post-->

        <div class="post border p-3 mt-3">
            <div class="post-header">
                <div class="post-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div><div class="post-author font-weight-bold"> User FullName </div>
                <div class="post-header-info text-muted font-sm">7 h</div>
            </div><!--post-header-->

            <div class="clear"></div>

            <div class="post-content">
                <div class="post-description mt-2"> This is test </div>
                <div class="post-media mt-1 text-center"><img src="{{ asset('img/default-avatar.png') }}" alt="" class="img-fluid"></div>
            </div><!--post-content-->
            
            <div class="post-footer text-center mt-3 p-2 border-top border-bottom">
                <span class="post-likes clickable-lgray"><i class="far fa-thumbs-up fa-2x"></i> 100</span>
                {{-- <span class="mx-5"></span> --}}
                <a data-toggle="collapse" href="#collapsePost2" class="text-body">
                    <span class="post-comments-info clickable-lgray"><i class="far fa-comment fa-2x"></i> 5</span>
                </a>
                <div class="collapse mt-4 text-left" id="collapsePost2">
                    <div class="post-comment border-bottom pb-2">
                        <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                        <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                        <div class="post-comment-content font-sm">Comentário aleatório</div>
                        <div class="clear"></div>
                    </div><!--post-comment-->

                    <div class="post-comment mt-2 border-bottom pb-2">
                        <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                        <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                        <div class="post-comment-content font-sm">Comentário aleatório</div>
                        <div class="clear"></div>
                    </div><!--post-comment-->

                    <div class="post-comment mt-2">
                        <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                        <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                        <div class="post-comment-content font-sm">Comentário aleatório</div>
                        <div class="clear"></div>
                    </div><!--post-comment-->
                </div><!-- collapse -->
            </div><!--post-footer-->
        </div><!--post-->
    </div>
    
@endsection