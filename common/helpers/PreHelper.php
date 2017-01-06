<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\helpers;
/**
 * Description of PreHelper
 *
 * @author hp
 */
class PreHelper {
    public static function pre($data) {
        echo '<pre>';
        print_r($data);
        die();
    }
    
    public static function formatDate() {
        date_default_timezone_set('asia/ho_chi_minh');
        return date('Y-m-d H:i:s');
    }
}
