@if (!empty($messages))
    @php
        // Éviter les doublons en ne gardant qu'un message par ID
        $messages = $messages->unique('id');
        
        // Garder seulement le second message
        $secondMessage = $messages->skip(1)->take(1)->first();
    @endphp

    @if ($secondMessage)
        <div class="single-item-countable mt-4" id="message-{{ $secondMessage->id }}">
            @if ($secondMessage->reciver_id == auth()->user()->id)
                {{-- Messages REÇUS --}}
                @php
                    $user = \App\Models\User::find($secondMessage->sender_id);
                @endphp

                <div class="d-flex user-quote">
                    @if (!empty($secondMessage->thumbsup) && empty($secondMessage->message))
                        {{-- Cas 1: Thumbsup seulement --}}
                        <div class="d-flex user-quote position-relative">
                            <img src="{{ get_user_image($user->id,'optimized') }}" alt="" class="avatar-sm me-2">
                            <div class="chat-react"><img src="{{ asset('assets/frontend/images/like-lg.png') }}" alt=""></div>
                        </div>
                    @elseif (!empty($secondMessage->file))
                        {{-- Cas 2: Fichiers joints --}}
                        @php
                            $files = \App\Models\Media_files::where('chat_id', $secondMessage->id)->get();
                        @endphp
                        <div class="d-flex user-quote user-reply justify-content-start">
                            @foreach ($files as $file)
                                <div class="quote-box">
                                    @if ($file->file_type == "image")
                                        <img src="{{ asset('storage/chat/images/'.$file->file_name) }}" alt="" class="quote_image_box_image">
                                    @else
                                        <video class="w-100 shorts_custom_height" controls>
                                            <source src="{{ asset('storage/chat/videos/'.$file->file_name) }}" type="">
                                        </video>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @elseif (!empty($secondMessage->message))
                        {{-- Cas 3: Message texte --}}
                        <img src="{{ get_user_image($user->id,'optimized') }}" alt="" class="avatar-sm me-2">
                        <div class="quote-box">
                            <div class="text-quote mt-0">
                                @if (\Illuminate\Support\Str::contains($secondMessage->message, ['http','https']))
                                    @php
                                        $explode_data = explode('/', $secondMessage->message);
                                        $shared_id = end($explode_data);
                                    @endphp
                                    @if ($explode_data[count($explode_data)-2] == 'post')
                                        <iframe src="{{ route('custom.shared.post.view',$shared_id) }}?shared=yes" scrolling="no" class="w-100" onload="resizeIframe(this)" frameborder="0"></iframe>
                                    @else
                                        <iframe src="{{ route('single.product.iframe',$shared_id) }}?shared=yes" scrolling="no" class="w-100" onload="resizeIframe(this)" frameborder="0"></iframe>
                                    @endif
                                    <a class="text-dark ellipsis-line-2" href="{{ $secondMessage->message }}" target="_blank">{{ $secondMessage->message }}</a>
                                @else
                                    {{ $secondMessage->message }}
                                @endif
                                <div class="quote-react d-flex position-relative">
                                    <span class="entry-react post-react" id="ShowReactId_{{ $secondMessage->id }}">
                                        @include('frontend.chat.chat_react')
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            @elseif ($secondMessage->sender_id == auth()->user()->id)
                {{-- Messages ENVOYÉS --}}
                @if (!empty($secondMessage->thumbsup) && empty($secondMessage->message))
                    {{-- Cas 1: Thumbsup seulement --}}
                    <div class="d-flex user-quote user-reply justify-content-end">
                        <div class="d-flex user-quote">
                            <div class="quote-react remove-icon-message">
                                <a class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{ route('remove.chat',$secondMessage->id) }}"> {{ get_phrase('Remove') }}</a></li>
                                </ul>
                            </div>
                            <div class="chat-react mt-2">
                                <img class="rounded" src="{{ asset('assets/frontend/images/like-lg.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                @elseif (!empty($secondMessage->file))
                    {{-- Cas 2: Fichiers joints --}}
                    @php
                        $files = \App\Models\Media_files::where('chat_id',$secondMessage->id)->get();
                    @endphp
                    <div class="d-flex user-quote user-reply justify-content-end">
                        @foreach ($files as $file)
                            <div class="quote-box d-flex">
                                <div class="quote-react remove-icon-message">
                                    <a class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ route('remove.chat',$secondMessage->id) }}"> {{ get_phrase('Remove') }}</a></li>
                                    </ul>
                                </div>
                                @if ($file->file_type == "image")
                                    <img class="rounded" src="{{ asset('storage/chat/images/'.$file->file_name) }}" class="quote_image_box_image" alt=""/>
                                @else
                                    <video class="w-100 shorts_custom_height" controls>
                                        <source src="{{ asset('storage/chat/videos/'.$file->file_name) }}" type="">
                                    </video>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @elseif (!empty($secondMessage->message))
                    {{-- Cas 3: Message texte --}}
                    <div class="d-flex user-quote user-reply justify-content-end">
                        <div class="quote-react remove-icon-message">
                            <a class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('remove.chat',$secondMessage->id) }}"> {{ get_phrase('Remove') }}</a></li>
                            </ul>
                        </div>
                        <div class="text-quote mt-0">
                            @if (\Illuminate\Support\Str::contains($secondMessage->message, ['http','https']))
                                @php
                                    $explode_data = explode('/', $secondMessage->message);
                                    $shared_id = end($explode_data);
                                @endphp
                                @if ($explode_data[count($explode_data)-2] == 'post')
                                    <iframe src="{{ route('custom.shared.post.view',$shared_id) }}?shared=yes" scrolling="no" class="w-100" onload="resizeIframe(this)" frameborder="0"></iframe>
                                @else
                                    <iframe src="{{ route('single.product.iframe',$shared_id) }}?shared=yes" scrolling="no" class="w-100" onload="resizeIframe(this)" frameborder="0"></iframe>
                                @endif
                                <a href="{{ $secondMessage->message }}" class="text-dark ellipsis-line-2" target="_blank">{{ $secondMessage->message }}</a>
                            @else
                                {{ $secondMessage->message }}
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endif
@endif
