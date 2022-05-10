@if ($members->count() > 0)
  <div class="card mb-2">
    <div class="card-header p-1">
      <h5 class="m-1 p-0">
        {{ $name }} Discord
        <i class="fab fa-discord float-right"></i>
      </h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-borderless table-sm table-striped mb-0 text-left">
        @foreach($members->sortBy('username') as $member)
          <tr>
            <td class="align-middle">
              @if (filled($member->avatar_url))
                <img src="{{ $member->avatar_url }}" style="max-height: 30px;" class="mr-1">
              @endif
              {{ $member->username }}
            </td>
            <td class="text-right align-middle">{{ $member->game->name ?? '' }}</td>
            <td class="text-right align-middle">{{ ucfirst($member->status) }}</td>
          </tr>
        @endforeach
      </table>
    </div>
    <div class="card-footer p-1 text-right">
      <span class="float-left">
        {{ $members->count() }} @lang('DisposableTools::common.onlineusers')
        @if ($channels->count() > 0)
          {{ ' | '.$channels->count() }} @lang('DisposableTools::common.channels')
        @endif
      </span>
      @if (filled($invite))
        <a class="button btn-sm btn-success m-0 pr-2 pl-2 p-0" href="{{ $invite }}" target="_blank">@lang('DisposableTools::common.join')</a>
      @endif
    </div>
  </div>
@endif
