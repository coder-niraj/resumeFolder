<?php

namespace Modules\Applications\Repositories;

interface ApplicatonRepository
{
    function createApplication($data);
    function UpdateApplication();
    function removeApplication();
}
