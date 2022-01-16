<?php

if (!defined('_PS_VERSION_'))
    exit;

class m00ncr4wlerFollowCart extends Module {
    public function __construct()
    {
        $this->name = 'm00ncr4wlerfollowcart';
        $this->tab = 'front_office_features';
        $this->version = '0.1.1';
        $this->author = 'm00ncr4wler - David Heinz';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Vertical follow cart on product page.');
        $this->description = $this->l('Vertical follow cart on product page.');
        $this->confirmUninstall = $this->l('Are you sure you want to delete your details?');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        if (!parent::install()
            || !$this->setupHooks('add')
        ) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
            || !$this->setupHooks('remove')
        ) {
            return false;
        }
        return true;
    }

    protected function getHooks()
    {
        return array(
            'displayHeader',
        );
    }

    protected function setupHooks($method)
    {
        foreach ($this->getHooks() as $hook) {
            if ($method === 'add')
                if (!$this->registerHook($hook))
                    return false;
            if ($method === 'remove')
                if (!$this->unregisterHook($hook))
                    return false;
        }
        return true;
    }

    public function hookDisplayHeader($params)
    {
        $allowedControllers = array('product');
        $c = $this->context->controller;

        if (isset($c->php_self) && in_array($c->php_self, $allowedControllers) && !Tools::getValue('content_only')) {
            $this->context->controller->addCSS($this->_path . 'views/templates/css/' . $this->name . '.css', 'all');
            $this->context->controller->addJS($this->_path . 'views/templates/js/' . $this->name . '.js');
        }
    }
}
