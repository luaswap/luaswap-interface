<?php

namespace WPML\Core;

use \WPML\Core\Twig\Environment;
use \WPML\Core\Twig\Error\LoaderError;
use \WPML\Core\Twig\Error\RuntimeError;
use \WPML\Core\Twig\Markup;
use \WPML\Core\Twig\Sandbox\SecurityError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use \WPML\Core\Twig\Source;
use \WPML\Core\Twig\Template;

/* layout-slot-edit-button.twig */
class __TwigTemplate_be56f59260b67addf692e3c2544b67aeea89ec1b1bc63097cb32b35bd2e9432c extends \WPML\Core\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        ob_start(function () { return ''; });
        // line 2
        if ((($context["action"] ?? null) == "edit")) {
            // line 3
            echo "\t";
            $context["class"] = "otgs-ico-edit";
        } else {
            // line 5
            echo "\t";
            $context["class"] = "otgs-ico-add";
        }
        // line 7
        echo "
<p class=\"wpml-ls-slot-management-link-wrapper\">
\t<a href=\"";
        // line 9
        echo \WPML\Core\twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "\" class=\"js-wpml-ls-slot-management-link button-secondary\">
\t\t<span class=\"";
        // line 10
        echo \WPML\Core\twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
        echo "\"></span> ";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
        echo "</a>
</p>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "layout-slot-edit-button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  48 => 9,  44 => 7,  40 => 5,  36 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "layout-slot-edit-button.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/layout-slot-edit-button.twig");
    }
}
