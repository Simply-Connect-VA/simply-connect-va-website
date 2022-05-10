<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Log;

class Discord extends Widget
{
  // Set Widget Auto Refresh Time (Seconds)
  public $reloadTimeout = 60;

  protected $config = ['server' => null, 'bots' => false, 'bot' => ' Bot'];

  public function __construct(
    array $config = [],
    GuzzleClient $httpClient
  ) {
    parent::__construct($config);
    $this->httpClient = $httpClient;
  }

  public function run()
  {
    $server_id = $this->config['server'];

    if (!$server_id || !is_numeric($server_id)) {
      return null;
    }

    $discord_url = 'https://discord.com/api/guilds/'.$server_id.'/widget.json';

    try {
      $response = $this->httpClient->request('GET', $discord_url);
      if ($response->getStatusCode() !== 200) {
        Log::error('Disposable Tools | HTTP '.$response->getStatusCode().' Error Occured During Download !');
        return null;
      }
    } catch (GuzzleException $e) {
      Log::error('Disposable Tools | Discord Widget Download Error | '.$e->getMessage());
      return null;
    }

    $widget_data = json_decode($response->getBody());

    $name = $widget_data->name;
    $invite = $widget_data->instant_invite;
    $presence = $widget_data->presence_count;

    // Build Collections from Raw Channels and Members
    $channels = collect();
    foreach ($widget_data->channels as $ch) {
      $channels->push($ch);
    }

    $members = collect();
    foreach ($widget_data->members as $rm) {
      // Remove Bots
      if ($this->config['bots'] === false && strpos($rm->username, $this->config['bot']) !== false) {
        continue;
      }
      $members->push($rm);
    }
    
    return view('DisposableTools::discord',[
      'name'     => $name,
      'invite'   => $invite,
      'channels' => $channels,
      'members'  => $members,
      'presence' => $presence,
    ]);
  }
}
