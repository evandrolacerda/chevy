<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;

/**
 * Description of UsersRepository
 *
 * @author evandro
 */
class UsersRepository {
    
    private $userModel;


    public function __construct() {
        $this->userModel = new \App\User();
    }
    
    public function getUsers() {
        return $this->userModel
                ->newQuery()
                ->where('ativo', 1)
                ->where('role_id','!=', 5 )
                ->get();
    }
}
