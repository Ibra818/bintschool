<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Module, Formation, User};

class moduleCtr extends Controller
{

    // Function that store module with their files

    public function storeModule(Request $request){
          try {

            foreach( $request -> allFiles() as $key => $file){
                $index = str_replace('module-file-', '', $key);
                $namekey = "module-name-" .$index; 
                
                $moduleName = $request -> input($namekey);
                $path = $file->store('modules', 'public');

                $module = Module::create(
                    [
                        'module' => $moduleName,
                        'module_video' => $path,  
                        // 'formation_id' => 1,  
                    ]);
            }
            
            return response() -> json([
                // 'requests' => $request,
                'files' => $request -> allFiles()
            ]);
            
        } catch (\Exception $e) {        
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout du module',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
