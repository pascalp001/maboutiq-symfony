<?php

/* ::layout/layout.html.twig */
class __TwigTemplate_76966d01a03ac3430ed4cf9854c0496f42949309260c07cf9a1b668289ebcc04 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'footer' => array($this, 'block_footer'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_900ae95e047562947b810084d5113f4e996624a615ef722ea862331af5e88050 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_900ae95e047562947b810084d5113f4e996624a615ef722ea862331af5e88050->enter($__internal_900ae95e047562947b810084d5113f4e996624a615ef722ea862331af5e88050_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::layout/layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        <div class=\"navbar navbar-inverse navbar-fixed-top\"> 
\t        <div class=\"container-fluid\">
\t            <div class=\"navbar-header\">
\t                <button type=\"button\" class=\"navbar-toggle collapsed\"  data-toggle=\"navbar-collapse-1\" aria-expanded=\"false\">
\t                    <span class=\"sr-only\">Toggle navigation</span>
\t                    <span class=\"icon-bar\"></span>
\t                    <span class=\"icon-bar\"></span>
\t                    <span class=\"icon-bar\"></span>
\t                </button>
\t                <a class=\"navbar-brand\" href=\"";
        // line 25
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("produits");
        echo "\">LOGO!!!</a>
\t            </div>
\t            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
\t\t\t      \t<ul class=\"nav navbar-nav\">
\t\t\t\t        <li class=\"active\"><a href=\"#\">Accueil <span class=\"sr-only\">(current)</span></a></li>
\t\t\t\t        <li><a href=\"#\">Page1</a></li>
\t\t\t\t        <li class=\"dropdown\">
\t\t\t\t          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Autres <span class=\"caret\"></span></a>
\t\t\t\t          <ul class=\"dropdown-menu\">
\t\t\t\t            <li><a href=\"#\">Action 1</a></li>
\t\t\t\t            <li><a href=\"#\">Action 2</a></li>
\t\t\t\t            <li><a href=\"#\">Action 3</a></li>
\t\t\t\t            <li role=\"separator\" class=\"divider\"></li>
\t\t\t\t            <li><a href=\"#\">Lien séparé</a></li>
\t\t\t\t            <li role=\"separator\" class=\"divider\"></li>
\t\t\t\t            <li><a href=\"#\">Autre lien séparé</a></li>
\t\t\t\t          </ul>
\t\t\t\t        </li>
\t\t\t      \t</ul>

\t                <form class=\"navbar-form navbar-right\">
\t                    <div class=\"form-group\">
\t\t                    <input type=\"text\" id=\"Search\" name=\"Search\"  class=\"form-control\" placeholder=\"Rechercher\" 
\t\t                    style=\"color:yellow; line-height: 20px; font-size: 15px;\">
\t                    </div>
\t                    <button type=\"submit\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-search\"></span></button>
\t                </form>
\t                
\t            </div>

\t        </div>
\t    </div>

<!-- Contenu principal  -->   
        ";
        // line 59
        $this->displayBlock('body', $context, $blocks);
        // line 60
        echo "
<!--Footer-->
        <div class=\"wedge50\"> &nbsp; </div>
        <hr class=\"hrb\" />
        ";
        // line 64
        $this->displayBlock('footer', $context, $blocks);
        // line 95
        echo "
<!--End page -->
        ";
        // line 97
        $this->displayBlock('javascripts', $context, $blocks);
        // line 101
        echo "    </body>
</html>
";
        
        $__internal_900ae95e047562947b810084d5113f4e996624a615ef722ea862331af5e88050->leave($__internal_900ae95e047562947b810084d5113f4e996624a615ef722ea862331af5e88050_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_d52b458c32d9a1d468c6a4f1d769c3fd4c77b801fc94934eb0470da60d7d1789 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d52b458c32d9a1d468c6a4f1d769c3fd4c77b801fc94934eb0470da60d7d1789->enter($__internal_d52b458c32d9a1d468c6a4f1d769c3fd4c77b801fc94934eb0470da60d7d1789_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Pascalp Version Développement";
        
        $__internal_d52b458c32d9a1d468c6a4f1d769c3fd4c77b801fc94934eb0470da60d7d1789->leave($__internal_d52b458c32d9a1d468c6a4f1d769c3fd4c77b801fc94934eb0470da60d7d1789_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_7b611679e19436c10d4e2e1a83ba840b3089b7f6570b5ffa38ddcc4b2ac2e2fc = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_7b611679e19436c10d4e2e1a83ba840b3089b7f6570b5ffa38ddcc4b2ac2e2fc->enter($__internal_7b611679e19436c10d4e2e1a83ba840b3089b7f6570b5ffa38ddcc4b2ac2e2fc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 7
        echo "            <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bootstrap/css/bootstrap.css"), "html", null, true);
        echo "\" />
            <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bootstrap/css/bootstrap-theme.css"), "html", null, true);
        echo "\" />
           <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/main.css"), "html", null, true);
        echo "\" />    
            <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" />

        ";
        
        $__internal_7b611679e19436c10d4e2e1a83ba840b3089b7f6570b5ffa38ddcc4b2ac2e2fc->leave($__internal_7b611679e19436c10d4e2e1a83ba840b3089b7f6570b5ffa38ddcc4b2ac2e2fc_prof);

    }

    // line 59
    public function block_body($context, array $blocks = array())
    {
        $__internal_d35ae9f16387bd821eb74a6e0c32520b275104c5aeb9fca5c978ac1ee56448a6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d35ae9f16387bd821eb74a6e0c32520b275104c5aeb9fca5c978ac1ee56448a6->enter($__internal_d35ae9f16387bd821eb74a6e0c32520b275104c5aeb9fca5c978ac1ee56448a6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_d35ae9f16387bd821eb74a6e0c32520b275104c5aeb9fca5c978ac1ee56448a6->leave($__internal_d35ae9f16387bd821eb74a6e0c32520b275104c5aeb9fca5c978ac1ee56448a6_prof);

    }

    // line 64
    public function block_footer($context, array $blocks = array())
    {
        $__internal_d86c21b29aab1e6f4639363388775f3491e8179bedca758514a64888a882714f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d86c21b29aab1e6f4639363388775f3491e8179bedca758514a64888a882714f->enter($__internal_d86c21b29aab1e6f4639363388775f3491e8179bedca758514a64888a882714f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "footer"));

        // line 65
        echo "            <footer id=\"footer\" class=\"vspace20\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-4 offset1\">
                            <h4>Informations</h4>
                            <ul class=\"nav nav-stacked\">
                                ";
        // line 71
        echo $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\ActionsExtension')->renderUri($this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->controller("PagesBundle:Pages:menu"), array());
        // line 72
        echo "                            </ul>
                        </div> 

                        <div class=\"col-md-4\">
                            <h4>Notre entrepôt</h4>
                            <p><i class=\"icon-map-marker\"></i>&nbsp;AdresseDeLentrepot</p>
                        </div>

                        <div class=\"col-md-2\">
                            <h4>Nous contacter</h4>
                            <p><i class=\"icon-phone\"></i>&nbsp;Tel: 01 02 03 04 05</p>
                            <p><i class=\"icon-print\"></i>&nbsp;Fax: 01 02 03 04 05</p>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-4\">
                            <p>&copy; Copyright 2016 - ProG-developpement IT</p>
                        </div>
                    </div>
                </div>
            </footer>   
        ";
        
        $__internal_d86c21b29aab1e6f4639363388775f3491e8179bedca758514a64888a882714f->leave($__internal_d86c21b29aab1e6f4639363388775f3491e8179bedca758514a64888a882714f_prof);

    }

    // line 97
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_3a9c714460cdf7cd3842e82b52593f3dd69d5bd3e26de8316bc39f65018bca86 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3a9c714460cdf7cd3842e82b52593f3dd69d5bd3e26de8316bc39f65018bca86->enter($__internal_3a9c714460cdf7cd3842e82b52593f3dd69d5bd3e26de8316bc39f65018bca86_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 98
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/plugin/jquery/jquery.min.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 99
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bootstrap/js/bootstrap.js"), "html", null, true);
        echo "\"></script>
        ";
        
        $__internal_3a9c714460cdf7cd3842e82b52593f3dd69d5bd3e26de8316bc39f65018bca86->leave($__internal_3a9c714460cdf7cd3842e82b52593f3dd69d5bd3e26de8316bc39f65018bca86_prof);

    }

    public function getTemplateName()
    {
        return "::layout/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 99,  220 => 98,  214 => 97,  185 => 72,  183 => 71,  175 => 65,  169 => 64,  158 => 59,  148 => 10,  144 => 9,  140 => 8,  135 => 7,  129 => 6,  117 => 5,  108 => 101,  106 => 97,  102 => 95,  100 => 64,  94 => 60,  92 => 59,  55 => 25,  39 => 13,  37 => 6,  33 => 5,  27 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Pascalp Version Développement{% endblock %}</title>
        {% block stylesheets %}
            <link rel=\"stylesheet\" href=\"{{ asset('bootstrap/css/bootstrap.css') }}\" />
            <link rel=\"stylesheet\" href=\"{{ asset('bootstrap/css/bootstrap-theme.css') }}\" />
           <link rel=\"stylesheet\" href=\"{{ asset('css/main.css')}}\" />    
            <link rel=\"stylesheet\" href=\"{{ asset('css/style.css')}}\" />

        {% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        <div class=\"navbar navbar-inverse navbar-fixed-top\"> 
\t        <div class=\"container-fluid\">
\t            <div class=\"navbar-header\">
\t                <button type=\"button\" class=\"navbar-toggle collapsed\"  data-toggle=\"navbar-collapse-1\" aria-expanded=\"false\">
\t                    <span class=\"sr-only\">Toggle navigation</span>
\t                    <span class=\"icon-bar\"></span>
\t                    <span class=\"icon-bar\"></span>
\t                    <span class=\"icon-bar\"></span>
\t                </button>
\t                <a class=\"navbar-brand\" href=\"{{path('produits')}}\">LOGO!!!</a>
\t            </div>
\t            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
\t\t\t      \t<ul class=\"nav navbar-nav\">
\t\t\t\t        <li class=\"active\"><a href=\"#\">Accueil <span class=\"sr-only\">(current)</span></a></li>
\t\t\t\t        <li><a href=\"#\">Page1</a></li>
\t\t\t\t        <li class=\"dropdown\">
\t\t\t\t          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Autres <span class=\"caret\"></span></a>
\t\t\t\t          <ul class=\"dropdown-menu\">
\t\t\t\t            <li><a href=\"#\">Action 1</a></li>
\t\t\t\t            <li><a href=\"#\">Action 2</a></li>
\t\t\t\t            <li><a href=\"#\">Action 3</a></li>
\t\t\t\t            <li role=\"separator\" class=\"divider\"></li>
\t\t\t\t            <li><a href=\"#\">Lien séparé</a></li>
\t\t\t\t            <li role=\"separator\" class=\"divider\"></li>
\t\t\t\t            <li><a href=\"#\">Autre lien séparé</a></li>
\t\t\t\t          </ul>
\t\t\t\t        </li>
\t\t\t      \t</ul>

\t                <form class=\"navbar-form navbar-right\">
\t                    <div class=\"form-group\">
\t\t                    <input type=\"text\" id=\"Search\" name=\"Search\"  class=\"form-control\" placeholder=\"Rechercher\" 
\t\t                    style=\"color:yellow; line-height: 20px; font-size: 15px;\">
\t                    </div>
\t                    <button type=\"submit\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-search\"></span></button>
\t                </form>
\t                
\t            </div>

\t        </div>
\t    </div>

<!-- Contenu principal  -->   
        {% block body %}{% endblock %}

<!--Footer-->
        <div class=\"wedge50\"> &nbsp; </div>
        <hr class=\"hrb\" />
        {% block footer %}
            <footer id=\"footer\" class=\"vspace20\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-4 offset1\">
                            <h4>Informations</h4>
                            <ul class=\"nav nav-stacked\">
                                {% render(controller('PagesBundle:Pages:menu')) %}
                            </ul>
                        </div> 

                        <div class=\"col-md-4\">
                            <h4>Notre entrepôt</h4>
                            <p><i class=\"icon-map-marker\"></i>&nbsp;AdresseDeLentrepot</p>
                        </div>

                        <div class=\"col-md-2\">
                            <h4>Nous contacter</h4>
                            <p><i class=\"icon-phone\"></i>&nbsp;Tel: 01 02 03 04 05</p>
                            <p><i class=\"icon-print\"></i>&nbsp;Fax: 01 02 03 04 05</p>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-4\">
                            <p>&copy; Copyright 2016 - ProG-developpement IT</p>
                        </div>
                    </div>
                </div>
            </footer>   
        {% endblock %}

<!--End page -->
        {% block javascripts %}
            <script src=\"{{ asset('js/plugin/jquery/jquery.min.js')}}\"></script>
            <script src=\"{{ asset('bootstrap/js/bootstrap.js')}}\"></script>
        {% endblock %}
    </body>
</html>
", "::layout/layout.html.twig", "D:\\wamp\\www\\ECom\\app/Resources\\views/layout/layout.html.twig");
    }
}
