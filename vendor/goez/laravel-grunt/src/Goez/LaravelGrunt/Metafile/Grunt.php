<?php

namespace Goez\LaravelGrunt\Metafile;

use Goez\LaravelGrunt\Metafile;

class Grunt extends Metafile
{

    /**
     * @return array
     */
    public function requirements()
    {
        return array(
            'node' => array(
                'command' => 'node -v',
                'check'   => 'v',
            ),
            'npm' => array(
                'command' => 'npm -v',
                'check'   => '1.',
            ),
            'grunt' => array(
                'command' => 'grunt -V',
                'check'   => 'grunt-cli',
            ),
        );
    }

    /**
     * @return array
     */
    public function ignoreFiles()
    {
        return array(
            '/node_modules',
        );
    }

    /**
     * @return array
     */
    public function manifest()
    {
        return array(
            'Gruntfile.js' => static::TPL . ':grunt/Gruntfile.js.txt',
            'package.json' => static::TPL . ':grunt/package.json.txt',
        );
    }

    /**
     * @return array
     */
    public function postCommands()
    {
        return array(
            'npm install',
        );
    }
}
