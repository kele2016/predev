<?php

// +----------------------------------------------------------------------
// | VMCSHOP [V M-Commerce Shop]
// +----------------------------------------------------------------------
// | Copyright (c) vmcshop.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.vmcshop.com/licensed)
// +----------------------------------------------------------------------
// | Author: Shanghai ChenShang Software Technology Co., Ltd.
// +----------------------------------------------------------------------


class site_view_compiler
{
    public function compile_MAIN($attrs, &$compiler)
    {
        if ($attrs['view'] && defined('ALLOW_CUSTOM_MAIN_VIEW') && constant('ALLOW_CUSTOM_MAIN_VIEW')) {
            $current_theme = vmc::singleton('site_theme_base')->get_default();
            $compiler->controller->_vars['_MAIN_'] = $current_theme.'/'.str_replace(array('"', '"'),array("", ""),$attrs['view']);

            return " echo  \$this->_fetch_compile_include(null, '".$compiler->controller->_vars['_MAIN_']."', array(), true); ";
        }

        return " echo  \$this->_fetch_compile_include('".($compiler->controller->get_tmpl_main_app_id() ? $compiler->controller->get_tmpl_main_app_id() : $compiler->controller->app->app_id)."', '".$compiler->controller->_vars['_MAIN_']."', array()); ";
    }
    public function compile_require($attrs, &$compiler)
    {
        $is_preview = 'false';

        return " echo \$this->_fetch_tmpl_compile_require({$attrs['file']},{$is_preview});";
    }
}
