<?php

namespace jfinstrom\UCPAdmin\Console\Commands;

use Illuminate\Console\Command;
use FreePBX;

class Dashclone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clone {source : The username of the source} {dest* : The username(s) to clone to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone a dashbard';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->ucp = FreePBX::Ucp();
        $source = $this->argument('source');
        $dest = $this->argument('dest');
        if (!$this->confirm("This will overwrite existing data, This does NOT touch userman permissions so you will want to make sure the users have the proper permissions for their widgets! Do you wish to continue?")) {
            return;
        }
        if ($this->confirm(sprintf('Do you want to override the dashboards of %s with the dashboard from %s', implode(",", $dest), $source))) {
            $data = $this->getData($source);
            foreach ($dest as $user) {
                $this->info(sprintf('Overwriting %s', $user));
                $this->setData($user, $data);
            }
        }
    }

    public function getData($source)
    {
        $user = $this->ucp->getUserByUsername($source);
        $dashboards = $this->ucp->getSettingById($user['id'], 'GLOBAL', 'dashboards');
        $layouts = [];
        foreach ($dashboards as $dashboard) {
            $layouts[$dashboard['id']] = $this->ucp->getSettingById($user['id'], 'GLOBAL', 'dashboard-layout-' . $dashboard['id']);
        }
        return ['dashboards' => $dashboards, 'layouts' => $layouts];
    }

    public function setData($dest, $data)
    {
        $user = $this->ucp->getUserByUsername($dest);
        $this->ucp->setSettingById($user['id'], 'GLOBAL', 'dashboards', $data['dashboards']);
        foreach ($data['layouts'] as $id => $layout) {
            $this->ucp->setSettingById($user['id'], 'GLOBAL', 'dashboard-layout-' . $id, $layout);
        }
    }
}
