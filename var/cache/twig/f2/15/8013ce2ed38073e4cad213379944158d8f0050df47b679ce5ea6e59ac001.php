<?php

/* layout.html */
class __TwigTemplate_f2158013ce2ed38073e4cad213379944158d8f0050df47b679ce5ea6e59ac001 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'navigation' => array($this, 'block_navigation'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
\t<head>
\t    <meta charset=\"utf-8\">
    \t<meta http-equiv=\"Content-Language\" content=\"es\"/>
\t    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
\t    <meta name=\"viewport\" content=\"width=600\">

    \t<meta name=\"DC.url\" content=\"https://handleit.pratnez.com/\" />
\t    <meta name=\"CDN.url\" content=\"https://handleit.pratnez.com/\" />

\t    <meta property=\"og:image\" content=\"90x90.png\"/>
\t    <title>Handle It - C'thun</title>
\t\t<meta content='Comunidad de usuarios del wow, guild destinada al pve y al contenido de maximo nivel.' name='description'/>
\t\t<link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "basepath", array()), "html", null, true);
        echo "/static/css/bootstrap.min.css\" rel=\"stylesheet\">
\t\t<link href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "basepath", array()), "html", null, true);
        echo "/static/css/style.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

</head>

\t<body>
\t\t";
        // line 21
        $this->displayBlock('header', $context, $blocks);
        // line 22
        echo "\t\t";
        $this->displayBlock('navigation', $context, $blocks);
        // line 23
        echo "\t\t";
        $this->displayBlock('content', $context, $blocks);
        // line 24
        echo "\t\t";
        $this->displayBlock('footer', $context, $blocks);
        // line 25
        echo "
\t\t<!--javascripts -->
\t\t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    \t<!-- Include all compiled plugins (below), or include individual files as needed -->
\t\t<script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "basepath", array()), "html", null, true);
        echo "/static/js/bootstrap.min.js\"></script>
\t</body>
</html>
";
    }

    // line 21
    public function block_header($context, array $blocks = array())
    {
    }

    // line 22
    public function block_navigation($context, array $blocks = array())
    {
    }

    // line 23
    public function block_content($context, array $blocks = array())
    {
    }

    // line 24
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 24,  86 => 23,  81 => 22,  76 => 21,  68 => 29,  62 => 25,  59 => 24,  56 => 23,  53 => 22,  51 => 21,  43 => 16,  39 => 15,  23 => 1,);
    }
}
