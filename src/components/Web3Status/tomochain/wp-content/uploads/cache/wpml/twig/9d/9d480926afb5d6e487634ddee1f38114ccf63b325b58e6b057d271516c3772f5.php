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

/* button-add-new-ls.twig */
class __TwigTemplate_ab4b80222a8c5f6db634d60b61a15e4ef7629dff729c658c256edbd50292b989 extends \WPML\Core\Twig\Template
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
        echo "<p class=\"alignright\">

\t";
        // line 3
        $context["add_tooltip"] = ($context["tooltip_all_assigned"] ?? null);
        // line 4
        echo "
\t";
        // line 5
        if ((($context["existing_items"] ?? null) == 0)) {
            // line 6
            echo "\t\t";
            $context["add_tooltip"] = ($context["tooltip_no_item"] ?? null);
            // line 7
            echo "\t";
        }
        // line 8
        echo "
\t";
        // line 9
        if ((($context["settings_items"] ?? null) >= ($context["existing_items"] ?? null))) {
            // line 10
            echo "\t\t";
            $context["disabled"] = true;
            // line 11
            echo "\t";
        }
        // line 12
        echo "
\t<span class=\"js-wpml-ls-tooltip-wrapper";
        // line 13
        if ( !($context["disabled"] ?? null)) {
            echo " hidden";
        }
        echo "\">
        ";
        // line 14
        $this->loadTemplate("tooltip.twig", "button-add-new-ls.twig", 14)->display(twig_array_merge($context, ["content" => ($context["add_tooltip"] ?? null)]));
        // line 15
        echo "    </span>

\t<button class=\"js-wpml-ls-open-dialog button-secondary\"";
        // line 17
        if (($context["disabled"] ?? null)) {
            echo " disabled=\"disabled\"";
        }
        // line 18
        echo "\t\t\tdata-target=\"";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["button_target"] ?? null), "html", null, true);
        echo "\">+ ";
        echo \WPML\Core\twig_escape_filter($this->env, ($context["button_label"] ?? null), "html", null, true);
        echo "</button>
</p>";
    }

    public function getTemplateName()
    {
        return "button-add-new-ls.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 18,  75 => 17,  71 => 15,  69 => 14,  63 => 13,  60 => 12,  57 => 11,  54 => 10,  52 => 9,  49 => 8,  46 => 7,  43 => 6,  41 => 5,  38 => 4,  36 => 3,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "button-add-new-ls.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/button-add-new-ls.twig");
    }
}
