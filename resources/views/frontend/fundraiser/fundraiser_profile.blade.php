@php
    $raised_amount = $campaign->raised_amount;
    $goal_amount = $campaign->goal_amount;
    $value = ($raised_amount * 100) / $goal_amount;
    
    $postOfThisEvent = \App\Models\Posts::where('publisher', 'fundraiser')
        ->where('publisher_id', $campaign->id)
        ->first();
    if (!empty($postOfThisEvent->post_id)) {
        $postId = $postOfThisEvent->post_id;
    } else {
        $postId = 0;
    }
@endphp

<main class="main new_fun_area">
    {{-- <div class="container"> --}}
        <div class="row">
           
            <div class=" col-lg-12 col-md-12 mb-12">
                <div class="fund-profile-area fund_profile">
                    <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                    <!-- Profile Cover Photo -->
                    <div class="fund-profile-cover">
                        @if ($campaign->cover_photo != '')
                            <img src="{{ asset('assets/frontend/images/campaign/' . $campaign->cover_photo) }}"
                                class="card-img-top" alt="blog">
                        @else
                            <img src="{{ asset('storage/blog/coverphoto/default/default.jpg') }}" class="card-img-top"
                                alt="blog">
                        @endif
                    </div>

                    <div class="fund-profile-info">
                        <div class="fund-profile-img">
                            <a href="#"><img src="{{ get_user_image($campaign->user_id, 'optimized') }}"
                                    alt="profile"></a>
                        </div>
                        <div class="found-profile-option d-flex justify-content-end">
                            <div class="post-controls dropdown dotted">
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="profile-name-title">
                            <h1 class="text_22">{{ $campaign->title }}</h1>
                            <div class="profile-title-privacy  align-items-baseline">
                                <p class="text_16"><span>{{get_phrase('Fundraiser for')}}</span> {{ $campaign->title }} <span>{{get_phrase('by')}}</span>
                                    {{ $campaign->name }} <a href="#"><img
                                            src="{{ asset('assets/frontend/css/fundraiser/images/fundraiser/privacy.svg') }}"
                                            alt="privacy"></a></p>

                            </div>
                        </div>
                        <div class="donate-share d-flex">
                            {{-- donate button --}}
                            @if ($days_left > 0 && $campaign->user_id != auth()->user()->id)
                                <a href="javascript: void(0);" class="btn_2 donate"
                                    onclick="ajaxModal('{{ route('fundraiser.model', [$modal, 'id' => $campaign->id]) }}','{{ get_phrase('Donate') }}')"><img
                                        src="{{ asset('assets/frontend/css/fundraiser/images/fundraiser/donate2.svg') }}"
                                        alt="">
                                    {{get_phrase('Donate')}}</a>
                            @elseif($days_left > 0 && $campaign->user_id == auth()->user()->id)
                            @else
                            @endif


                            {{-- share button --}}
                            @if ($days_left > 0)
                                <span data-bs-toggle="modal" data-bs-target="">
                                    <a href="javascript:void(0)" class="btn_2 end_btn"
                                    onclick="showCustomModal('{{ route('load_modal_content', ['view_path' => 'frontend.main_content.share_post_modal', 'post_id' => $postId, 'identifire' => 'fundraiser']) }}', '{{ get_phrase('Share Campaign') }}');">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path id="Path 295" d="M13.3454 12.5807C12.7256 12.5834 12.1291 12.8177 11.6731 13.2377L5.58982 9.69689C5.63686 9.50116 5.6626 9.30092 5.6666 9.09965C5.6626 8.89839 5.63686 8.69814 5.58982 8.50241L11.6049 4.99576C12.0355 5.39434 12.5903 5.63245 13.1759 5.67002C13.7615 5.70759 14.3422 5.54234 14.8203 5.20206C15.2983 4.86178 15.6446 4.36724 15.8009 3.80162C15.9571 3.23601 15.9138 2.63384 15.6782 2.0964C15.4426 1.55897 15.0291 1.11907 14.5073 0.850704C13.9855 0.582337 13.3871 0.501877 12.8129 0.622861C12.2387 0.743845 11.7237 1.05889 11.3545 1.515C10.9854 1.97111 10.7845 2.54045 10.7858 3.12725C10.7898 3.32851 10.8156 3.52875 10.8626 3.72449L4.84753 7.23114C4.48321 6.89006 4.02713 6.66292 3.5354 6.57767C3.04366 6.49242 2.53774 6.55278 2.07987 6.75133C1.62199 6.94988 1.23215 7.27795 0.958313 7.69518C0.684471 8.11241 0.538574 8.60059 0.538574 9.09965C0.538574 9.59872 0.684471 10.0869 0.958313 10.5041C1.23215 10.9214 1.62199 11.2494 2.07987 11.448C2.53774 11.6465 3.04366 11.7069 3.5354 11.6216C4.02713 11.5364 4.48321 11.3092 4.84753 10.9682L10.9223 14.5175C10.8781 14.6991 10.8552 14.8852 10.8541 15.0721C10.8541 15.5648 11.0002 16.0465 11.2739 16.4562C11.5477 16.8659 11.9368 17.1852 12.392 17.3738C12.8472 17.5623 13.3482 17.6117 13.8314 17.5155C14.3147 17.4194 14.7586 17.1821 15.1071 16.8337C15.4555 16.4853 15.6928 16.0414 15.7889 15.5581C15.885 15.0748 15.8357 14.5739 15.6471 14.1187C15.4586 13.6634 15.1392 13.2743 14.7295 13.0006C14.3198 12.7268 13.8382 12.5807 13.3454 12.5807ZM13.3454 2.27405C13.5142 2.27405 13.6791 2.32408 13.8194 2.41784C13.9597 2.51159 14.0691 2.64484 14.1337 2.80074C14.1982 2.95664 14.2151 3.12819 14.1822 3.2937C14.1493 3.4592 14.068 3.61123 13.9487 3.73055C13.8294 3.84987 13.6774 3.93113 13.5119 3.96405C13.3464 3.99697 13.1748 3.98008 13.0189 3.9155C12.863 3.85092 12.7298 3.74157 12.636 3.60126C12.5422 3.46095 12.4922 3.29599 12.4922 3.12725C12.4922 2.90096 12.5821 2.68395 12.7421 2.52394C12.9021 2.36394 13.1191 2.27405 13.3454 2.27405ZM3.107 9.95285C2.93825 9.95285 2.7733 9.90281 2.63299 9.80906C2.49268 9.71531 2.38332 9.58206 2.31875 9.42616C2.25417 9.27026 2.23727 9.09871 2.27019 8.9332C2.30311 8.7677 2.38437 8.61567 2.5037 8.49635C2.62302 8.37703 2.77504 8.29577 2.94055 8.26285C3.10605 8.22993 3.2776 8.24682 3.43351 8.3114C3.58941 8.37597 3.72266 8.48533 3.81641 8.62564C3.91016 8.76595 3.9602 8.93091 3.9602 9.09965C3.9602 9.32594 3.87031 9.54295 3.7103 9.70296C3.5503 9.86296 3.33328 9.95285 3.107 9.95285ZM13.3454 15.9423C13.1767 15.9423 13.0117 15.8923 12.8714 15.7985C12.7311 15.7048 12.6217 15.5715 12.5572 15.4156C12.4926 15.2597 12.4757 15.0882 12.5086 14.9227C12.5415 14.7572 12.6228 14.6051 12.7421 14.4858C12.8614 14.3665 13.0135 14.2852 13.179 14.2523C13.3445 14.2194 13.516 14.2363 13.6719 14.3009C13.8278 14.3654 13.9611 14.4748 14.0548 14.6151C14.1486 14.7554 14.1986 14.9204 14.1986 15.0891C14.1986 15.3154 14.1087 15.5324 13.9487 15.6924C13.7887 15.8524 13.5717 15.9423 13.3454 15.9423Z" fill="#636363"/>
                                        </svg>
                                        {{ get_phrase('Share') }}
                                    </a>
                                </span>
                            @elseif($days_left <= 0)
                                <br>
                            @else
                                <br>
                            @endif

                        </div>
                    </div>

                </div>


                <div class="fund-profile-goal-area border-none bg-white radius-8 mt-12 mb-12">
                    <h3 class="text_22">{{get_phrase('Goal')}}</h3>
                    <div class="goal-date">
                        @if ($days_left > 0)
                            <p class="text_16">{{ $days_left }} <span>{{get_phrase('days left')}}</span></p>
                        @else
                            <p class="text_16">{{get_phrase('Campaign expired')}}</p>
                        @endif
                    </div>
                    <div class="card-progress goal-progress d-flex justify-content-between align-items-center">
                        <progress id="progress_1" value="{{ $value }}" max="100"></progress>
                        <p class="card-progress-value values">{{ number_format($value, 2) }}%</p>
                    </div>
                    <div class="goal-raised">
                        <p class="pera_text">{{get_phrase('Raised :')}} <span
                                class="@if ($raised_amount == $goal_amount) text_green @else text_purple @endif">{{ currency($raised_amount) }}</span>
                            {{get_phrase('. Goal :')}}
                            <span class="text_green">{{ currency($goal_amount) }}
                        </p>
                    </div>

                </div>


                <div class="fund-profile-about-area border-none bg-white radius-8">
                    <h3 class="text_22">{{get_phrase('About')}}</h3>
                    <div class="calender-date d-flex align-items-center" id="see-more-lines">
                        <img src="{{ asset('assets/frontend/css/fundraiser/images/fundraiser/calender.svg') }}"
                            alt="calender">
                        <p class="pera_text">{{ date('d-F-Y', strtotime($campaign->created_at)) }}</p>
                    </div>
                    <p class="pera_text">{{ $campaign->description }}</p>
                    {{-- <div class="about-see-more-btn mt-12">
                        <a href="#" class="text_16 text_purple" id="see-btn">{{get_phrase('See More')}}</a>
                    </div> --}}
                </div>
            </div>

        </div>
    {{-- </div> --}}
    <!-- container end -->
    @include('frontend.common_scripts')
    @include('backend.modal')
    @include('frontend.initialize')
</main>

<script>
    $(document).ready(function() {
        var content = $('.preview_tex').height();
        $('.preview_tex').css('height', '130px');
        if (content > 110) {
            $('#see-btn').click(function(e) {
                e.preventDefault();
                $('.pera_text').removeClass('preview_tex');
                $('.pera_text').css('height', 'auto');
                $(this).remove();
            });
        } else {
            $('#see-btn').remove();
        }
    });
</script>
