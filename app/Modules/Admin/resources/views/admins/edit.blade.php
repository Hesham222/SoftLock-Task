<x-admin::layout>
 <x-slot name="pageTitle">Admins | Edit</x-slot name="pageTitle">
 @section('admins-active', 'm-menu__item--active m-menu__item--open')
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
                  Edit
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('admins.admin.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf 
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Full Name:</label>
                                  <input 
                                    type="text" 
                                    value="{{old('name')?old('name'):$record->name}}"
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
                              <div class="col-lg-6">
                                  <label class="">Email:</label>
                                  <input 
                                    type="email" 
                                    value="{{old('email')?old('email'):$record->email}}"
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
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label class="">Phone:</label>
                                  <input  
                                    type="text"
                                    name="phone"
                                    value="{{old('phone')?old('phone'):$record->phone}}" 
                                    required=""
                                    class="form-control m-input"
                                    placeholder="Enter phone..."  
                                    maxlength="15" id="phone">
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>Privilege:</label>
                                    @if(old('privilege'))
                                      <select name="privilege" required=""
                                              class="form-control m-input m-input--square"
                                              id="exampleSelect1">
                                          <option @if(old( 'privilege')=='super' ) selected
                                                  @endif value="super">Super admin
                                          </option>
                                          <option @if(old( 'privilege')=='manager' ) selected
                                                  @endif value="manager">Manager
                                          </option>
                                      </select>
                                  @else
                                      <select name="privilege" required=""
                                              class="form-control m-input m-input--square"
                                              id="exampleSelect1">
                                          <option @if($record->privileges=='super') selected
                                                  @endif value="super">Super Admin
                                          </option>
                                          <option @if($record->privileges=='manager') selected
                                                  @endif value="manager">Manager
                                          </option>
                                      </select>
                                  @endif
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
                                  <div class="col-lg-6">
                                  </div>
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
  </x-slot>
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
  </x-admin::layout>
