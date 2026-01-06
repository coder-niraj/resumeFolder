<?php

namespace Modules\Employers\Repositories;

interface EmployeeRepository
{
    // public function all($filters = []);
    public function find($email);
    public function create(array $employee);
    public function update($email, $data);
    // public function delete($id);
}
