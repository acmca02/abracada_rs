@php $user_info = Auth()->user() @endphp
@auth

    @include('frontend.story.index')
    @include('frontend.main_content.create_post')    

@endauth

<div id="timeline-posts">
    @include('frontend.main_content.posts',['type'=>'user_post'])
</div>

@include('frontend.main_content.scripts')
