@extends('auth.login_layout')
@section('title', __('common.login'))

@section('content')


<div class="container-fluid">
  <div class="row no-gutter">
    <div class="col-md-8 d-none d-md-flex bg-image" style="background-image: url('/assets/frontend/img/potm/jan_2020.png')"></div>
    
      <!-- LOGIN -->
        <div class="col-md-4 text-white bg-dark">
            <div class="login d-flex align-items-center py-5">
 
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-9 mx-auto">
              <h3 class="login-heading mb-4">Simply Connect</h3>
              <h5 class="login-heading mb-4">Login</h5>
              {{ Form::open(['url' => url('/login'), 'method' => 'post', 'class' => 'form']) }}
              <form>
                <div class="form-label-group">
                  <div class="input-group form-group-no-border{{ $errors->has('email') ? ' has-error' : '' }} input-lg">
                {{
                Form::text('email', old('email'), [
              'id' => 'email',
              'placeholder' => __('common.email').' '.__('common.or').' '.__('common.pilot_id'),
              'class' => 'form-control',
              'required' => true,
              ])
                    }}
                </div>
                @if ($errors->has('email'))
                <span class="help-block">
               <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif

                <div class="form-label-group">
                <div class="input-group form-group-no-border{{ $errors->has('password') ? ' has-error' : '' }} input-lg">
                    {{
              Form::password('password', [
                  'name' => 'password',
                  'class' => 'form-control',
                  'placeholder' => __('auth.password'),
                  'required' => true,
              ])
                     }}
                </div>
                 @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                 </span>
                  @endif
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-danger btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">@lang('common.login')</button>
                <div class="pull-left">
                  <h6>
                    <a href="{{ url('/docs/preregister') }}" class="link">@lang('auth.createaccount')</a>
                    </h6>
                    </div>
                     <div class="pull-right">
                     <h6>
                     <a href="{{ url('/password/reset') }}" class="link">@lang('auth.forgotpassword')?</a>
              </form>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 
    </div>
  </div>
  </div>
@endsection

@section('scripts')
<script>
  var images = ['jan_2020.png', 'jan-2020-2.jpg', 'jan-2020-3.jpg', 'feb_2021_1.png', 'feb_2021_2.png', 'feb_2021_3.png', 'mar_2021_1.png', 'mar_2021_2.png', 'mar_2021_3.png', 'apr_2022.png', 'apr_2021_2.png', 'apr_2021_3.png'];
  document.querySelector('.bg-image').style.backgroundImage = 'url(/assets/frontend/img/potm/' + images[Math.floor(Math.random() * images.length)] + ')';
</script>
@endsection
