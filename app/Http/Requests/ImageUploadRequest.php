<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageUploadRequest extends FormRequest {

    private $enviosRepo;
    
    private $service;
    
    private $competencia;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    
    public function __construct() {
        $this->enviosRepo = new \App\Repositories\EnviosProcessoTwoRepository();  
        $this->service = new \App\Services\ProcessoTwoService();
        
        $this->competencia = $this->service->getCompetencia();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'fotos.*' => 'required|image'
        ];
    }

    public function generateThumbnail($file, $path) {
        $canvas = Image::canvas(150, 150);

        $image = Image::make($file->getRealPath())->fit(150, 150, function($constraint) {
            $constraint->upsize();
        });

        $canvas->insert($image, 'center');

        $thumbsPath = 'public/thumbs/' . $path;

        //dd( $thumbsPath );



        Storage::put($thumbsPath, (String) $canvas->encode());
        //$canvas->save( $thumbsPath );
    }
    
    

    public function resizeAndUpload($file, $path) {

        $orginalDimensions = getimagesize($file->getRealPath());

        $newHeight = 600;
        $newWidth = ( $orginalDimensions[0] * $newHeight ) / $orginalDimensions[1];



        $image = Image::make($file->getRealPath());

        // resize the image to a width of 600 and constrain aspect ratio (auto height)
        $image->resize($newWidth, $newHeight, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::put('public/' . $path, (String) $image->encode());
    }

    public function saveToDatabase($mes, $ano, $path) {

        $data = [
            'user_id' => Auth::user()->id,
            'mes' => $mes,
            'ano' => $ano,
            'path' => $path
        ];

        try {
            $this->service->save($data);
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }

    public function handle($files) {
        foreach ($files as $file) {
            $mes = $this->competencia->format('m');
            $ano = $this->competencia->format('Y');
            $userId = Auth::user()->id;
            
            if( $this->enviosRepo->getFilesRemaining($userId, $mes, $ano) <= 0 )
            {
                throw new \Exception('Já foram enviadas todas as fotos permitidas para esta competência');
            }
            
            $fileName = md5(microtime() . $file->getClientOriginalName());

            $directory = sprintf("fotos/visitas/%s/%s/%s", Auth::user()->id, $this->competencia->format('Y'), $this->competencia->format('m')
            );

            $fullPath = $directory . '/' . $fileName . '.' . $file->getClientOriginalExtension();

            $this->resizeAndUpload($file, $fullPath);
            $this->generateThumbnail($file, $fullPath);

            $this->saveToDatabase(
                    $mes, $ano , $fullPath
            );
        }
    }

}
