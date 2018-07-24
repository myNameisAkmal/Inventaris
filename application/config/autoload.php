<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database','session','upload','form_validation','email'); //upload buat foto

$autoload['drivers'] = array();

$autoload['helper'] = array('form','url'); //untuk base_url()

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('cihuy','M_Inv'); //nama Class Models
