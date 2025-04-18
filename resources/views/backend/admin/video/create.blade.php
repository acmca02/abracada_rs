<div class="main_content">
  <!-- Main section header and breadcrumb -->
  <div class="mainSection-title">
      <div class="row">
          <div class="col-12">
              <div class="d-flex justify-content-between align-items-center flex-wrap gr-15">
                  <div class="d-flex flex-column">
                      <h4>{{ get_phrase('Add a new video') }}</h4>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Start Admin area -->
  <div class="row">
      <div class="col-md-7">
          <div class="eSection-wrap-2">
              <div class="eForm-layouts">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <form method="POST" action="{{ route('admin.video.created') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label eForm-label">{{ get_phrase('Video title') }}</label>
                            <input type="text" class="form-control eForm-control"  id="title" name="title" placeholder="Video title">
                        </div>

                        <div class="mb-3">
                            <label for="video_category_id" class="form-label eForm-label">{{ get_phrase('Select a category') }}</label>
                            <select name="video_category_id" class="form-select eForm-control select2">
                                <option value="">{{ get_phrase('Select a category') }}</option>
                                @foreach (\App\Models\VideoCategory::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('video_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label eForm-label">{{ get_phrase('Blog details') }}</label>
                            <textarea id="description" name="description" class="content"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label eForm-label">{{ get_phrase('Video URL') }}</label>
                            <input type="text" class="form-control eForm-control" value="{{ old('file') }}" id="file" name="file" placeholder="https://example.com/video.mp4">
                        </div>

                        <div class="mb-3">
                            <label for="mobile_app_image" class="form-label eForm-label">{{ get_phrase('mobile_app_image') }}</label>
                            <input id="mobile_app_image" class="form-control eForm-control-file" type="file" name="mobile_app_image">
                        </div>
                      
                        <button type="submit" class="btn btn-primary">{{ get_phrase('Submit') }}</button>
                    </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Start Footer -->
  @include('backend.footer')
  <!-- End Footer -->
</div>