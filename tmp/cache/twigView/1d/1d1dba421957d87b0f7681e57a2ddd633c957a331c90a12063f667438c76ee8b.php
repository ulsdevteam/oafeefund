<?php

/* /var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Element/Controller/edit.twig */
class __TwigTemplate_a37e5081ac44c740bbcb44282c3812a94097d5d21d48d3b5ca30fc4b99e99073 extends Twig_Template
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
        $__internal_0fe4164cbf19babf956cba19895bbc1bb96ab6854cceebc649a5729410d85d1a = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_0fe4164cbf19babf956cba19895bbc1bb96ab6854cceebc649a5729410d85d1a->enter($__internal_0fe4164cbf19babf956cba19895bbc1bb96ab6854cceebc649a5729410d85d1a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "/var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Element/Controller/edit.twig"));

        // line 16
        $context["belongsTo"] = $this->getAttribute((isset($context["Bake"]) ? $context["Bake"] : null), "aliasExtractor", array(0 => (isset($context["modelObj"]) ? $context["modelObj"] : null), 1 => "BelongsTo"), "method");
        // line 17
        $context["belongsToMany"] = $this->getAttribute((isset($context["Bake"]) ? $context["Bake"] : null), "aliasExtractor", array(0 => (isset($context["modelObj"]) ? $context["modelObj"] : null), 1 => "belongsToMany"), "method");
        // line 18
        $context["compact"] = array(0 => (("'" . (isset($context["singularName"]) ? $context["singularName"] : null)) . "'"));
        // line 19
        echo "
    /**
     * Edit method
     *
     * @param string|null \$id ";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["singularHumanName"]) ? $context["singularHumanName"] : null), "html", null, true);
        echo " id.
     * @return \\Cake\\Http\\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \\Cake\\Network\\Exception\\NotFoundException When record not found.
     */
    public function edit(\$id = null)
    {
        \$";
        // line 29
        echo twig_escape_filter($this->env, (isset($context["singularName"]) ? $context["singularName"] : null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, (isset($context["currentModelName"]) ? $context["currentModelName"] : null), "html", null, true);
        echo "->get(\$id, [
            'contain' => [";
        // line 30
        echo $this->getAttribute((isset($context["Bake"]) ? $context["Bake"] : null), "stringifyList", array(0 => (isset($context["belongsToMany"]) ? $context["belongsToMany"] : null), 1 => array("indent" => false)), "method");
        echo "]
        ]);
        if (\$this->request->is(['patch', 'post', 'put'])) {
            \$";
        // line 33
        echo twig_escape_filter($this->env, (isset($context["singularName"]) ? $context["singularName"] : null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, (isset($context["currentModelName"]) ? $context["currentModelName"] : null), "html", null, true);
        echo "->patchEntity(\$";
        echo twig_escape_filter($this->env, (isset($context["singularName"]) ? $context["singularName"] : null), "html", null, true);
        echo ", \$this->request->getData());
            if (\$this->";
        // line 34
        echo twig_escape_filter($this->env, (isset($context["currentModelName"]) ? $context["currentModelName"] : null), "html", null, true);
        echo "->save(\$";
        echo twig_escape_filter($this->env, (isset($context["singularName"]) ? $context["singularName"] : null), "html", null, true);
        echo ")) {
                \$this->Flash->success(__('The ";
        // line 35
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["singularHumanName"]) ? $context["singularHumanName"] : null)), "html", null, true);
        echo " has been saved.'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The ";
        // line 39
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["singularHumanName"]) ? $context["singularHumanName"] : null)), "html", null, true);
        echo " could not be saved. Please, try again.'));
        }
";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_array_merge((isset($context["belongsTo"]) ? $context["belongsTo"] : null), (isset($context["belongsToMany"]) ? $context["belongsToMany"] : null)));
        foreach ($context['_seq'] as $context["_key"] => $context["assoc"]) {
            // line 42
            $context["otherName"] = $this->getAttribute((isset($context["Bake"]) ? $context["Bake"] : null), "getAssociatedTableAlias", array(0 => (isset($context["modelObj"]) ? $context["modelObj"] : null), 1 => $context["assoc"]), "method");
            // line 43
            $context["otherPlural"] = Cake\Utility\Inflector::variable((isset($context["otherName"]) ? $context["otherName"] : null));
            // line 44
            echo "        \$";
            echo twig_escape_filter($this->env, (isset($context["otherPlural"]) ? $context["otherPlural"] : null), "html", null, true);
            echo " = \$this->";
            echo twig_escape_filter($this->env, (isset($context["currentModelName"]) ? $context["currentModelName"] : null), "html", null, true);
            echo "->";
            echo twig_escape_filter($this->env, (isset($context["otherName"]) ? $context["otherName"] : null), "html", null, true);
            echo "->find('list', ['limit' => 200]);";
            // line 45
            echo "
";
            // line 46
            $context["compact"] = twig_array_merge((isset($context["compact"]) ? $context["compact"] : null), array(0 => (("'" . (isset($context["otherPlural"]) ? $context["otherPlural"] : null)) . "'")));
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['assoc'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "        \$this->set(compact(";
        echo twig_join_filter((isset($context["compact"]) ? $context["compact"] : null), ", ");
        echo "));
    }
";
        
        $__internal_0fe4164cbf19babf956cba19895bbc1bb96ab6854cceebc649a5729410d85d1a->leave($__internal_0fe4164cbf19babf956cba19895bbc1bb96ab6854cceebc649a5729410d85d1a_prof);

    }

    public function getTemplateName()
    {
        return "/var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Element/Controller/edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 48,  100 => 46,  97 => 45,  89 => 44,  87 => 43,  85 => 42,  81 => 41,  76 => 39,  69 => 35,  63 => 34,  55 => 33,  49 => 30,  43 => 29,  34 => 23,  28 => 19,  26 => 18,  24 => 17,  22 => 16,);
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
{% set belongsTo = Bake.aliasExtractor(modelObj, 'BelongsTo') %}
{% set belongsToMany = Bake.aliasExtractor(modelObj, 'belongsToMany') %}
{% set compact = [\"'#{singularName}'\"] %}

    /**
     * Edit method
     *
     * @param string|null \$id {{ singularHumanName }} id.
     * @return \\Cake\\Http\\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \\Cake\\Network\\Exception\\NotFoundException When record not found.
     */
    public function edit(\$id = null)
    {
        \${{ singularName }} = \$this->{{ currentModelName }}->get(\$id, [
            'contain' => [{{ Bake.stringifyList(belongsToMany, {'indent': false})|raw }}]
        ]);
        if (\$this->request->is(['patch', 'post', 'put'])) {
            \${{ singularName }} = \$this->{{ currentModelName }}->patchEntity(\${{ singularName }}, \$this->request->getData());
            if (\$this->{{ currentModelName }}->save(\${{ singularName }})) {
                \$this->Flash->success(__('The {{ singularHumanName|lower }} has been saved.'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The {{ singularHumanName|lower }} could not be saved. Please, try again.'));
        }
{% for assoc in belongsTo|merge(belongsToMany) %}
    {%- set otherName = Bake.getAssociatedTableAlias(modelObj, assoc) %}
    {%- set otherPlural = otherName|variable %}
        \${{ otherPlural }} = \$this->{{ currentModelName }}->{{ otherName }}->find('list', ['limit' => 200]);
        {{- \"\\n\" }}
    {%- set compact = compact|merge([\"'#{otherPlural}'\"]) %}
{% endfor %}
        \$this->set(compact({{ compact|join(', ')|raw }}));
    }
", "/var/www/html/app/vendor/cakephp/bake/src/Template/Bake/Element/Controller/edit.twig", "");
    }
}
