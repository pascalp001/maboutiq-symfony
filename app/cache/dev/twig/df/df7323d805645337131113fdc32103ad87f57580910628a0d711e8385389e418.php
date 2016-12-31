<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_e669083290b9feabccb7167b0470e33851bb23c3e379870a3cf7732fabbc8d85 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_86f707d4816bf92b3ae354e242da84c2956c058a0f662f8a18832e94c667a00c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_86f707d4816bf92b3ae354e242da84c2956c058a0f662f8a18832e94c667a00c->enter($__internal_86f707d4816bf92b3ae354e242da84c2956c058a0f662f8a18832e94c667a00c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_86f707d4816bf92b3ae354e242da84c2956c058a0f662f8a18832e94c667a00c->leave($__internal_86f707d4816bf92b3ae354e242da84c2956c058a0f662f8a18832e94c667a00c_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_3a9cb1dbb3b3f254e09c882a92e7371ab85d18740df042310bac9864a6126936 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3a9cb1dbb3b3f254e09c882a92e7371ab85d18740df042310bac9864a6126936->enter($__internal_3a9cb1dbb3b3f254e09c882a92e7371ab85d18740df042310bac9864a6126936_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_3a9cb1dbb3b3f254e09c882a92e7371ab85d18740df042310bac9864a6126936->leave($__internal_3a9cb1dbb3b3f254e09c882a92e7371ab85d18740df042310bac9864a6126936_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_1f50d50dc2139529df0e3919bcfdaf6d1acff1f80e5982821c5defeeed9321c6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1f50d50dc2139529df0e3919bcfdaf6d1acff1f80e5982821c5defeeed9321c6->enter($__internal_1f50d50dc2139529df0e3919bcfdaf6d1acff1f80e5982821c5defeeed9321c6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_1f50d50dc2139529df0e3919bcfdaf6d1acff1f80e5982821c5defeeed9321c6->leave($__internal_1f50d50dc2139529df0e3919bcfdaf6d1acff1f80e5982821c5defeeed9321c6_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_8574e748f7777a4e4a4e2d75dfbae1e01e268effec2b073a19dbec2b72b18255 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8574e748f7777a4e4a4e2d75dfbae1e01e268effec2b073a19dbec2b72b18255->enter($__internal_8574e748f7777a4e4a4e2d75dfbae1e01e268effec2b073a19dbec2b72b18255_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_8574e748f7777a4e4a4e2d75dfbae1e01e268effec2b073a19dbec2b72b18255->leave($__internal_8574e748f7777a4e4a4e2d75dfbae1e01e268effec2b073a19dbec2b72b18255_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "D:\\wamp\\www\\ECom\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\WebProfilerBundle\\Resources\\views\\Collector\\router.html.twig");
    }
}
