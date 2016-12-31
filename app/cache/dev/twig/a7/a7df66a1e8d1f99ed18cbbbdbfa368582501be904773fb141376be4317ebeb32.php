<?php

/* EcomBundle:Default:produits/layout/produits.html.twig */
class __TwigTemplate_b0b00a5c0568bfd09c4bc1c9cbdeaf909fdad3d808ec0057c35f6e1fcc657650 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::layout/layout.html.twig", "EcomBundle:Default:produits/layout/produits.html.twig", 1);
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
        $__internal_8cc9a6b3eef561dedaa3c55e6b44b65cb36a6acaeb78866df9094cc507ed6a85 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8cc9a6b3eef561dedaa3c55e6b44b65cb36a6acaeb78866df9094cc507ed6a85->enter($__internal_8cc9a6b3eef561dedaa3c55e6b44b65cb36a6acaeb78866df9094cc507ed6a85_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "EcomBundle:Default:produits/layout/produits.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8cc9a6b3eef561dedaa3c55e6b44b65cb36a6acaeb78866df9094cc507ed6a85->leave($__internal_8cc9a6b3eef561dedaa3c55e6b44b65cb36a6acaeb78866df9094cc507ed6a85_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_951a8a251ca95228ec8b6454e29156a462d2ba0d43427290ee46db6e077d1cd9 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_951a8a251ca95228ec8b6454e29156a462d2ba0d43427290ee46db6e077d1cd9->enter($__internal_951a8a251ca95228ec8b6454e29156a462d2ba0d43427290ee46db6e077d1cd9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "<div class=\"container\">
\t<div style=\"height:100px;\"> &nbsp; </div>
    <div class=\"row\">
    \t<div class=\"col-md-2\">
        ";
        // line 7
        $this->loadTemplate("::modulesBase/nav.html.twig", "EcomBundle:Default:produits/layout/produits.html.twig", 7)->display($context);
        echo "     
        </div>   
        <div class=\"col-md-10\">

            <ul class=\"\"  >
                 ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(0, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 13
            echo "                <li class=\"col-md-4 col-sm-6 thumbnail\" style=\"background: #bbb; \" >
                    <div class=\"row \">
                    \t<div class=\"col-md-5\">
\t                        <img src=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/thumb5.jpg"), "html", null, true);
            echo "\" alt=\"image produit ";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\" width=\"100\" >
\t                    </div>
\t                    <div class=\"col-md-7\">   
\t                        <div class=\"caption\">
\t                            <h4>produit ";
            // line 20
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</h4>
\t                            <p>100,00 €</p>
\t                            <a class=\"btn btn-primary\" href=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("presentation", array("id" => $context["i"])), "html", null, true);
            echo "\">Plus d'infos</a>
\t                            <a class=\"btn btn-success\" href=\"";
            // line 23
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("panier");
            echo "\">Ajouter au panier</a>
\t                        </div>
                    \t</div>
                    </div>
                </li>
               ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "            </ul>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-offset-2 col-md-8\">
                <ul class=\"pagination\">
                    <li class=\"disabled\"><span>Précédent</span></li>
                    <li class=\"disabled\"><span>1</span></li>
                    <li><a href=\"#\">2</a></li>
                    <li><a href=\"#\">3</a></li>
                    <li><a href=\"#\">4</a></li>
                    <li><a href=\"#\">5</a></li>
                    <li><a href=\"#\">Suivant</a></li>
                </ul>
        </div>
    </div>
</div>
";
        
        $__internal_951a8a251ca95228ec8b6454e29156a462d2ba0d43427290ee46db6e077d1cd9->leave($__internal_951a8a251ca95228ec8b6454e29156a462d2ba0d43427290ee46db6e077d1cd9_prof);

    }

    public function getTemplateName()
    {
        return "EcomBundle:Default:produits/layout/produits.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 29,  81 => 23,  77 => 22,  72 => 20,  63 => 16,  58 => 13,  54 => 12,  46 => 7,  40 => 3,  34 => 2,  11 => 1,);
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
\t<div style=\"height:100px;\"> &nbsp; </div>
    <div class=\"row\">
    \t<div class=\"col-md-2\">
        {% include '::modulesBase/nav.html.twig' %}     
        </div>   
        <div class=\"col-md-10\">

            <ul class=\"\"  >
                 {% for i in 0..10 %}
                <li class=\"col-md-4 col-sm-6 thumbnail\" style=\"background: #bbb; \" >
                    <div class=\"row \">
                    \t<div class=\"col-md-5\">
\t                        <img src=\"{{ asset('img/thumb5.jpg') }}\" alt=\"image produit {{i}}\" width=\"100\" >
\t                    </div>
\t                    <div class=\"col-md-7\">   
\t                        <div class=\"caption\">
\t                            <h4>produit {{i}}</h4>
\t                            <p>100,00 €</p>
\t                            <a class=\"btn btn-primary\" href=\"{{ path('presentation', {'id': i  })  }}\">Plus d'infos</a>
\t                            <a class=\"btn btn-success\" href=\"{{ path('panier')  }}\">Ajouter au panier</a>
\t                        </div>
                    \t</div>
                    </div>
                </li>
               {% endfor %}
            </ul>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-offset-2 col-md-8\">
                <ul class=\"pagination\">
                    <li class=\"disabled\"><span>Précédent</span></li>
                    <li class=\"disabled\"><span>1</span></li>
                    <li><a href=\"#\">2</a></li>
                    <li><a href=\"#\">3</a></li>
                    <li><a href=\"#\">4</a></li>
                    <li><a href=\"#\">5</a></li>
                    <li><a href=\"#\">Suivant</a></li>
                </ul>
        </div>
    </div>
</div>
{% endblock %}", "EcomBundle:Default:produits/layout/produits.html.twig", "D:\\wamp\\www\\ECom\\src\\DV\\EcomBundle/Resources/views/Default/produits/layout/produits.html.twig");
    }
}
