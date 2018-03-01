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
class CSVFileHandler {

    public function handle($file, $mes, $ano) {

        $handler = Excel::load($file->getRealPath());

        $validation = $this->validateFile($handler);

        if (is_array($validation)) {
            return $validation;
        }

        if ($validation === true) {
            $count = 0;

            $handler->each(function( Collection $csvLine ) use($mes, $ano, &$count) {
                
                $this->save($csvLine, $mes, $ano );
                
                $count++;
            });

            return $count;
        }
    }

    private function save( $csvLine, $mes, $ano ) {
        try {

            $user = \App\User::where('cpf', $csvLine->get('cpf'))->first();

            $data = [
                'cpf' => trim($csvLine->get('cpf')),
                'meta' => trim($csvLine->get('meta')),
                'atingido' => trim($csvLine->get('atingido')),
                'mes' => $mes,
                'ano' => $ano,
                'user_id' => $user->id
            ];


            //dd($data);

            $service = new \App\Services\HotlistService();
            $service->save($data);
            
        } catch (\Illuminate\Database\QueryException $exc) {
            throw new \Exception($exc);
        }
    }

    private function validateFormat($data) {
            Validator::make($data, [
                    'cpf' => 'required|cpf',
                    'meta' => 'required|int',
                    'atingido' => 'required|int'
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

            $data = [
                'cpf' => trim($csvLine->get('cpf')),
                'meta' => trim($csvLine->get('meta')),
                'atingido' => trim($csvLine->get('atingido')),
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
