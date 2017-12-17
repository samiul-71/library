<?php

namespace App\Http\Controllers\Api\V1;


class ApiV1ListController
{
    protected $startsWith;
    protected $prefix;
    protected $version;

    public function __construct()
    {
        $this->startsWith = '/api/';
        $this->version = 'v1';
        $this->prefix = $this->startsWith . $this->version;
    }


    /**
     * @method PUT
     * @param $user
     * @param $id
     * @return string
     */
    public function updatePhrAttachReportDetailsByUser($user, $id)
    {
        return $this->prefix . '/user/' . $user . '/phr/attach-report/' . $id;
    }
}
