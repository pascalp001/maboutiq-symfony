<?php

/* PagesBundle:Default:pages/layout/pages.html.twig */
class __TwigTemplate_1795dd795e8e1a7057be3b301b5e01ec2f5aa5b2ca4de70ff36536705d4f9b5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::layout/layout.html.twig", "PagesBundle:Default:pages/layout/pages.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7a64b052d29d58995fe5b4f7fbccf8bbf19c080b86a6aab16efdea052dcce9f6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_7a64b052d29d58995fe5b4f7fbccf8bbf19c080b86a6aab16efdea052dcce9f6->enter($__internal_7a64b052d29d58995fe5b4f7fbccf8bbf19c080b86a6aab16efdea052dcce9f6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "PagesBundle:Default:pages/layout/pages.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7a64b052d29d58995fe5b4f7fbccf8bbf19c080b86a6aab16efdea052dcce9f6->leave($__internal_7a64b052d29d58995fe5b4f7fbccf8bbf19c080b86a6aab16efdea052dcce9f6_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_ddf3726698d68e25cd3887f63520922af2d08fc319552bafa19f7012c084e98a = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ddf3726698d68e25cd3887f63520922af2d08fc319552bafa19f7012c084e98a->enter($__internal_ddf3726698d68e25cd3887f63520922af2d08fc319552bafa19f7012c084e98a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "    <div class=\"container\">
        <div class=\"row\">
            <h1>";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "titre", array()), "html", null, true);
        echo "</h1>
            <div class=\"col-sm-12\">
                ";
        // line 7
        echo $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "contenu", array());
        echo "
            </div>
        </div>
    </div>
";
        
        $__internal_ddf3726698d68e25cd3887f63520922af2d08fc319552bafa19f7012c084e98a->leave($__internal_ddf3726698d68e25cd3887f63520922af2d08fc319552bafa19f7012c084e98a_prof);

    }

    public function getTemplateName()
    {
        return "PagesBundle:Default:pages/layout/pages.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 7,  44 => 5,  40 => 3,  34 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"::layout/layout.html.twig\" %}
{% block body %}
    <div class=\"container\">
        <div class=\"row\">
            <h1>{{page.titre}}</h1>
            <div class=\"col-sm-12\">
                {{page.contenu|raw}}
            </div>
        </div>
    </div>
{% endblock %}", "PagesBundle:Default:pages/layout/pages.html.twig", "D:\\wamp\\www\\ECom\\src\\Pages\\PagesBundle/Resources/views/Default/pages/layout/pages.html.twig");
    }
}
