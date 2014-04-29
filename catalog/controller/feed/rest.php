<?php
class ControllerFeedRest extends Controller
{
    private $debug = FALSE;
    
    /**
     * Get all plugin lisr
     */
    public function index()
    {
        $this->auth();
    }
    
    private function auth()
    {
        $json = array('');
    }
}