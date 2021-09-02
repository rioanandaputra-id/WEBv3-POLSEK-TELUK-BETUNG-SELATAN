<?php defined('BASEPATH') or exit('No direct script access allowed');
class BaseController extends CI_Controller
{
    function LvFrontend($viewName = "", $headerInfo = NULL, $navBarInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
    {
        $this->load->view('_template/sailor/header', $headerInfo);
        $this->load->view('_template/sailor/navbar', $navBarInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('_template/sailor/footer', $footerInfo);
    }
    function LvBackend($viewName = "", $headerInfo = NULL, $navBarInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
    {
        $this->load->view('_template/sbadmin/header', $headerInfo);
        $this->load->view('_template/sbadmin/sidebar', $headerInfo);
        $this->load->view('_template/sbadmin/navbar', $navBarInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('_template/sbadmin/footer', $footerInfo);
    }
}
