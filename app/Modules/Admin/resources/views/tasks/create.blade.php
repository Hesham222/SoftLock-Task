<x-admin::layout>
 <x-slot name="pageTitle">Encryption | Create</x-slot name="pageTitle">
 @section('tasks-active', 'm-menu__item--active m-menu__item--open')
 @section('tasks-create-active', 'm-menu__item--active')
  <x-slot name="style">
  <!-- Some styles -->
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
              Task
            </h3>
          </div>
        </div>
      </div>
      <div class="m-content">
        <div style="display: none;" class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
          <div class="m-alert__icon">
            <i class="flaticon-exclamation m--font-brand">
            </i>
          </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  Create Encryption File
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('admins.task.store')}} " enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-12">
                                  <label for="files" class="from-label mt-4">File:</label>
                                  <input name="file"  id="file" type="file" required>
                                  <div id="size"></div>
                                  <div id="disp_tmp_path"></div>
                                  @error('file')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                          </div>
                              <div class="progress mb-3">
                                    <div class="bar"></div>
                                    <div class="percent">0%</div>
                              </div>
                      </div>
                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-6"></div>
                                  <div class="col-lg-6 m--align-right">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                </section>
            </div>
          </div>
        </div>
      </div>
    <!-- end page content -->
  <x-slot name="scripts">
    <!-- Some JS -->
      <script>
          $(document).ready(function () {
              var bar     = $('.bar');
              var percent = $('.percent');

              $('form').ajaxForm({
                  beforeSend:function () {
                      var percentVal = '0%';
                      bar.width(percentVal);
                      percent.html(percentVal);
                  },
                  uploadProgress:function (event,position,total,percentComplete) {
                      var percentVal = percentComplete+'%';
                      bar.width(percentVal);
                      percent.html(percentVal);
                  },
                  complete:function () {
                      window.location.href="{{route('admins.task.store')}}";
                  }
              });
          });
      </script>
      <script>
          const fileEle = document.getElementById('upload');
          const sizeEle = document.getElementById('size');

          fileEle.addEventListener('change', function (e) {
              const files = e.target.files;
              const formatFileSize = function (bytes) {
                  const sufixes = ['B', 'kB', 'MB', 'GB', 'TB'];
                  const i = Math.floor(Math.log(bytes) / Math.log(1024));
                  return `${(bytes / Math.pow(1024, i)).toFixed(2)} ${sufixes[i]}`;
              };
              if (files.length === 0) {
                  // Hide the size element if user doesn't choose any file
                  sizeEle.innerHTML = '';
                  sizeEle.style.display = 'none';
              } else {
                  // File in B, kB, MB, GB, and TB
                  sizeEle.innerHTML = formatFileSize(files[0].size) ;

                  // Display it
                  sizeEle.style.display = 'block';
              }
          });
      </script>

  </x-slot>

  </x-admin::layout>
