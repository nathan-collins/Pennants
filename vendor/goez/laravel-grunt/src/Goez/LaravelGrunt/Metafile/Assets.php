<?php

namespace Goez\LaravelGrunt\Metafile;

use Goez\LaravelGrunt\Metafile;

class Assets extends Metafile
{

    /**
     * @var string
     */
    protected $assetsPath = '';

    /**
     * @return void
     */
    public function init()
    {
        $this->assetsPath = $this->config->get('laravel-grunt::assets_path');
    }

    /**
     * @return array
     */
    public function requirements()
    {
        return array(
            'ruby' => array(
                'command' => 'ruby -v',
                'check'   => 'ruby',
            ),
            'gem' => array(
                'command' => 'gem -v',
                'check'   => '2',
            ),
            'compass' => array(
                'command' => 'compass -v',
                'check'   => 'Compass',
            ),
        );
    }

    /**
     * @return array
     */
    public function ignoreFiles()
    {
        return array(
            '/.sass-cache',
            '/public.tmp',
            '/public/assets',
        );
    }

    /**
     * @return array
     */
    public function manifest()
    {
        return array(
            $this->assetsPath . '/images' => static::DIR,
            $this->assetsPath . '/scripts' => static::DIR,
            $this->assetsPath . '/styles' => static::DIR,
            $this->assetsPath . '/styles/main.scss' => static::TPL . ':assets/main.scss.txt',
            $this->assetsPath . '/index.html' => static::TPL . ':assets/index.html.txt',
        );
    }

}
