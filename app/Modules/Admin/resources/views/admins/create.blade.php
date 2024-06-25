<x-admin::layout>
 <x-slot name="pageTitle">Admins | Create</x-slot name="pageTitle">
 @section('admins-active', 'm-menu__item--active m-menu__item--open')
 @section('admins-create-active', 'm-menu__item--active')
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
              Admins
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
                  Create
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('admins.admin.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>Full Name:</label>
                                  <input 
                                    type="text" 
                                    value="{{old('name')}}" 
                                    name="name" 
                                    required=""
                                    class="form-control m-input" 
                                    placeholder="Enter full name..." />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">Email:</label>
                                  <input 
                                    type="email" 
                                    value="{{old('email')}}" 
                                    name="email" 
                                    required=""
                                    class="form-control m-input" 
                                    placeholder="Enter email..." />
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">Phone:</label>
                                  <input 
                                    type="phone" maxlength="15" 
                                    value="{{old('phone')}}" 
                                    name="phone"
                                    required="" 
                                    class="form-control m-input"
                                    placeholder="Enter phone..." 
                                    id="phone" 
                                    />
                                  @error('phone')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Password:</label>
                                  <div class="m-input-icon m-input-icon--right">
                                      <input  
                                        type="password"
                                        name="password" 
                                        required="" 
                                        class="form-control m-input"
                                        placeholder="Enter your password..." 
                                        maxlength="191"
                                        />

                                  </div>
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>Privilege:</label>
                                  <select name="privilege" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      <option @if(old( 'privilege')=='super' ) selected
                                              @endif value="super">Super Admin
                                      </option>
                                      <option @if(old( 'privilege')=='manager' ) selected
                                              @endif value="manager">Manager
                                      </option>
                                  </select>
                                  @error('privilege')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
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
    <script type="text/javascript">
      var input = document.getElementById("phone");
      input.onkeypress = function (e) 
      {
          e = e || window.event;
          var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
          if (!charCode || charCode == 8 /* Backspace */)
              return;
          var typedChar = String.fromCharCode(charCode);
          if (/\d/.test(typedChar))
              return;
          if (typedChar == "+" && this.value == "")
              return;
          return false;
      };
    </script>
  </x-slot>

  </x-admin::layout>
