@php
    $query = DB::table('paid_content_creators')
        ->where('user_id', auth()->user()->id)
        ->first();

    $blockedByUser = DB::table('block_users')->where('user_id', auth()->user()->id)->pluck('block_user')->toArray();
    $blockedByOthers = DB::table('block_users')->where('block_user', auth()->user()->id)->pluck('user_id')->toArray();
@endphp

<div class="settings-wraper paid_wraper overflow-visible">
    {{-- become a paid content creator --}}
    <div class="bg-white box-shadow-5 p-20 mb-20 radius-8 text-center">
        @if ($query)
            @if ($query->status == -1)
                <h3 class="fz-28-sb-38-black m-0">{{ get_phrase('Please wait, Admin will response soon.') }}</h3>
            @elseif($query->status == 0)
                <h3 class="fz-28-sb-38-black m-0">{{ get_phrase('Admin temporarily deactivated your page.') }}</h3>
            @endif
        @else
            @include('frontend.paid_content.get_started')
        @endif
    </div>

    <div class="bg-white box-shadow-5 radius-8 p-20 px-20">
        <div class="d-flex flex-wrap g-15 mb-20">
            @include('frontend.paid_content.search', ['type' => 'creator'])
        </div>

        <!-- Creator list -->
        @if ($creators->count() > 0)
            <div class="creator-items-wrap">
                <div class="row">
                    @foreach ($creators as $creator)
                        @php
                            if (in_array($creator->user_id, $blockedByUser) || in_array($creator->user_id, $blockedByOthers)) {
                                continue;
                            }
                        @endphp
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-12">
                            <a href="{{ route('page.view', ['page' => $creator->title, 'id' => $creator->user_id]) }}" class="crator-items creator_new">
                                <img src="{{ asset('assets/frontend/images/' . $creator->cover_photo) }}" alt="" />
                                <p class="link">{{ Str::limit($creator->title, 30) }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="no-package d-flex justify-content-center align-items-center py-4 mt-3">
                <p class="text-16px fw-bolder" style="color: #101010">{{ get_phrase('No creator is available') }}</p>
            </div>
        @endif
    </div>
</div>
