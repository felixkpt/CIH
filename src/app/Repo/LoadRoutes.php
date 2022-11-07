<?php 
namespace CIH\Core\App\Repo;

class LoadRoutes {

    public function loadRecursively($path, $r_maps = [], $debug = false)
    {
        $paths = [];
        foreach (glob("$path/*") as $filename) {

            if (strpos($filename, '.php') !== FALSE) {
                # php files:
                $r_maps[] = $filename;
                if ($debug === true) echo "included: $filename <br>";
            } else {
                # dirs
                $paths[] = $filename;
            }
        }

        # Time to process the dirs:
        for ($i = 0; $i < count($paths); $i++) {
            $path = $paths[$i];
            $r_maps = self::loadRecursively($path, $r_maps, $debug);
        }

        return $r_maps;
    }
}