<x-admin::auth />
<div class="m-grid m-grid--hor m-grid--root m-page">
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{url('/')}}/plugins/portal/media/img/bg-2.jpg);">
    <div class="m-grid__item m-grid__item--fluid  m-login__wrapper">
      <div class="m-login__container">
        <div class="m-login__logo" >
          <a>
            <h1 style="color:#fff">{{config('app.name')}}</h1> 
            <img width="50%" src="{!! asset('plugins/portal/media/img/logo_2.png') !!}" />
          </a>
        </div>
        <div class="m-login__signin">
          <div class="m-login__head">
            <h3 class="m-login__title">Login to {{config('app.name')}} admin portal
            </h3>
          </div>
          <form action="{{route('admins.login')}}" method="post" id="login-form-admin" class="m-login__form m-form">
            @csrf
            <div class="row">
              <div class="col-md-12"></div>
              <div class="col-md-12">
                <div class="form-group m-form__group">
                  <input 
                    required="" 
                    maxlength="191" 
                    class="form-control m-input" 
                    type="email" placeholder="Email" 
                    name="email" 
                    value="{{old('email')}}">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group m-form__group">
                  <input 
                    required="" 
                    class="form-control m-input m-login__form-input--last" 
                    type="password" 
                    placeholder="Password" 
                    name="password">
                </div>
                <div class="row m-login__form-sub">
                  <div class="col m--align-left m-login__form-left">
                    <label class="m-checkbox  m-checkbox--light">
                      <input type="checkbox" name="rememberme"> Remember me
                      <span></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="m-login__form-action">
              <button style="background: #aba5b6;border-color: #aba5b6" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn" type="submit">Sign In</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

