<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<div class="page-wrap">
    <div class="product-form new_job_f mb-3 bg-white p-3 pb-12 radius-8">
        <div class="nm_place njob d-flex pagetab-head border-none  align-items-center justify-content-between" >
            <h1 class="h3">{{get_phrase('Jobs')}}</h1>
            <div class="btn-inline ">
                <a href="{{route('create.job')}}" class="btn common_btn @if(Route::currentRouteName() == 'create.job') primary @else dash @endif "> <i class="fa fa-circle-plus me-2"></i>{{ get_phrase('Create Job') }}</a>
            </div>
        </div>
        <div class="gr-search mt-3">
            <form action="{{ route('search.job') }}" class="ag_form" method="GET">
                <input type="text" class="bg-secondary form-control  rounded" name="search" value="@if(isset($_GET['search'])) {{ $_GET['search'] }} @endif" placeholder="Search Job">
                <span class="i fa fa-search"></span>
            </form>
        </div>
        <ul class="Etab j_etab d-flex ">
            <li><a href="{{ route('jobs') }}" class=" @if (Route::currentRouteName() == 'jobs') actives @endif "> {{get_phrase('Explore Jobs')}}</a></li>
             <li><a href="{{route('job.myjob')}}" class="@if(Route::currentRouteName() == 'job.myjob') actives  @endif">{{get_phrase('My Jobs')}} </a></li>
             <li><a href="{{route('job.save.view')}}" class="@if(Route::currentRouteName() == 'job.save.view') actives @endif">{{get_phrase('Saved Jobs')}}</a></li>
             <li><a href="{{route('job.my.apply.list')}}" class="@if(Route::currentRouteName() == 'job.my.apply.list') actives @endif">{{get_phrase('My Application')}}</a></li>
             <li><a href="{{route('job.payment.history')}}" class="@if(Route::currentRouteName() == 'job.payment.history') actives @endif">{{get_phrase('History')}}</a></li>
         </ul>
    </div>
    
    <div class="g-3 blog-cards mt-3" >
        @if(count($job_save) > 0)
        <div class="bg-white radius-8 p-20">
            <div class="row" id="jobdatashow"> 
                @foreach($job_save as $save)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 h-100 my-1 single-item-countable" id="job-{{ $save->id }}">
                        @php 
                        $job =  App\Models\Job::where('id', $save->job_id)->first();
                    @endphp
                        <article class="single-entry job-single h-100 p-0">
                            <a href="#">
                                <div class="entry-img thumbnail-210-200" style="background-image: url('{{ get_job_image($job->thumbnail,'thumbnail') }}')">
                                    <span class="date-meta">{{currency($job->starting_salary_range)}} - {{currency($job->ending_salary_range)}} </span>

                                    @php
                                    $wishlist = App\Models\JobWishlist::where('user_id', auth()->user()->id)->where('job_id', $job->id)->first();
                                    @endphp
                                
                                    <span class="heart-icon icon2" id="wishlist-icon{{$job->id}}" onclick="follow_toggle('{{route('job.follow',['id'=>$save->job_id, 'user_id' => auth()->user()->id])}}','{{$save->job_id}}')">
                                        @if(!$wishlist)
                                            <i class="fa-regular  fa-heart"></i>
                                            @else
                                            <i class="fa-solid fa-heart"></i>
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <div class="entry-txt jEntry p-8">
                        
                                <a href="{{route('job.single.details',$job->id)}}">
                                    <h4>{{ Str::limit(strip_tags($job->title), 35) }}</h4>
                                </a>
                            <ul class="items-local">
                                    <li> 
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.99673 11.118V9.42664" stroke="#8C8A95" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1266 3.55347C13.2533 3.55347 14.1599 4.4668 14.1599 5.59347V7.8868C12.5199 8.8468 10.3533 9.4268 7.99327 9.4268C5.63327 9.4268 3.47327 8.8468 1.83327 7.8868V5.5868C1.83327 4.46013 2.7466 3.55347 3.87327 3.55347H12.1266Z" stroke="#8C8A95" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10.3301 3.55059V3.30659C10.3301 2.49325 9.67007 1.83325 8.85674 1.83325H7.13674C6.32341 1.83325 5.66341 2.49325 5.66341 3.30659V3.55059" stroke="#8C8A95" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M1.84959 10.322L1.97559 11.9947C2.06093 13.122 3.00026 13.9934 4.13026 13.9934H11.8629C12.9929 13.9934 13.9323 13.122 14.0176 11.9947L14.1436 10.322" stroke="#8C8A95" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{$job->type}}
                                </li>
                                <li>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.66666 7.00038C9.66666 6.07953 8.9205 5.33337 8.00033 5.33337C7.07949 5.33337 6.33333 6.07953 6.33333 7.00038C6.33333 7.92055 7.07949 8.66671 8.00033 8.66671C8.9205 8.66671 9.66666 7.92055 9.66666 7.00038Z" stroke="#8C8A95" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99967 14C7.20069 14 3 10.5989 3 7.04219C3 4.25776 5.23807 2 7.99967 2C10.7613 2 13 4.25776 13 7.04219C13 10.5989 8.79866 14 7.99967 14Z" stroke="#8C8A95" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{$job->location}}
                                    </li>
                            </ul>
                                <ul class="job-btn">
                                    <li><a href="{{route('job.single.details',$job->id)}}" class="btn btn-primary w-100">{{get_phrase('View Details')}}</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="no_data j_nodata mt-3 bg-white radius-8 p-20">
            <div class="no_data_img">
                <span><svg width="1447" height="1374" viewBox="0 0 1447 1374" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_60_31)">
                    <rect x="376" y="70" width="884" height="166" rx="83" fill="#EDEDED"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M43 429.5C43 348.038 109.038 282 190.5 282H1280.5C1361.96 282 1428 348.038 1428 429.5C1428 510.962 1361.96 577 1280.5 577H1239.98C1202.84 607.718 1179.55 651.899 1179.55 701C1179.55 755.127 1207.85 803.275 1251.8 834H1284.5C1374.25 834 1447 906.754 1447 996.5C1447 1086.25 1374.25 1159 1284.5 1159H186.5C96.7537 1159 24 1086.25 24 996.5C24 906.754 96.7537 834 186.5 834H219.402C263.353 803.275 291.657 755.127 291.657 701C291.657 651.899 268.365 607.718 231.23 577H190.5C109.038 577 43 510.962 43 429.5Z" fill="#EDEDED"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M289.939 1052.15L290.909 1044.72L291.879 1037.28C295.512 1037.75 299.224 1038 303 1038H317.833V1045.5V1053H303C298.573 1053 294.214 1052.71 289.939 1052.15ZM822.167 1053V1045.5V1038H837C840.776 1038 844.488 1037.75 848.121 1037.28L849.091 1044.72L850.061 1052.15C845.786 1052.71 841.427 1053 837 1053H822.167ZM875.279 1045.41L872.406 1038.48L869.533 1031.56C876.435 1028.69 882.885 1024.94 888.739 1020.45L893.308 1026.39L897.878 1032.34C890.997 1037.63 883.409 1042.04 875.279 1045.41ZM916.34 1013.88L910.393 1009.31L904.446 1004.74C908.945 998.885 912.694 992.435 915.556 985.533L922.484 988.406L929.412 991.279C926.041 999.409 921.628 1007 916.34 1013.88ZM317.833 201H303C298.573 201 294.214 201.288 289.939 201.845L290.909 209.282L291.879 216.719C295.512 216.245 299.224 216 303 216H317.833V208.5V201ZM264.721 208.588L267.594 215.516L270.467 222.444C263.565 225.306 257.115 229.055 251.261 233.554L246.692 227.607L242.122 221.66C249.003 216.372 256.591 211.959 264.721 208.588ZM223.66 240.122L229.607 244.692L235.554 249.262C231.055 255.115 227.306 261.565 224.444 268.467L217.516 265.594L210.588 262.721C213.959 254.591 218.372 247.003 223.66 240.122ZM203 938.182H210.5H218V953C218 956.776 218.245 960.488 218.719 964.121L211.282 965.091L203.845 966.061C203.288 961.786 203 957.427 203 953V938.182ZM210.588 991.279L217.516 988.406L224.444 985.533C227.306 992.435 231.055 998.885 235.554 1004.74L229.607 1009.31L223.66 1013.88C218.372 1007 213.959 999.409 210.588 991.279ZM264.721 1045.41L267.594 1038.48L270.467 1031.56C263.565 1028.69 257.115 1024.94 251.261 1020.45L246.692 1026.39L242.122 1032.34C249.003 1037.63 256.591 1042.04 264.721 1045.41ZM203 908.545H210.5H218V878.909H210.5H203V908.545ZM203 849.273H210.5H218V819.636H210.5H203V849.273ZM203 790H210.5H218V760.364H210.5H203V790ZM203 730.727H210.5H218V701.091H210.5H203V730.727ZM203 671.455H210.5H218V641.818H210.5H203V671.455ZM203 612.182H210.5H218V582.545H210.5H203V612.182ZM203 552.909H210.5H218V523.273H210.5H203V552.909ZM203 493.636H210.5H218V464H210.5H203V493.636ZM203 434.364H210.5H218V404.727H210.5H203V434.364ZM203 375.091H210.5H218V345.455H210.5H203V375.091ZM203 315.818H210.5H218V301C218 297.224 218.245 293.512 218.719 289.879L211.282 288.909L203.845 287.939C203.288 292.214 203 296.573 203 301V315.818ZM347.5 201V208.5V216H377.167V208.5V201H347.5ZM406.833 201V208.5V216H436.5V208.5V201H406.833ZM466.167 201V208.5V216H495.833V208.5V201H466.167ZM525.5 201V208.5V216H555.167V208.5V201H525.5ZM584.833 201V208.5V216H614.5V208.5V201H584.833ZM644.167 201V208.5V216H673.833V208.5V201H644.167ZM937 464H929.5H922V493.636H929.5H937V464ZM937 523.273H929.5H922V552.909H929.5H937V523.273ZM937 582.545H929.5H922V612.182H929.5H937V582.545ZM937 641.818H929.5H922V671.455H929.5H937V641.818ZM937 701.091H929.5H922V730.727H929.5H937V701.091ZM937 760.364H929.5H922V790H929.5H937V760.364ZM937 819.636H929.5H922V849.273H929.5H937V819.636ZM937 878.909H929.5H922V908.545H929.5H937V878.909ZM937 938.182H929.5H922V953C922 956.776 921.755 960.488 921.281 964.121L928.718 965.091L936.155 966.061C936.712 961.786 937 957.427 937 953V938.182ZM792.5 1053V1045.5V1038H762.833V1045.5V1053H792.5ZM733.167 1053V1045.5V1038H703.5V1045.5V1053H733.167ZM673.833 1053V1045.5V1038H644.167V1045.5V1053H673.833ZM614.5 1053V1045.5V1038H584.833V1045.5V1053H614.5ZM555.167 1053V1045.5V1038H525.5V1045.5V1053H555.167ZM495.833 1053V1045.5V1038H466.167V1045.5V1053H495.833ZM436.5 1053V1045.5V1038H406.833V1045.5V1053H436.5ZM377.167 1053V1045.5V1038H347.5V1045.5V1053H377.167ZM680 220L689.917 229.917L700.523 219.31L690.607 209.393L680 220ZM709.75 249.75L729.583 269.583L740.19 258.977L720.357 239.143L709.75 249.75ZM749.417 289.417L769.25 309.25L779.857 298.643L760.023 278.81L749.417 289.417ZM789.083 329.083L808.917 348.917L819.523 338.31L799.69 318.477L789.083 329.083ZM828.75 368.75L848.583 388.583L859.19 377.977L839.357 358.143L828.75 368.75ZM868.417 408.417L888.25 428.25L898.857 417.643L879.023 397.81L868.417 408.417ZM908.083 448.083L918 458L928.607 447.393L918.69 437.477L908.083 448.083Z" fill="#B2B2B2"/>
                    <rect x="940" y="990.288" width="59" height="101" transform="rotate(-40.4621 940 990.288)" fill="#C6C6C6"/>
                    <path d="M1052.77 1005.76C1061.28 998.714 1073.89 999.894 1080.94 1008.4L1281.52 1250.43C1299.14 1271.69 1296.19 1303.21 1274.93 1320.83L1248.75 1342.53C1227.49 1360.15 1195.97 1357.2 1178.35 1335.94L977.762 1093.9C970.714 1085.4 971.895 1072.79 980.399 1065.74L1052.77 1005.76Z" fill="#B2B2B2"/>
                    <rect x="1058.63" y="1053.51" width="21.4981" height="265.241" rx="10.7491" transform="rotate(-40.19 1058.63 1053.51)" fill="white"/>
                    <circle cx="752" cy="718" r="354" fill="#E6E6E6" stroke="#B2B2B2" stroke-width="10"/>
                    <circle cx="752" cy="718" r="280" fill="white" stroke="#B2B2B2" stroke-width="10"/>
                    <path d="M839.656 650.125C839.656 656.766 838.484 662.951 836.141 668.68C833.667 674.279 830.542 679.422 826.766 684.109C822.99 688.797 818.823 693.094 814.266 697C811.922 698.953 809.643 700.841 807.43 702.664C805.216 704.357 803.003 706.049 800.789 707.742C796.362 710.997 792.26 714.057 788.484 716.922C784.839 719.656 782.104 722.26 780.281 724.734C779.5 725.776 778.589 727.404 777.547 729.617C776.505 731.701 775.984 734.109 775.984 736.844C775.984 743.875 773.771 749.669 769.344 754.227C765.047 758.784 758.276 761.062 749.031 761.062C739.135 761.062 731.974 758.328 727.547 752.859C723.12 747.391 720.906 741.531 720.906 735.281C720.906 726.688 722.404 719.266 725.398 713.016C728.393 707.026 732.169 701.883 736.727 697.586C741.284 693.159 746.167 689.318 751.375 686.062C757.104 682.417 761.987 679.031 766.023 675.906C770.581 672.391 774.357 668.484 777.352 664.188C780.346 659.76 781.844 654.292 781.844 647.781C781.844 639.708 780.281 633.589 777.156 629.422C774.031 625.255 770.06 622.456 765.242 621.023C760.555 619.591 755.672 618.875 750.594 618.875C738.745 618.875 730.867 621.74 726.961 627.469C723.185 633.198 721.297 640.099 721.297 648.172C721.297 657.547 718.107 664.578 711.727 669.266C705.477 673.953 698.901 676.297 692 676.297C683.146 676.297 675.984 673.888 670.516 669.07C665.047 664.122 662.312 657.807 662.312 650.125C662.312 646.609 662.703 642.247 663.484 637.039C664.266 631.701 665.763 626.036 667.977 620.047C670.19 614.057 673.315 608.068 677.352 602.078C681.258 596.349 686.531 590.945 693.172 585.867C699.682 581.049 707.625 577.143 717 574.148C726.375 571.154 737.573 569.656 750.594 569.656C765.307 569.656 778.198 571.674 789.266 575.711C800.464 579.617 809.773 585.086 817.195 592.117C832.169 606.44 839.656 625.776 839.656 650.125ZM782.625 814.578C782.625 825.646 779.826 833.849 774.227 839.188C768.628 844.396 760.75 847 750.594 847C728.979 847 718.172 836.193 718.172 814.578C718.172 803.38 720.971 795.242 726.57 790.164C732.169 785.086 740.177 782.547 750.594 782.547C761.401 782.547 769.409 785.086 774.617 790.164C779.956 795.242 782.625 803.38 782.625 814.578Z" fill="#B2B2B2"/>
                    <path d="M47.5322 74L137.462 169.256" stroke="#B2B2B2" stroke-width="15" stroke-linecap="round"/>
                    <path d="M186.532 24L187.008 154.999" stroke="#B2B2B2" stroke-width="15" stroke-linecap="round"/>
                    <path d="M0 216.019L130.994 217.237" stroke="#B2B2B2" stroke-width="15" stroke-linecap="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_60_31">
                    <rect width="1447" height="1374" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg></span>
                <p class="pera_text">{{get_phrase('No data found!')}}</p>
                <p class="pera_text">{{get_phrase('Please go back')}}</p>
                <a class="btn_1" href="{{ url()->previous() }}">{{get_phrase('Back')}}</a>
            </div>
         </div>
        @endif
    </div>
</div> <!-- Page Wrap End -->


<script>
    
    function follow_toggle(url,id){
        $.ajax({
            url: url,
            success: function(result){ 
                if(result == 1){
                    $("#wishlist-icon"+id).html('<i class="fa-solid fa-heart"></i>');
                    message = 'Job Added from wishlist.';
                    toastr.success(message);
                }else{
                    $("#wishlist-icon"+id).html('<i class="fa-regular fa-heart"></i>')
                    message = 'Job Remove from wishlist.';
                    toastr.success(message);
                }
            }
        });
    }

</script>