<?php

/* /var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Layout/default.twig */
class __TwigTemplate_66850c840b0a107966e057d9ce615ba939d5ef958bea35966a1020129d96651d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_02ff2637cdf9a9443048cb09382e52a0fd2dbab92ee64427e9f7a8f649e45fe1 = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_02ff2637cdf9a9443048cb09382e52a0fd2dbab92ee64427e9f7a8f649e45fe1->enter($__internal_02ff2637cdf9a9443048cb09382e52a0fd2dbab92ee64427e9f7a8f649e45fe1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "/var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Layout/default.twig"));

        // line 16
        echo $this->getAttribute((isset($context["_view"]) ? $context["_view"] : null), "fetch", array(0 => "content"), "method");
        
        $__internal_02ff2637cdf9a9443048cb09382e52a0fd2dbab92ee64427e9f7a8f649e45fe1->leave($__internal_02ff2637cdf9a9443048cb09382e52a0fd2dbab92ee64427e9f7a8f649e45fe1_prof);

    }

    public function getTemplateName()
    {
        return "/var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Layout/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
{{ _view.fetch('content')|raw }}", "/var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Layout/default.twig", "");
    }
}
