<?php

/* index/test.html */
class __TwigTemplate_5a748d7024f6a62158564c0d2e23bf36e73ab3111bc0190856d257e48b8f0bfd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("layout.html", "index/test.html", 3);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo twig_escape_filter($this->env, (isset($context["test"]) ? $context["test"] : null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "index/test.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 5,  28 => 4,  11 => 3,);
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

{% extends \"layout.html\" %}
{% block content%}
{{ test }}
{% endblock%}", "index/test.html", "F:\\Coding\\wamp\\www\\imooc\\app\\view\\index\\test.html");
    }
}
