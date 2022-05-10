<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('DisposableTools::common.sundetails')
      @if(isset($location)) | {{ $location }} @endif
      <i class="fas fa-adjust float-right"></i>
    </h5>
  </div>
  @if(isset($details))
    <div class="card-body p-0">
      <table class="table table-borderless table-sm table-striped mb-0">
        <tr>
          <td class="text-left">@lang('DisposableTools::common.twilight_begin')</td>
          <td class="text-right">{{ $twilight_begin }}</td>
        </tr>
        <tr>
          <td class="text-left">@lang('DisposableTools::common.sunrise')</td>
          <td class="text-right">{{ $sunrise }}</td>
        </tr>
        <tr>
          <td class="text-left">@lang('DisposableTools::common.sunset')</td>
          <td class="text-right">{{ $sunset }}</td>
        </tr>
        <tr>
          <td class="text-left">@lang('DisposableTools::common.twilight_end')</td>
          <td class="text-right">{{ $twilight_end }}</td>
        </tr>
      </table>
    </div>
  @elseif(isset($error))
    <div class="card-body p-0 text-center">
      <span class="text-danger">{{ $error }}</span>
    </div>
  @endif
</div>
