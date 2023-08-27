<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface BlogRepositoryInterface
{
    public function index($trash = false);
    public function createOrUpdate(Request $data, array $validatorsArray);
    public function show($id);
    public function restoreOrDelete($id, $restore = false);
}
