<?php

namespace App\Services\Util;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

/**
 * Description of CSVFileHandler
 *
 * @author evandro
 */
class CSVPresencaHandler {

    private $mes;
    private $ano;
    private $user;
    
    
    public function handle($file, $mes, $ano) {
        
        $this->ano = $ano;
        $this->mes = $mes;
        
        $handler = Excel::load($file->getRealPath());

        $validation = $this->validateFile($handler);

        if (is_array($validation)) {
            return $validation;
        }

        if ($validation === true) {
            $count = 0;
            
            $handler->each(function( Collection $csvLine ) use($mes, $ano, &$count) {
                $user = \App\User::where('cpf', $csvLine->get('cpf'))->first();

                $data = [
                    'cpf' => trim($csvLine->get('cpf')),
                    'geral' => trim($csvLine->get('geral')),
                    'granpure' => trim($csvLine->get('granpure')),
                    'sense' => trim($csvLine->get('sense')),
                    'mes' => $this->mes,
                    'ano' => $this->ano,
                    'user_id' => $user->id
                ];


                //dd($data);

                $service = new \App\Services\PresencaService();
                $service->save($data);
                $count++;
            });
            
            return $count;
        }
    }

    private function validateFormat($data) {
        //dd( $data );
        $validator = Validator::make($data, [
                    'cpf' => 'required|cpf',
                    'geral' => 'required|int',
                    'granpure' => 'required|int',
                    'sense' => 'required|int'
                ])->validate();
    }

    private function validateUser($cpf) {
        $user = \App\User::where('cpf', $cpf)->first();

        if ($user === null) {
            return false;
        }

        return true;
    }

    private function validateFile($handler) {
        $errors = [];

        $handler->each(function( Collection $csvLine ) use(&$errors) {
            
            $user = \App\User::where('cpf', $csvLine->get('cpf'))->first();
            
            $data = [
                    'cpf' => trim($csvLine->get('cpf')),
                    'geral' => trim($csvLine->get('geral')),
                    'granpure' => trim($csvLine->get('granpure')),
                    'sense' => trim($csvLine->get('sense')),
                    'mes' => $this->mes,
                    'ano' => $this->ano,
                    'user_id' => $user->id
                ];

            $this->validateFormat($data);

            if (!$this->validateUser($data['cpf'])) {
                $errors[] = "Nenhum usuário encontrado com o CPF {$data['cpf']}";
            }
        });

        if (count($errors) > 0) {
            return $errors;
        }

        return true;
    }

}
