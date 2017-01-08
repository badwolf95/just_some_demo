<?php

/* layout.html */
class __TwigTemplate_05cfbaa4f1be468bd7b4a785d4e57b2aaefb0c9ad8f8e6d6d41764c5517de073 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>layout</title>
</head>
<body>
\t<header>header</header>
\t<article>
\t";
        // line 10
        $this->displayBlock('content', $context, $blocks);
        // line 13
        echo "\t</article>
\t<footer>footer</footer>
</body>
</html>";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "
\t";
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function getDebugInfo()
    {
        return array (  43 => 11,  40 => 10,  33 => 13,  31 => 10,  20 => 1,);
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
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>layout</title>
</head>
<body>
\t<header>header</header>
\t<article>
\t{% block content %}

\t{% endblock %}
\t</article>
\t<footer>footer</footer>
</body>
</html>", "layout.html", "F:\\Coding\\wamp\\www\\imooc\\app\\view\\layout.html");
    }
}
