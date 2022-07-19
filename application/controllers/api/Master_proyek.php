
<?php defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;


class Master_proyek extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
       
                $data = $this->db->get('api_master_proyek')->Result();
                $this->response(
                    [
                    'status' => true,
                    'message' => 'Success',
                    'data' =>$data 
                    ], RestController::HTTP_OK);
        
    }
}