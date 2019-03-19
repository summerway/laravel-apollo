<?php

namespace MapleSnow\Apollo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use MapleSnow\Apollo\ApolloClient;

class StartApolloAgent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apollo.start-agent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start apollo agent. ';

    /**
     * @var ApolloClient
     */
    private $apolloClient;

    /**
     * Create a new command instance.
     * StartApolloAgent constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->initApolloClient();
    }

    /**
     * @throws \Exception
     */
    private function initApolloClient() {
        $configServer = Config::get('apollo.config_server');
        if (empty($configServer)) {
            throw new \Exception('ConfigServer must be specified!');
        }

        $appId = Config::get('apollo.app_id');
        if (empty($appId)) {
            throw new \Exception('AppId must be specified!');
        }

        $namespaces = Config::get('apollo.namespaces');
        if (empty($namespaces)) {
            $namespaces = ['application'];
        } else {
            $namespaces = array_map(function($namespace) {
                return trim($namespace);
            }, $namespaces);
        }

        $this->apolloClient = new ApolloClient($configServer, $appId, $namespaces);
        $this->apolloClient->setIntervalTimeout(Config::get('apollo.timeout_interval'));
        $this->apolloClient->setSaveDir(Config::get('apollo.save_dir'));
    }

    /**
     * Execute the console command.
     * @return bool
     */
    public function handle()
    {
        $res = $this->apolloClient->start();
        if($res !== true){
            Log::error($res);
            return false;
        }

        return true;
    }
}