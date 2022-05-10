@extends('admin.app')
@section('title', 'Disposable Hubs')

@section('content')
  <div class="card border-blue-bottom" style="margin-left:5px; margin-right:5px; margin-bottom:5px;">
    <div class="content">
      <p>This module is designed to provide 3 pages for your phpVms v7; Hubs to list all your hubs, Hub Details and Overall Stats for your install.</p>
      <p>If you have DisposableTools Module installed, stats will detect it and provide some periodic user (+ airline) stats by using it's widgets too</p>
      <p>
        If you need to customize the layouts according to your template please copy relevant blade files from <b>modules\DisposableHubs\Resources\views</b>
        to a folder under your theme folder named <b>modules\DisposableHubs</b> (case sensitive) and edit files there</p>
      <p>
        Example Source: <b>phpvms root\Modules\DisposableHubs\Resources\views\index.blade.php</b><br>
        Example Target: <b>phpvms root\Resources\views\layouts\default\modules\DisposableHubs\index.blade.php</b><br>
        Example Target: <b>phpvms root\Resources\views\layouts\Disposable_v1\modules\DisposableHubs\index.blade.php</b>
      </p>
      <p>* Do <b>NOT</b> edit source files, so you can update the module easily and keep your changes safe</p>
      <p>&nbsp;</p>
      <p>Module Developed by <a href="https://github.com/FatihKoz" target="_blank">B.Fatih KOZ</a> &copy; 2021</p>
    </div>
  </div>
@endsection
