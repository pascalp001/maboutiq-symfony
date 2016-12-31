<?php

/* ::modulesBase/nav.html.twig */
class __TwigTemplate_c857c15453f9100582fe7b6da45bd0d950ca20a853a14a756106528d283aa0ab extends Twig_Template
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
        $__internal_995b8ae2720792523d95111c77ec08f83e5064d0b0b8599b5cc2b8178b94b182 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_995b8ae2720792523d95111c77ec08f83e5064d0b0b8599b5cc2b8178b94b182->enter($__internal_995b8ae2720792523d95111c77ec08f83e5064d0b0b8599b5cc2b8178b94b182_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::modulesBase/nav.html.twig"));

        // line 1
        echo "
    
<div class=\"well\">
    <ul class=\"nav nav-list\">
        <li class=\"nav-header\">Nos produits</li>
        <li class=\"active\">
            <a href=\"index.php\">Légumes</a>
        </li>
        <li>
            <a href=\"index.php\">Fruits</a>
        </li>
    </ul>
</div>

";
        
        $__internal_995b8ae2720792523d95111c77ec08f83e5064d0b0b8599b5cc2b8178b94b182->leave($__internal_995b8ae2720792523d95111c77ec08f83e5064d0b0b8599b5cc2b8178b94b182_prof);

    }

    public function getTemplateName()
    {
        return "::modulesBase/nav.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
    
<div class=\"well\">
    <ul class=\"nav nav-list\">
        <li class=\"nav-header\">Nos produits</li>
        <li class=\"active\">
            <a href=\"index.php\">Légumes</a>
        </li>
        <li>
            <a href=\"index.php\">Fruits</a>
        </li>
    </ul>
</div>

", "::modulesBase/nav.html.twig", "D:\\wamp\\www\\ECom\\app/Resources\\views/modulesBase/nav.html.twig");
    }
}
